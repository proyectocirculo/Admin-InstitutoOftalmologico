<?php

namespace Circulo\VegaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\MediaBundle\Model\GalleryInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="Practicas")
 */
class Practicas
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="idPRACTICAS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Atencion
     *
     * @ORM\ManyToOne(targetEntity="Atenciones", inversedBy="practicas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Atenciones", referencedColumnName="idATENCIONES")
     * })
    */
    private $atencion;

    /**
     * @ORM\Column(name="Fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @ORM\Column(name="FechaRealizada", type="datetime", nullable=false)
     */
    private $fechaRealizada;


    /**
     * @ORM\Column(name="Informacion", type="string", nullable=true)
     */
    private $informacion;

    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")     
     */
    protected $imagen;

    /**
     * @var GalleryInterface
     */
    protected $gallery;

    /**
     * @var string $realizada
     *
     * @ORM\Column(name="Realizada", type="boolean", length=1, nullable=true)
     */
    private $realizada;

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
     * Set atencion
     *
     * @param \Circulo\VegaBundle\Entity\Atenciones $atencion
     * @return Practicas
     */
    public function setAtencion(\Circulo\VegaBundle\Entity\Atenciones $atencion = null)
    {
        $this->atencion = $atencion;

        return $this;
    }

    /**
     * Get atencion
     *
     * @return \Circulo\VegaBundle\Entity\Atenciones $atencion 
     */
    public function getAtencion()
    {
        return $this->atencion;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Practicas
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set fechaRealizada
     *
     * @param string $fechaRealizada
     * @return Practicas
     */
    public function setFechaRealizada($fechaRealizada)
    {
        $this->fechaRealizada = $fechaRealizada;

        return $this;
    }

    /**
     * Get fechaRealizada
     *
     * @return string 
     */
    public function getFechaRealizada()
    {
        return $this->fechaRealizada;
    }

    /**
     * Set informacion
     *
     * @param string $informacion
     * @return Practicas
     */
    public function setInformacion($informacion)
    {
        $this->informacion = $informacion;

        return $this;
    }

    /**
     * Get informacion
     *
     * @return string 
     */
    public function getInformacion()
    {
        return $this->informacion;
    }


   /**
     * {@inheritdoc}
     */
    public function setImagen(MediaInterface $imagen = null)
    {
        $this->imagen = $imagen;
    }

    /**
     * {@inheritdoc}
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * {@inheritdoc}
     */
    public function setGallery(GalleryInterface $gallery = null)
    {
        $this->gallery = $gallery;
    }

    /**
     * {@inheritdoc}
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * Set realizada
     *
     * @param integer $realizada
     * @return Practicas
     */
    public function setRealizada($realizada)
    {
        $this->realizada = $realizada;

        return $this;
    }

    /**
     * Get realizada
     *
     * @return integer 
     */
    public function getRealizada()
    {
        return $this->realizada;
    }    
}
