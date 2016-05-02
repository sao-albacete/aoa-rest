<?php

namespace Aoa\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Index;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinColumns;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

/**
 * Cita
 *
 * @Entity
 * @Table(name="cita", indexes={
 *     @Index(name="idx_cita_especie_id", columns={"especie_id"}),
 *     @Index(name="idx_cita_cri_selec_id", columns={"criterio_seleccion_cita_id"}),
 *     @Index(name="idx_cita_fuente_id", columns={"fuente_id"}),
 *     @Index(name="idx_cita_lugar_id", columns={"lugar_id"}),
 *     @Index(name="idx_cita_clase_reproduccion_id", columns={"clase_reproduccion_id"}),
 *     @Index(name="idx_cita_observador_id", columns={"observador_principal_id"}),
 *     @Index(name="idx_cita_importancia_cita_id", columns={"importancia_cita_id"}),
 *     @Index(name="fk_cita_estudio_id_idx", columns={"estudio_id"})
 * })
 */
class Cita
{
    /**
     * @var integer
     *
     * @Column(name="id", type="integer")
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @var \DateTime
     *
     * @Column(name="fechaAlta", type="datetime", nullable=false)
     */
    private $fechaAlta;

    /**
     * @var integer
     *
     * @Column(name="cantidad", type="integer", nullable=false)
     */
    private $cantidad;

    /**
     * @var string
     *
     * @Column(name="observaciones", type="text", nullable=true)
     */
    private $observaciones;

    /**
     * @var boolean
     *
     * @Column(name="indSeleccionada", type="boolean", nullable=true)
     */
    private $indSeleccionada;

    /**
     * @var integer
     *
     * @Column(name="indRarezaHomologada", type="integer", nullable=true)
     */
    private $indRarezaHomologada;

    /**
     * @var boolean
     *
     * @Column(name="indHabitatRaro", type="boolean", nullable=true)
     */
    private $indHabitatRaro;

    /**
     * @var boolean
     *
     * @Column(name="indCriaHabitatRaro", type="boolean", nullable=true)
     */
    private $indCriaHabitatRaro;

    /**
     * @var boolean
     *
     * @Column(name="indHerido", type="boolean", nullable=true)
     */
    private $indHerido;

    /**
     * @var boolean
     *
     * @Column(name="indComportamiento", type="boolean", nullable=true)
     */
    private $indComportamiento;

    /**
     * @var boolean
     *
     * @Column(name="indActivo", type="boolean", nullable=true)
     */
    private $indActivo;

    /**
     * @var boolean
     *
     * @Column(name="indPrivacidad", type="boolean", nullable=false)
     */
    private $indPrivacidad;

    /**
     * @var boolean
     *
     * @Column(name="indFoto", type="boolean", nullable=false)
     */
    private $indFoto;

    /**
     * @var \DateTime
     *
     * @Column(name="fechaCreacion", type="datetime", nullable=false)
     */
    private $fechaCreacion;

    /**
     * @var ImportanciaCita
     *
     * @ManyToOne(targetEntity="ImportanciaCita")
     * @JoinColumns({
     *   @JoinColumn(name="importancia_cita_id", referencedColumnName="id")
     * })
     */
    private $importanciaCita;

    /**
     * @var Lugar
     *
     * @ManyToOne(targetEntity="Lugar")
     * @JoinColumns({
     *   @JoinColumn(name="lugar_id", referencedColumnName="id")
     * })
     */
    private $lugar;

    /**
     * @var ObservadorPrincipal
     *
     * @ManyToOne(targetEntity="ObservadorPrincipal")
     * @JoinColumns({
     *   @JoinColumn(name="observador_principal_id", referencedColumnName="id")
     * })
     */
    private $observadorPrincipal;

    /**
     * @var ClaseReproduccion
     *
     * @ManyToOne(targetEntity="ClaseReproduccion")
     * @JoinColumns({
     *   @JoinColumn(name="clase_reproduccion_id", referencedColumnName="id")
     * })
     */
    private $claseReproduccion;

    /**
     * @var Fuente
     *
     * @ManyToOne(targetEntity="Fuente")
     * @JoinColumns({
     *   @JoinColumn(name="fuente_id", referencedColumnName="id")
     * })
     */
    private $fuente;

    /**
     * @var CriterioSeleccionCita
     *
     * @ManyToOne(targetEntity="CriterioSeleccionCita")
     * @JoinColumns({
     *   @JoinColumn(name="criterio_seleccion_cita_id", referencedColumnName="id")
     * })
     */
    private $criterioSeleccionCita;

