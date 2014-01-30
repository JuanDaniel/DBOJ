<?php

namespace DBOJ\ProblemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Problem
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DBOJ\ProblemBundle\Entity\Repository\ProblemRepository")
 */
class Problem
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_date", type="datetime")
     */
    private $creationDate;

    /**
     * @var string
     *
     * @ORM\Column(name="file_sql", type="string", length=1000)
     */
    private $fileSql;

    /**
     * @var string
     *
     * @ORM\Column(name="solution", type="string", length=2000)
     */
    private $solution;

    /**
     * @var string
     *
     * @ORM\Column(name="name_database", type="string", length=255)
     */
    private $nameDatabase;

    /**
     * @var integer
     *
     * @ORM\Column(name="time", type="integer")
     */
    private $time;

    /**
     * @var integer
     *
     * @ORM\Column(name="memory", type="integer")
     */
    private $memory;
    
    /**
     * @ORM\Column(name="publish", type="boolean")
     */
    private $publish;
    
    /**
    * @ORM\OneToMany(targetEntity="DBOJ\ProblemBundle\Entity\Sending", mappedBy="problem", cascade={"remove"})
    */
    private $sendings;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="points", type="float")
     */
    private $points;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sendings = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return Problem
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Problem
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     * @return Problem
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    
        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime 
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set fileSql
     *
     * @param string $fileSql
     * @return Problem
     */
    public function setFileSql($fileSql)
    {
        $this->fileSql = $fileSql;
    
        return $this;
    }

    /**
     * Get fileSql
     *
     * @return string 
     */
    public function getFileSql()
    {
        return $this->fileSql;
    }

    /**
     * Set solution
     *
     * @param string $solution
     * @return Problem
     */
    public function setSolution($solution)
    {
        $this->solution = $solution;
    
        return $this;
    }

    /**
     * Get solution
     *
     * @return string 
     */
    public function getSolution()
    {
        return $this->solution;
    }

    /**
     * Set nameDatabase
     *
     * @param string $nameDatabase
     * @return Problem
     */
    public function setNameDatabase($nameDatabase)
    {
        $this->nameDatabase = $nameDatabase;
    
        return $this;
    }

    /**
     * Get nameDatabase
     *
     * @return string 
     */
    public function getNameDatabase()
    {
        return $this->nameDatabase;
    }

    /**
     * Set time
     *
     * @param integer $time
     * @return Problem
     */
    public function setTime($time)
    {
        $this->time = $time;
    
        return $this;
    }

    /**
     * Get time
     *
     * @return integer 
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set memory
     *
     * @param integer $memory
     * @return Problem
     */
    public function setMemory($memory)
    {
        $this->memory = $memory;
    
        return $this;
    }

    /**
     * Get memory
     *
     * @return integer 
     */
    public function getMemory()
    {
        return $this->memory;
    }

    /**
     * Set publish
     *
     * @param boolean $publish
     * @return Problem
     */
    public function setPublish($publish)
    {
        $this->publish = $publish;
    
        return $this;
    }

    /**
     * Get publish
     *
     * @return boolean 
     */
    public function getPublish()
    {
        return $this->publish;
    }

    /**
     * Set points
     *
     * @param float $points
     * @return Problem
     */
    public function setPoints($points)
    {
        $this->points = $points;
    
        return $this;
    }

    /**
     * Get points
     *
     * @return float 
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Add sendings
     *
     * @param \DBOJ\ProblemBundle\Entity\Sending $sendings
     * @return Problem
     */
    public function addSending(\DBOJ\ProblemBundle\Entity\Sending $sendings)
    {
        $this->sendings[] = $sendings;
    
        return $this;
    }

    /**
     * Remove sendings
     *
     * @param \DBOJ\ProblemBundle\Entity\Sending $sendings
     */
    public function removeSending(\DBOJ\ProblemBundle\Entity\Sending $sendings)
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
}