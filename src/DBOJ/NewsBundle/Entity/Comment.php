<?php

namespace DBOJ\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Comment
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
     * @ORM\Column(name="content", type="string", length=255)
     */
    private $content;
    
    /**
     * @ORM\ManyToOne(targetEntity="Article")
     */
    private $article;
    
    
    /**
     * 
     * @ORM\ManyToOne(targetEntity="DBOJ\BackendBundle\Entity\User")
     */
    private $user;


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
     * Set content
     *
     * @param string $content
     * @return Comment
     */
    public function setContent($content)
    {
        $this->content = $content;
    
        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set article
     *
     * @param \DBOJ\NewsBundle\Entity\Article $article
     * @return Comment
     */
    public function setArticle(\DBOJ\NewsBundle\Entity\Article $article = null)
    {
        $this->article = $article;
    
        return $this;
    }

    /**
     * Get article
     *
     * @return \DBOJ\NewsBundle\Entity\Article 
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set user
     *
     * @param \dboj\src\DBOJ\BackendBundle\Entity\User $user
     * @return Comment
     */
    public function setUser(\dboj\src\DBOJ\BackendBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \dboj\src\DBOJ\BackendBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}