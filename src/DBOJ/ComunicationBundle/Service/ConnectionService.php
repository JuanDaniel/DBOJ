<?php

namespace DBOJ\ComunicationBundle\Service;

use DBOJ\ComunicationBundle\XMPPHP\XMPP;

class ConnectionService
{
    private $service_container;
    private $logger;

    private $user;
    private $password;
    private $server;
    private $use_ssl;
    private $port;
    private $resource;

    public $connection;


    public function __construct($service_container){
        $this->service_container = $service_container;

        $this->logger = $this->service_container->get('logger');
    }

    /**
     *
     * Método para Iniciar la Conexion con el servidor, este método
     * solo debe ser cargado por el cargador de servicios de Sf.
     */
    public function startConnection($user, $password, $server, $use_ssl=false, $port=5222, $resource='/bosh_server'){
        $this->user = $user;
        $this->password = $password;
        $this->server = $server;
        $this->use_ssl = $use_ssl;
        $this->port = $port;
        $this->resource = $resource;

        $this->connection = new XMPP($this->server,$this->port,$this->user,$this->password,$this->resource);
        $this->openConnection();
    }

    /**
     *
     * Método para iniciar la conexion este metodo debe ser
     * llamado solo en caso de que la conexion sea manualmente cerrada
     */
    private function openConnection(){
        try {
            if ($this->connection){
                $this->connection->useEncryption(strval($this->use_ssl)==='true'?true:false);
                $this->connection->connect();
                $this->connection->processUntil('session_start');
            }
        }
        catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }
    }

    /**
     *
     * Método para cerrar la conexión que exista, este método no debe ser
     * llamado, aunque es posible hacerlo.
     */
    public function closeConnection(){
        try {
            if ($this->connection)
                $this->connection->disconnect();
        } catch (\Exception $e) {
            $this->logger->info($e->getMessage());
        }
    }

    /**
     *
     * Método para indicarle al servidor que debe poner de forma
     * manual el aceptado de suscripciones, esto indica que todas las sugenrencias
     * que sean recibidas serán respondidas satisfactoriamente
     */
    public function makeAutoSuscribe(){
        $this->connection->autoSubscribe();
    }

    /**
     *
     * Método para enviar una solicitud de presencia a todos los usuarios que se encuentran suscritos
     * como amigos del usuario del servidor, los cuales deben ser todos los usuarios
     */
    public function sendPresence(){
        try{
            if($this->connection){
                $this->connection->presence();
            }
        }catch (\Exception $e){
            $this->logger->error($e->getMessage());
        }
    }

    /**
     *
     * Método para obtener todos los usuarios que posee el roster de la cuenta
     */
    public function getRoster(){
        $this->connection->getRoster();
        return $this->connection->roster;
    }

    /**
     *
     * Método para crear un manejador a un determinado evento, estos manejadores deben
     * ser métodos de los servicios que hayan sido cargados
     */
    public function addHandler($xpath, $pointer, $obj=null){
        $this->connection->addXPathHandler($xpath, $pointer, $obj);
    }

    public function sendx(){
        $this->connection->message('ybarrio@rsn.local', 'Mensaje Enviado: '.md5(time()), $type = 'chat', $subject = null, $payload = null);
    }

    /**
     *
     * Método para enviar determinado mensaje a un usuario o grupo de ellos, estos
     * usuarios pueden ser tanto cadenas de carácteres como objetos de la entidad de Usuarios
     */
    public function send($user, $message='', $xml=null, $xml_args=array(), $type='chat', $subject=null ){
        $users = array();
        if(!$type)
            $type = 'chat';

        if(!$message)
            $message = '';

        if(is_array($user)){
            foreach($user as $one_user){
                $user_send = $this->getJIDFromUser($one_user);
                if($user_send)
                    $users[] = $user;
            }
        }else{
            $users = array(
                $this->getJIDFromUser($user)
            );
        }

        if(is_string($xml) && count(explode(':',$xml))==3){
            try{
                $xml = $this->service_container->get('templating')->render($xml, $xml_args);
            }catch(\Exception $e){}
        }

        print_r($xml);
        foreach($users as $one_user){
            $this->connection->message($one_user, $message, $type, $subject, $xml);
        }

    }

    /**
     *
     * Método privado para obtener el JID del usuario que sea pasado por parámetos
     */
    private function getJIDFromUser($user){
        if(is_object($user)){
            return $user->getUsername().'@'.$this->server;
        }

        if(is_string($user)){
            if(count(explode('@',$user))>1)
                return $user;
            return $user->getUsename().'@'.$this->server;
        }

        return null;
    }

}