    /**
     * @var Especie
     *
     * @ManyToOne(targetEntity="Especie")
     * @JoinColumns({
     *   @JoinColumn(name="especie_id", referencedColumnName="id")
     * })
     */
    private $especie;

    /**
     * @var Estudio
     *
     * @ManyToOne(targetEntity="Estudio")
     * @JoinColumns({
     *   @JoinColumn(name="estudio_id", referencedColumnName="id")
     * })
     */
    private $estudio;

    /**
     * @var Collection
     *
     * @ManyToMany(targetEntity="ObservadorSecundario", inversedBy="cita")
     * @JoinTable(name="aso_cita_observador",
     *   joinColumns={
     *     @JoinColumn(name="cita_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @JoinColumn(name="observador_secundario_id", referencedColumnName="id")
     *   }
     * )
     */
    private $observadorSecundario;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->observadorSecundario = new ArrayCollection();
        $this->indRarezaHomologada = 0;
        $this->indSeleccionada = 0;
        $this->indActivo = 1;
        $this->indFoto = 0;
        $this->indPrivacidad = 1;
        $this->fechaCreacion = new \DateTime();
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
     * Set fechaAlta
     *
     * @param \DateTime $fechaAlta
     * @return Cita
     */
    public function setFechaAlta($fechaAlta)
    {
        $this->fechaAlta = $fechaAlta;

        return $this;
    }

    /**
     * Get fechaAlta
     *
     * @return \DateTime 
     */
    public function getFechaAlta()
    {
        return $this->fechaAlta;
    }

    /**
     * Set cantidad
     *
     * @param integer $cantidad
     * @return Cita
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return Cita
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
     * Set indSeleccionada
     *
     * @param boolean $indSeleccionada
     * @return Cita
     */
    public function setIndSeleccionada($indSeleccionada)
    {
        $this->indSeleccionada = $indSeleccionada;

        return $this;
    }

    /**
     * Get indSeleccionada
     *
     * @return boolean 
     */
    public function getIndSeleccionada()
    {
        return $this->indSeleccionada;
    }

    /**
     * Set indRarezaHomologada
     *
     * @param integer $indRarezaHomologada
     * @return Cita
     */
    public function setIndRarezaHomologada($indRarezaHomologada)
    {
        $this->indRarezaHomologada = $indRarezaHomologada;

        return $this;
    }

    /**
     * Get indRarezaHomologada
     *
     * @return integer 
     */
    public function getIndRarezaHomologada()
    {
        return $this->indRarezaHomologada;
    }

    /**
     * Set indHabitatRaro
     *
     * @param boolean $indHabitatRaro
     * @return Cita
     */
    public function setIndHabitatRaro($indHabitatRaro)
    {
        $this->indHabitatRaro = $indHabitatRaro;

        return $this;
    }

    /**
     * Get indHabitatRaro
     *
     * @return boolean 
     */
    public function getIndHabitatRaro()
    {
        return $this->indHabitatRaro;
    }

    /**
     * Set indCriaHabitatRaro
     *
     * @param boolean $indCriaHabitatRaro
     * @return Cita
     */
    public function setIndCriaHabitatRaro($indCriaHabitatRaro)
    {
        $this->indCriaHabitatRaro = $indCriaHabitatRaro;

        return $this;
    }

    /**
     * Get indCriaHabitatRaro
     *
     * @return boolean 
     */
    public function getIndCriaHabitatRaro()
    {
        return $this->indCriaHabitatRaro;
    }

    /**
     * Set indHerido
     *
     * @param boolean $indHerido
     * @return Cita
     */
    public function setIndHerido($indHerido)
    {
        $this->indHerido = $indHerido;

        return $this;
    }

    /**
     * Get indHerido
     *
     * @return boolean 
     */
    public function getIndHerido()
    {
        return $this->indHerido;
    }

    /**
     * Set indComportamiento
     *
     * @param boolean $indComportamiento
     * @return Cita
     */
    public function setIndComportamiento($indComportamiento)
    {
        $this->indComportamiento = $indComportamiento;

        return $this;
    }

    /**
     * Get indComportamiento
     *
     * @return boolean 
     */
    public function getIndComportamiento()
    {
        return $this->indComportamiento;
    }

    /**
     * Set indActivo
     *
     * @param boolean $indActivo
     * @return Cita
     */
    public function setIndActivo($indActivo)
    {
        $this->indActivo = $indActivo;

        return $this;
    }

    /**
     * Get indActivo
     *
     * @return boolean 
     */
    public function getIndActivo()
    {
        return $this->indActivo;
    }

    /**
     * Set indPrivacidad
     *
     * @param boolean $indPrivacidad
     * @return Cita
     */
    public function setIndPrivacidad($indPrivacidad)
    {
        $this->indPrivacidad = $indPrivacidad;

        return $this;
    }

