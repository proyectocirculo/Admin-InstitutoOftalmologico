<?php

namespace Circulo\VegaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Circulo\VegaBundle\Entity\Localidades
 *
 * @ORM\Table(name="LOCALIDADES")
 * @ORM\Entity
 */
class Localidades
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="idLOCALIDADES", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $localidad
     *
     * @ORM\Column(name="Localidad", type="string", length=45, nullable=true)
     */
    private $localidad;

    /**
     * @var Provincias
     *
     * @ORM\ManyToOne(targetEntity="Provincias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Provincia", referencedColumnName="idPROVINCIAS")
     * })
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
     * Set localidad
     *
     * @param string $localidad
     * @return Localidades
     */
    public function setLocalidad($localidad)
    {
        $this->localidad = $localidad;
    
        return $this;
    }

    /**
     * Get localidad
     *
     * @return string 
     */
    public function getLocalidad()
    {
        return $this->localidad;
    }

   /**
     * Set provincia
     *
     * @param Circulo\VegaBundle\Entity\Provincias $provincia
     * @return Personas
     */
    public function setProvincia(\Circulo\VegaBundle\Entity\Provincias $provincia = null)
    {
        $this->provincia = $provincia;
    
        return $this;
    }

    /**
     * Get provincia
     *
     * @return Circulo\VegaBundle\Entity\Provincias
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * @var integer
     */
    private $idlocalidades;


    /**
     * Get nombrecompleto
     *
     * @return string 
     */
    public function getnombrecompleto()
    {
        return $this->localidad . " - " . $this->provincia;
    }

    public function __toString()
    {
        return $this->localidad . " - " . $this->provincia;
    }    
}
