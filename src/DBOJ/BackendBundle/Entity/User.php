<?php

namespace DBOJ\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class User
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="user", type="string", length=255)
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="sex", type="string", length=255)
     */
    private $sex;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_registrer", type="datetime")
     */
    private $dateRegistrer;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_visit", type="datetime")
     */
    private $dateVisit;
    
    /**
     * @ORM\ManyToOne(targetEntity="Role")
     */
    private $role;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    
        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set user
     *
     * @param string $user
     * @return User
     */
    public function setUser($user)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return string 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set sex
     *
     * @param string $sex
     * @return User
     */
    public function setSex($sex)
    {
        $this->sex = $sex;
    
        return $this;
    }

    /**
     * Get sex
     *
     * @return string 
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return User
     */
    public function setActive($active)
    {
        $this->active = $active;
    
        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set dateRegistrer
     *
     * @param \DateTime $dateRegistrer
     * @return User
     */
    public function setDateRegistrer($dateRegistrer)
    {
        $this->dateRegistrer = $dateRegistrer;
    
        return $this;
    }

    /**
     * Get dateRegistrer
     *
     * @return \DateTime 
     */
    public function getDateRegistrer()
    {
        return $this->dateRegistrer;
    }

    /**
     * Set dateVisit
     *
     * @param \DateTime $dateVisit
     * @return User
     */
    public function setDateVisit($dateVisit)
    {
        $this->dateVisit = $dateVisit;
    
        return $this;
    }

    /**
     * Get dateVisit
     *
     * @return \DateTime 
     */
    public function getDateVisit()
    {
        return $this->dateVisit;
    }

    /**
     * Set role
     *
     * @param \DBOJ\BackendBundle\Entity\Role $role
     * @return User
     */
    public function setRole(\DBOJ\BackendBundle\Entity\Role $role = null)
    {
        $this->role = $role;
    
        return $this;
    }

    /**
     * Get role
     *
     * @return \DBOJ\BackendBundle\Entity\Role 
     */
    public function getRole()
    {
        return $this->role;
    }
}