    /**
     * Get indPrivacidad
     *
     * @return boolean 
     */
    public function getIndPrivacidad()
    {
        return $this->indPrivacidad;
    }

    /**
     * Set indFoto
     *
     * @param boolean $indFoto
     * @return Cita
     */
    public function setIndFoto($indFoto)
    {
        $this->indFoto = $indFoto;

        return $this;
    }

    /**
     * Get indFoto
     *
     * @return boolean 
     */
    public function getIndFoto()
    {
        return $this->indFoto;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return Cita
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime 
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set importanciaCita
     *
     * @param ImportanciaCita $importanciaCita
     * @return Cita
     */
    public function setImportanciaCita(ImportanciaCita $importanciaCita = null)
    {
        $this->importanciaCita = $importanciaCita;

        return $this;
    }

    /**
     * Get importanciaCita
     *
     * @return ImportanciaCita
     */
    public function getImportanciaCita()
    {
        return $this->importanciaCita;
    }

    /**
     * Set lugar
     *
     * @param Lugar $lugar
     * @return Cita
     */
    public function setLugar(Lugar $lugar = null)
    {
        $this->lugar = $lugar;

        return $this;
    }

    /**
     * Get lugar
     *
     * @return Lugar
     */
    public function getLugar()
    {
        return $this->lugar;
    }

    /**
     * Set observadorPrincipal
     *
     * @param ObservadorPrincipal $observadorPrincipal
     * @return Cita
     */
    public function setObservadorPrincipal(ObservadorPrincipal $observadorPrincipal = null)
    {
        $this->observadorPrincipal = $observadorPrincipal;

        return $this;
    }

    /**
     * Get observadorPrincipal
     *
     * @return ObservadorPrincipal
     */
    public function getObservadorPrincipal()
    {
        return $this->observadorPrincipal;
    }

    /**
     * Set claseReproduccion
     *
     * @param ClaseReproduccion $claseReproduccion
     * @return Cita
     */
    public function setClaseReproduccion(ClaseReproduccion $claseReproduccion = null)
    {
        $this->claseReproduccion = $claseReproduccion;

        return $this;
    }

    /**
     * Get claseReproduccion
     *
     * @return ClaseReproduccion
     */
    public function getClaseReproduccion()
    {
        return $this->claseReproduccion;
    }

    /**
     * Set fuente
     *
     * @param Fuente $fuente
     * @return Cita
     */
    public function setFuente(Fuente $fuente = null)
    {
        $this->fuente = $fuente;

        return $this;
    }

    /**
     * Get fuente
     *
     * @return Fuente
     */
    public function getFuente()
    {
        return $this->fuente;
    }

    /**
     * Set criterioSeleccionCita
     *
     * @param CriterioSeleccionCita $criterioSeleccionCita
     * @return Cita
     */
    public function setCriterioSeleccionCita(CriterioSeleccionCita $criterioSeleccionCita = null)
    {
        $this->criterioSeleccionCita = $criterioSeleccionCita;

        return $this;
    }

    /**
     * Get criterioSeleccionCita
     *
     * @return CriterioSeleccionCita
     */
    public function getCriterioSeleccionCita()
    {
        return $this->criterioSeleccionCita;
    }

    /**
     * Set especie
     *
     * @param Especie $especie
     * @return Cita
     */
    public function setEspecie(Especie $especie = null)
    {
        $this->especie = $especie;

        return $this;
    }

    /**
     * Get especie
     *
     * @return Especie
     */
    public function getEspecie()
    {
        return $this->especie;
    }

    /**
     * Set estudio
     *
     * @param Estudio $estudio
     * @return Cita
     */
    public function setEstudio(Estudio $estudio = null)
    {
        $this->estudio = $estudio;

        return $this;
    }

    /**
     * Get estudio
     *
     * @return Estudio
     */
    public function getEstudio()
    {
        return $this->estudio;
    }

    /**
     * Add observadorSecundario
     *
     * @param ObservadorSecundario $observadorSecundario
     * @return Cita
     */
    public function addObservadorSecundario(ObservadorSecundario $observadorSecundario)
    {
        $this->observadorSecundario[] = $observadorSecundario;

        return $this;
    }

    /**
     * Remove observadorSecundario
     *
     * @param ObservadorSecundario $observadorSecundario
     */
    public function removeObservadorSecundario(ObservadorSecundario $observadorSecundario)
    {
        $this->observadorSecundario->removeElement($observadorSecundario);
    }

    /**
     * Get observadorSecundario
     *
     * @return Collection
     */
    public function getObservadorSecundario()
    {
        return $this->observadorSecundario;
    }
}
