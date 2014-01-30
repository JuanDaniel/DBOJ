<?php

namespace DBOJ\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DBOJ\UserBundle\Entity\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
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
     * @ORM\ManyToOne(targetEntity="DBOJ\CommonBundle\Entity\Nomenclator")
     */
    private $sex;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;
    
    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="registrer_date", type="datetime")
     */
    private $registrerDate;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="visit_date", type="datetime", nullable=true)
     */
    private $visitDate;
    
    /**
     * @ORM\ManyToOne(targetEntity="Role")
     */
    private $role;

    /**
     * @ORM\ManyToMany(targetEntity="DBOJ\CompetitionBundle\Entity\Team", inversedBy="users")
     */
    private $teams;
    
    /**
     * @ORM\OneToMany(targetEntity="DBOJ\ProblemBundle\Entity\Sending", mappedBy="user")
     */
    private $sendings;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->teams = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set registrerDate
     *
     * @param \DateTime $registrerDate
     * @return User
     */
    public function setRegistrerDate($registrerDate)
    {
        $this->registrerDate = $registrerDate;
    
        return $this;
    }

    /**
     * Get registrerDate
     *
     * @return \DateTime 
     */
    public function getRegistrerDate()
    {
        return $this->registrerDate;
    }

    /**
     * Set visitDate
     *
     * @param \DateTime $visitDate
     * @return User
     */
    public function setVisitDate($visitDate)
    {
        $this->visitDate = $visitDate;
    
        return $this;
    }

    /**
     * Get visitDate
     *
     * @return \DateTime 
     */
    public function getVisitDate()
    {
        return $this->visitDate;
    }

    /**
     * Set role
     *
     * @param \DBOJ\UserBundle\Entity\Role $role
     * @return User
     */
    public function setRole(\DBOJ\UserBundle\Entity\Role $role = null)
    {
        $this->role = $role;
    
        return $this;
    }

    /**
     * Get role
     *
     * @return \DBOJ\UserBundle\Entity\Role 
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Add teams
     *
     * @param \DBOJ\CompetitionBundle\Entity\Team $teams
     * @return User
     */
    public function addTeam(\DBOJ\CompetitionBundle\Entity\Team $teams)
    {
        $this->teams[] = $teams;
    
        return $this;
    }

    /**
     * Remove teams
     *
     * @param \DBOJ\CompetitionBundle\Entity\Team $teams
     */
    public function removeTeam(\DBOJ\CompetitionBundle\Entity\Team $teams)
    {
        $this->teams->removeElement($teams);
    }

    /**
     * Get teams
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTeams()
    {
        return $this->teams;
    }

    public function eraseCredentials() {
        
    }

    public function getRoles() {
        return array($this->role->getRole());
    }

    public function getSalt() {
        
    }

    public function getUsername() {
        return $this->user;
    }

    public function serialize() {
        return serialize(array(
            $this->id,
            $this->user,
            $this->name,
            $this->lastname,
            $this->email,
        ));
    }

    public function unserialize($serialized) {
        list(
            $this->id,
            $this->user,
            $this->name,
            $this->lastname,
            $this->email,) = unserialize($serialized);
    }


    /**
     * Set sex
     *
     * @param \DBOJ\CommonBundle\Entity\Nomenclator $sex
     * @return User
     */
    public function setSex(\DBOJ\CommonBundle\Entity\Nomenclator $sex = null)
    {
        $this->sex = $sex;
    
        return $this;
    }

    /**
     * Get sex
     *
     * @return \DBOJ\CommonBundle\Entity\Nomenclator 
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Add sendings
     *
     * @param \DBOJ\UserBundle\Entity\User $sendings
     * @return User
     */
    public function addSending(\DBOJ\UserBundle\Entity\User $sendings)
    {
        $this->sendings[] = $sendings;
    
        return $this;
    }

    /**
     * Remove sendings
     *
     * @param \DBOJ\UserBundle\Entity\User $sendings
     */
    public function removeSending(\DBOJ\UserBundle\Entity\User $sendings)
    {
        $this->sendings->removeElement($sendings);
    }

    /**
     * Get sendings
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSendings()
    {
        return $this->sendings;
    }
    
    /**
     * __toString
     */
    public function __toString() {
        return $this->name . ' ' . $this->lastname;
    }
}