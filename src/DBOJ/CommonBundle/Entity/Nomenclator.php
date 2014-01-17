<?php

namespace DBOJ\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Nomenclator
 *
 * @ORM\Table(name="common_nomenclator")
 * @ORM\Entity(repositoryClass="DBOJ\CommonBundle\Entity\Repository\NomenclatorRepository")
 * @UniqueEntity(fields={"value"}, message="El valor del nomenclador tiene que ser único")
 */
class Nomenclator implements \Serializable
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
     * @ORM\Column(name="value", type="string", length=255, unique=true)
     */
    private $value;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * var integer $catalog
     *
     * @ORM\ManyToOne(targetEntity="Catalog", inversedBy="nomenclators")
     */
    private $catalog;

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
     * @return Nomenclator
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
    public function __toString()
    {
        return $this->value;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Nomenclator
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
     * Set catalog
     *
     * @param \DBOJ\CommonBundle\Entity\Catalog $catalog
     * @return Nomenclator
     */
    public function setCatalog(\DBOJ\CommonBundle\Entity\Catalog $catalog = null)
    {
        $this->catalog = $catalog;
    
        return $this;
    }

    /**
     * Get catalog
     *
     * @return \DBOJ\CommonBundle\Entity\Catalog 
     */
    public function getCatalog()
    {
        return $this->catalog;
    }

    public function serialize()
    {
        return serialize(array(
            $this->value,
            $this->description,
            $this->id,
        ));
    }

    public function unserialize($serialized)
    {
        $data = unserialize($serialized);
        // add a few extra elements in the array to ensure that we have enough keys when unserializing
        // older data which does not include all properties.
        $data = array_merge($data, array_fill(0, 2, null));

        list(
            $this->value,
            $this->description,
            $this->id
            ) = $data;
    }
}