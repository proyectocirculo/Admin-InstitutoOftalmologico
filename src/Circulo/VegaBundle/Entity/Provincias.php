<?php

namespace Circulo\VegaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Circulo\VegaBundle\Entity\Provincias
 *
 * @ORM\Table(name="PROVINCIAS")
 * @ORM\Entity
 */
class Provincias
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="idPROVINCIAS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $provincia
     *
     * @ORM\Column(name="Provincia", type="string", length=45, nullable=true)
     */
    private $provincia;


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
     * Set provincia
     *
     * @param string $provincia
     * @return Provincias
     */
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;
    
        return $this;
    }

    /**
     * Get provincia
     *
     * @return string
     */
    public function getProvincia()
    {
    
        return $this->provincia;
    }

    /**
     * @var integer
     */
    private $idprovincias;


    /**
     * Get idprovincias
     *
     * @return integer 
     */
    public function getIdprovincias()
    {
        return $this->idprovincias;
    }

    public function __toString()
    {
        return $this->provincia;
    }        
}
