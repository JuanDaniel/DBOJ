<?php

namespace DBOJ\ComunicationBundle\Util;

class Socket {

    private $host;
    private $port;
    private $socket;

    public function __construct($host = '127.0.0.1', $port = 8080) {
        $this->host = $host;
        $this->port = $port;
        $this->socket = $this->_socket_connect();
    }

    private function _socket_connect() {
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die(socket_strerror(socket_last_error()));

        $result = socket_connect($socket, $this->host, $this->port) or die(socket_strerror(socket_last_error($socket)));

        return $socket;
    }

    public function send($data) {
        $in = json_encode($data);

        socket_write($this->socket, $in, strlen($in));

        return socket_read($this->socket, 2048);
    }
}

?>