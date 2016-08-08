<?php

namespace Circulo\VegaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Application\Sonata\ClassificationBundle\Entity\Tag as Tag;

/**
 * @ORM\Entity
 * @ORM\Table(name="Pacientes")
 */
class Pacientes
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="idPACIENTES", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $codigo
     *
     * @ORM\Column(name="Codigo", type="string", length=100, nullable=true)
     */
    private $codigo;


    /**
     * @var string $dni
     *
     * @ORM\Column(name="DNI", type="string", length=10, nullable=true)
     */
    private $dni;

    /**
     * @var string $nombre
     *
     * @ORM\Column(name="Nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var string $apellido
     *
     * @ORM\Column(name="Apellido", type="string", length=255, nullable=true)
     */
    private $apellido;

    /**
     * @var OS
     *
     * @ORM\ManyToOne(targetEntity="OSs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="OS", referencedColumnName="idOSS")
     * })
     */
    private $os;

    /**
     * @var OS
     *
     * @ORM\ManyToOne(targetEntity="Medicos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="MedicoCabecera", referencedColumnName="idMEDICOS")
     * })
     */
    private $medicocabecera;

    /**
     * @var string $telefono
     * @ORM\Column(name="Telefono", type="string", length=255, nullable=true)     
     */
    private $telefono;

    /**
     * @var string $celular
     * @ORM\Column(name="Celular", type="string", length=255, nullable=true)     
     */
    private $celular;

    /**
     * @var string $email
     * @ORM\Column(name="Email", type="string", length=255, nullable=true)     
     */
    private $email;

    /**
     * @var string $direccion
     * @ORM\Column(name="Direccion", type="string", length=1000, nullable=true)     
     */
    private $direccion;

    /**
     * @ORM\Column(name="FechaNacimiento", type="date", nullable=true)     
     */
    private $fecha_nacimiento;


    /**
     * @var string $sexo
     * @ORM\Column(name="Sexo", type="string", length=1, nullable=true)     
     */
    private $sexo;
    
    /**
     * @var string $observaciones
     * @ORM\Column(name="Observaciones", type="string", length=255, nullable=true)     
     */
    private $observaciones;

    /**
     * @ORM\Column(name="FechaAlta", type="date", nullable=true)     
     */
    private $fecha_alta;

    /**
     * @ORM\OneToMany(targetEntity="Atenciones", mappedBy="paciente")
     */
    protected $atenciones;

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
     * @ORM\ManyToMany(targetEntity="Application\Sonata\ClassificationBundle\Entity\Tag", cascade={"persist"})
     * @ORM\JoinTable(
     *      name="Pacientes_tags",
     *      joinColumns={@ORM\JoinColumn(name="cliente_id", referencedColumnName="idPACIENTES")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")}
     * )
     */    
    protected $tags;

    public function __construct()
    {
        $this->atenciones = new ArrayCollection();
    }

    public function getAtenciones() {
        return $this->atenciones;
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
     * Set nombre
     *
     * @param string $nombre
     * @return Pacientes
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
     * Set codigo
     *
     * @param string $codigo
     * @return Pacientes
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

    /**
     * Set dni
     *
     * @param string $dni
     * @return Pacientes
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get dni
     *
     * @return string 
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set apellido
     *
     * @param string $apellido
     * @return Pacientes
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string 
     */
    public function getApellido()
    {
        return $this->apellido;
    }


    /**
     * Set os
     *
     * @param Circulo\VegaBundle\Entity\Oss $os
     * @return Pacientes
     */
    public function setOS(\Circulo\VegaBundle\Entity\OSs $os = null)
    {
        $this->os = $os;
    
        return $this;
    }

    /**
     * Get os
     *
     * @return Circulo\VegaBundle\Entity\OSs 
     */
    public function getOS()
    {
        return $this->os;
    }

    /**
     * Set medicocabecera
     *
     * @param Circulo\VegaBundle\Entity\Medicos $medicocabecera
     * @return Pacientes
     */
    public function setMedicocabecera(\Circulo\VegaBundle\Entity\Medicos $medicocabecera = null)
    {
        $this->medicocabecera = $medicocabecera;
    
        return $this;
    }

    /**
     * Get medicocabecera
     *
     * @return Circulo\VegaBundle\Entity\OSs 
     */
    public function getMedicocabecera()
    {
        return $this->medicocabecera;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Pacientes
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set celular
     *
     * @param string $celular
     * @return Pacientes
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;

        return $this;
    }

    /**
     * Get celular
     *
     * @return string 
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Pacientes
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Pacientes
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Get fecha_nacimiento
     *
     * @return \DateTime 
     */
    public function getFechaNacimiento()
    {
        return $this->fecha_nacimiento;
    }
    
    /**
     * Set fecha_nacimiento
     *
     * @param \DateTime $fecha_nacimiento
     * @return Pacientes
     */
    public function setFechaNacimiento($fecha_nacimiento)
    {
        $this->fecha_nacimiento = $fecha_nacimiento;

        return $this;
    }

    /**
     * Get fecha_alta
     *
     * @return \DateTime 
     */
    public function getFechaAlta()
    {
        return $this->fecha_alta;
    }


    /**
     * Set fecha_alta
     *
     * @param \DateTime $fecha_alta
     * @return Pacientes
     */
    public function setFechaAlta($fecha_alta)
    {
        $this->fecha_alta = $fecha_alta;

        return $this;
    }



    /**
     * Set sexo
     *
     * @param string $sexo
     * @return Pacientes
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get sexo
     *
     * @return string 
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return Pacientes
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string 
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }            

    public function __toString()
    {
        return $this->dni . '-' . $this->apellido . ', ' . $this->nombre;
    }

    public function getNombreos()
    {
        return $this->nombre . " - " . $this->os;
    }

    public function getCodigoos()
    {
        return $this->codigo . " - " . $this->os;
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

    /**
     * Set tags
     *
     * @param Application\Sonata\ClassificationBundle\Entity\Tag $tag
     * @return Clientes
     */
    public function setTags(\Application\Sonata\ClassificationBundle\Entity\Tag $tag = null)
    {
        $this->tags[] = $tag;

        return $this;
    }


    public function getTags() {
        return $this->tags;
    }

    /**
     * Add tag
     *
     * @param \Application\Sonata\ClassificationBundle\Entity\TagInterface  $tag
     * @return Clientes
     */
    public function addTag(Tag $tag)
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Remove tag
     *
     * @param \Application\Sonata\ClassificationBundle\Entity\TagInterface $tag
     */
    public function removeTag(Tag $tag)
    {
        $this->tags->removeElement($tag);
    }    
}
