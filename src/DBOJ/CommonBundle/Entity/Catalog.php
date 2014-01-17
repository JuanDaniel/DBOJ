<?php

namespace DBOJ\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Catalog
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Catalog
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
     * @ORM\Column(name="value", type="string", length=255)
     */
    private $value;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var array $nomenclators
     *
     * @ORM\OneToMany(targetEntity="Nomenclator", mappedBy="catalog")
     */
    private $nomenclators;


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
     * Set value
     *
     * @param string $value
     * @return Catalog
     */
    public function setValue($value)
    {
        $this->value = $value;
    
        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Catalog
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
     * Constructor
     */
    public function __construct()
    {
        $this->nomenclators = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add nomenclators
     *
     * @param \DBOJ\CommonBundle\Entity\Nomenclator $nomenclators
     * @return Catalog
     */
    public function addNomenclator(\DBOJ\CommonBundle\Entity\Nomenclator $nomenclators)
    {
        $this->nomenclators[] = $nomenclators;
    
        return $this;
    }

    /**
     * Remove nomenclators
     *
     * @param \DBOJ\CommonBundle\Entity\Nomenclator $nomenclators
     */
    public function removeNomenclator(\DBOJ\CommonBundle\Entity\Nomenclator $nomenclators)
    {
        $this->nomenclators->removeElement($nomenclators);
    }

    /**
     * Get nomenclators
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNomenclators()
    {
        return $this->nomenclators;
    }
    
    /**
     * __toString
     */
    public function __toString() {
        return $this->value;
    }
}