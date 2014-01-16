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
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_date", type="datetime")
     */
    private $creationDate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

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
    * @ORM\ManyToOne(targetEntity="DBOJ\CompetitionBundle\Entity\Competition")
    */
    private $competition;

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
     * Set active
     *
     * @param boolean $active
     * @return Problem
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
     * Set competition
     *
     * @param \DBOJ\CompetitionBundle\Entity\Competition $competition
     * @return Problem
     */
    public function setCompetition(\DBOJ\CompetitionBundle\Entity\Competition $competition = null)
    {
        $this->competition = $competition;
    
        return $this;
    }

    /**
     * Get competition
     *
     * @return \DBOJ\CompetitionBundle\Competition 
     */
    public function getCompetition()
    {
        return $this->competition;
    }
}