<?php

namespace Circulo\VegaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Entity
 * @ORM\Table(name="Atenciones")
 */
class Atenciones
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="idATENCIONES", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
    */
    private $id;

    /**
     * @ORM\Column(name="Fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @ORM\Column(name="Motivo", type="string", nullable=true)
     */
    private $motivo;

    /**
     * @var Paciente
     *
     * @ORM\ManyToOne(targetEntity="Pacientes", inversedBy="atenciones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Pacientes", referencedColumnName="idPACIENTES")
     * })
     */
    private $paciente;

    /**
     * @var Medico
          *
          * @ORM\ManyToOne(targetEntity="Medicos")
          * @ORM\JoinColumns({
          *   @ORM\JoinColumn(name="Medicos", referencedColumnName="idMEDICOS")
          * })     
    */
    private $medico;

    /**
     * @ORM\Column(name="AgudezaVisual", type="string", nullable=true)
     */
    private $agudeza_visual;

    /**
     * @ORM\Column(name="AgudezaVisualSP", type="boolean", nullable=true)
     */
    private $agudeza_visual_SP;

    /**
     * @ORM\Column(name="SinCorreccionOpticaOjoIzquierdo", type="string", nullable=true)
     */
    private $sin_correccion_ojo_izquierdo;

    /**
     * @ORM\Column(name="SinCorreccionOpticaOjoDerecho", type="string", nullable=true)
     */
    private $sin_correccion_ojo_derecho;

    /**
     * @ORM\Column(name="ConCorreccionOpticaOjoIzquierdo", type="string", nullable=true)
     */
    private $con_correccion_ojo_izquierdo;

    /**
     * @ORM\Column(name="ConCorreccionOpticaOjoDerecho", type="string", nullable=true)
     */
    private $con_correccion_ojo_derecho;

    /**
     * @ORM\Column(name="Tonometria", type="string", nullable=true)
     */
    private $tonometria;

    /**
     * @ORM\Column(name="TonometriaSP", type="boolean", nullable=true)
     */
    private $tonometria_SP;

    /**
     * @ORM\Column(name="Biomicroscopia", type="string", nullable=true)
     */
    private $biomicroscopia;

    /**
     * @ORM\Column(name="BiomicroscopiaSP", type="boolean", nullable=true)
     */
    private $biomicroscopia_SP;

    /**
     * @ORM\Column(name="FondoOjo", type="string", nullable=true)
     */
    private $fondo_ojo; 

    /**
     * @ORM\Column(name="FondoOjoSP", type="boolean", nullable=true)
     */
    private $fondo_ojo_SP;

    /**
     * @ORM\Column(name="Antecedentes", type="string", nullable=true)
     */
    private $antecedentes;

    /**
     * @ORM\Column(name="Observaciones", type="string", nullable=true)
     */
    private $observaciones;

    /**
     * @ORM\Column(name="Terminada", type="boolean", nullable=true)
     */
    private $terminada;

    /**
     * @ORM\OneToMany(targetEntity="Practicas", mappedBy="atencion")
     */
    protected $practicas;

    /**
     * @ORM\Column(name="NotaProximaAtencion", type="string", nullable=true)
     */
    private $nota_proxima_atencion;
 
     /**
     * @ORM\Column(name="ProximaAtencion", type="datetime", nullable=true)
     */
    private $fecha_proxima_atencion;



    public function __construct()
    {
        $this->practicas = new ArrayCollection();
    }

    public function getPracticas() {
        return $this->practicas;
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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Atenciones
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
     * Set motivo
     *
     * @param string $motivo
     * @return Atenciones
     */
    public function setMotivo($motivo)
    {
        $this->motivo = $motivo;

        return $this;
    }

    /**
     * Get motivo
     *
     * @return string 
     */
    public function getMotivo()
    {
        return $this->motivo;
    }

    /**
     * Set paciente
     *
     * @param integer $paciente
     * @return Atenciones
     */
    public function setPaciente($paciente)
    {
        $this->paciente = $paciente;

        return $this;
    }

    /**
     * Get paciente
     *
     * @return integer 
     */
    public function getPaciente()
    {
        return $this->paciente;
    }

    /**
     * Set medico
     *
     * @param integer $medico
     * @return Atenciones
     */
    public function setMedico($medico)
    {
        $this->medico = $medico;

        return $this;
    }

    /**
     * Get medico
     *
     * @return integer 
     */
    public function getMedico()
    {
        return $this->medico;
    }

    /**
     * Set agudeza_visual
     *
     * @param string $agudeza_visual
     * @return Atenciones
     */
    public function setAgudezaVisual($agudeza_visual)
    {
        $this->agudeza_visual = $agudeza_visual;

        return $this;
    }

    /**
     * Get agudeza_visual
     *
     * @return string 
     */
    public function getAgudezaVisual()
    {
        return $this->agudeza_visual;
    }

    /**
     * Set agudeza_visual_SP
     *
     * @param string $agudeza_visual_SP
     * @return Atenciones
     */
    public function setAgudezavisualSP($agudeza_visual_SP)
    {
        $this->agudeza_visual_SP = $agudeza_visual_SP;

        return $this;
    }

    /**
     * Get agudeza_visual_SP
     *
     * @return string 
     */
    public function getAgudezavisualSP()
    {
        return $this->agudeza_visual_SP;
    }

    /**
     * Set sin_correccion_ojo_izquierdo
     *
     * @param string $sin_correccion_ojo_izquierdo
     * @return Atenciones
     */
    public function setSincorreccionojoizquierdo($sin_correccion_ojo_izquierdo)
    {
        $this->sin_correccion_ojo_izquierdo = $sin_correccion_ojo_izquierdo;

        return $this;
    }

    /**
     * Get sin_correccion_ojo_izquierdo
     *
     * @return string 
     */
    public function getSincorreccionojoizquierdo()
    {
        return $this->sin_correccion_ojo_izquierdo;
    }

    /**
     * Set sin_correccion_ojo_derecho
     *
     * @param string $sin_correccion_ojo_derecho
     * @return Atenciones
     */
    public function setSincorreccionojoderecho($sin_correccion_ojo_derecho)
    {
        $this->sin_correccion_ojo_derecho = $sin_correccion_ojo_derecho;

        return $this;
    }

    /**
     * Get sin_correccion_ojo_derecho
     *
     * @return string 
     */
    public function getSincorreccionojoderecho()
    {
        return $this->sin_correccion_ojo_derecho;
    }

    /**
     * Set con_correccion_ojo_izquierdo
     *
     * @param string $con_correccion_ojo_izquierdo
     * @return Atenciones
     */
    public function setConcorreccionojoizquierdo($con_correccion_ojo_izquierdo)
    {
        $this->con_correccion_ojo_izquierdo = $con_correccion_ojo_izquierdo;

        return $this;
    }

    /**
     * Get con_correccion_ojo_izquierdo
     *
     * @return string 
     */
    public function getConcorreccionojoizquierdo()
    {
        return $this->con_correccion_ojo_izquierdo;
    }

    /**
     * Set con_correccion_ojo_derecho
     *
     * @param string $con_correccion_ojo_derecho
     * @return Atenciones
     */
    public function setConcorreccionojoderecho($con_correccion_ojo_derecho)
    {
        $this->con_correccion_ojo_derecho = $con_correccion_ojo_derecho;

        return $this;
    }

    /**
     * Get con_correccion_ojo_derecho
     *
     * @return string 
     */
    public function getConcorreccionojoderecho()
    {
        return $this->con_correccion_ojo_derecho;
    }


    /**
     * Set tonometría
     *
     * @param string $tonometría
     * @return Atenciones
     */
    public function setTonometria($tonometria)
    {
        $this->tonometria = $tonometria;

        return $this;
    }

    /**
     * Get tonometría
     *
     * @return string 
     */
    public function getTonometria()
    {
        return $this->tonometria;
    }

    /**
     * Set tonometria_SP
     *
     * @param string $tonometria_SP
     * @return Atenciones
     */
    public function setTonometriaSP($tonometria_SP)
    {
        $this->tonometria_SP = $tonometria_SP;

        return $this;
    }

    /**
     * Get tonometria_SP
     *
     * @return string 
     */
    public function getTonometriaSP()
    {
        return $this->tonometria_SP;
    }

    /**
     * Set biomicroscopia
     *
     * @param string $biomicroscopia
     * @return Atenciones
     */
    public function setBiomicroscopia($biomicroscopia)
    {
        $this->biomicroscopia = $biomicroscopia;

        return $this;
    }

    /**
     * Get biomicroscopía
     *
     * @return string 
     */
    public function getBiomicroscopia()
    {
        return $this->biomicroscopia;
    }

    /**
     * Set biomicroscopia_SP
     *
     * @param string $biomicroscopia_SP
     * @return Atenciones
     */
    public function setBiomicroscopiaSP($biomicroscopia_SP)
    {
        $this->biomicroscopia_SP = $biomicroscopia_SP;

        return $this;
    }

    /**
     * Get biomicroscopia_SP
     *
     * @return string 
     */
    public function getBiomicroscopiaSP()
    {
        return $this->biomicroscopia_SP;
    }

    /**
     * Set fondo_ojo
     *
     * @param string $fondo_ojo
     * @return Atenciones
     */
    public function setFondoOjo($fondo_ojo)
    {
        $this->fondo_ojo = $fondo_ojo;

        return $this;
    }

    /**
     * Get fondo_ojo
     *
     * @return string 
     */
    public function getFondoOjo()
    {
        return $this->fondo_ojo;
    }

    /**
     * Set fondo_ojo_SP
     *
     * @param string $fondo_ojo_SP
     * @return Atenciones
     */
    public function setFondoojoSP($fondo_ojo_SP)
    {
        $this->fondo_ojo_SP = $fondo_ojo_SP;

        return $this;
    }

    /**
     * Get fondo_ojo_SP
     *
     * @return string 
     */
    public function getFondoojoSP()
    {
        return $this->fondo_ojo_SP;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return Atenciones
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

    /**
     * Set antecedentes
     *
     * @param string $antecedentes
     * @return Atenciones
     */
    public function setAntecedentes($antecedentes)
    {
        $this->antecedentes = $antecedentes;

        return $this;
    }

    /**
     * Get antecedentes
     *
     * @return string 
     */
    public function getAntecedentes()
    {
        return $this->antecedentes;
    }

    /**
     * Set terminada
     *
     * @param string $terminada
     * @return Atenciones
     */
    public function setTerminada($terminada)
    {
        $this->terminada = $terminada;

        return $this;
    }

    /**
     * Get terminada
     *
     * @return string 
     */
    public function getTerminada()
    {
        return $this->terminada;
    }

    /**
     * Set nota_proxima_atencion
     *
     * @param string $nota_proxima_atencion
     * @return Atenciones
     */
    public function setNotaproximaatencion($nota_proxima_atencion)
    {
        $this->nota_proxima_atencion = $nota_proxima_atencion;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string 
     */
    public function getNotaproximaatencion()
    {
        return $this->nota_proxima_atencion;
    }

    /**
     * Set fecha_proxima_atencion
     *
     * @param \DateTime $fecha_proxima_atencion
     * @return Atenciones
     */
    public function setFechaproximaatencion($fecha_proxima_atencion)
    {
        $this->fecha_proxima_atencion = $fecha_proxima_atencion;

        return $this;
    }

    /**
     * Get fecha_proxima_atencion
     *
     * @return \DateTime 
     */
    public function getFechaproximaatencion()
    {
        return $this->fecha_proxima_atencion;
    }


    public function __toString()
    {
        if ($this->paciente ) {
            return $this->paciente->getCodigo() . '-' . $this->fecha->format('d/M/Y') ;
        }else
        {
            return $this->id;
        }
        
    }    
}
