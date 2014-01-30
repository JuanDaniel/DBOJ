<?php

namespace DBOJ\ProblemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sending
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DBOJ\ProblemBundle\Entity\Repository\SendingRepository")
 */
class Sending
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
     * @var \DateTime
     *
     * @ORM\Column(name="sending_date", type="datetime")
     */
    private $sendingDate;

    /**
     * @var string
     *
     * @ORM\Column(name="answer", type="string", length=1000)
     */
    private $answer;

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
    * @ORM\ManyToOne(targetEntity="DBOJ\UserBundle\Entity\User", inversedBy="sendings")
    */
    private $user;

    /**
    * @ORM\ManyToOne(targetEntity="DBOJ\ProblemBundle\Entity\Problem")
    */
    private $problem;
    
    /**
     * @ORM\ManyToOne(targetEntity="DBOJ\CommonBundle\Entity\Nomenclator", cascade={"persist"})
     */
    private $qualification;
    

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
     * Set sendingDate
     *
     * @param \DateTime $sendingDate
     * @return Sending
     */
    public function setSendingDate($sendingDate)
    {
        $this->sendingDate = $sendingDate;
    
        return $this;
    }

    /**
     * Get sendingDate
     *
     * @return \DateTime 
     */
    public function getSendingDate()
    {
        return $this->sendingDate;
    }

    /**
     * Set answer
     *
     * @param string $answer
     * @return Sending
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
    
        return $this;
    }

    /**
     * Get answer
     *
     * @return string 
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set time
     *
     * @param integer $time
     * @return Sending
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
     * @return Sending
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
     * Set user
     *
     * @param \DBOJ\UserBundle\Entity\User $user
     * @return Sending
     */
    public function setUser(\DBOJ\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \DBOJ\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set problem
     *
     * @param \DBOJ\ProblemBundle\Entity\Problem $problem
     * @return Sending
     */
    public function setProblem(\DBOJ\ProblemBundle\Entity\Problem $problem = null)
    {
        $this->problem = $problem;
    
        return $this;
    }

    /**
     * Get problem
     *
     * @return \DBOJ\ProblemBundle\Entity\Problem 
     */
    public function getProblem()
    {
        return $this->problem;
    }

    /**
     * Set qualification
     *
     * @param \DBOJ\CommonBundle\Entity\Nomenclator $qualification
     * @return Sending
     */
    public function setQualification(\DBOJ\CommonBundle\Entity\Nomenclator $qualification = null)
    {
        $this->qualification = $qualification;
    
        return $this;
    }

    /**
     * Get qualification
     *
     * @return \DBOJ\CommonBundle\Entity\Nomenclator 
     */
    public function getQualification()
    {
        return $this->qualification;
    }
}