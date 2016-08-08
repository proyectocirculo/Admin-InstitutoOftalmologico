<?php

namespace Circulo\VegaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="OSs")
 */
class OSs
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="idOSS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="Nombre", type="string", length=255, nullable=true)     
     */
    private $nombre;

    /**
     * @var Localidad
     *
     * @ORM\ManyToOne(targetEntity="Localidades")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Localidad", referencedColumnName="idLOCALIDADES")
     * })
     */
    private $localidad;

    /**
     * @var string
     * @ORM\Column(name="Codigo", type="string", length=255, nullable=true)     
     */
    private $codigo;

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
     * Set nombre
     *
     * @param string $nombre
     * @return OSs
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }


    /**
     * Set localidad
     *
     * @param Circulo\VegaBundle\Entity\Localidades $localidad
     * @return Servicios
     */
    public function setLocalidad(\Circulo\VegaBundle\Entity\Localidades $localidad = null)
    {
        $this->localidad = $localidad;
    
        return $this;
    }

    /**
     * Get localidad
     *
     * @return Circulo\VegaBundle\Entity\Localidades 
     */
    public function getLocalidad()
    {
        return $this->localidad;
    }

    public function __toString()
    {
        return $this->nombre;
    } 

    /**
     * Set codigo
     *
     * @param string $codigo
     * @return OSs
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }
}
