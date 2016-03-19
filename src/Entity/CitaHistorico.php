<?php

namespace Aoa\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Index;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinColumns;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

/**
 * CitaHistorico
 *
 * @Table(name="cita_historico", indexes={
 *     @Index(name="idx_cita_historico_cita_id", columns={"cita_id"}),
 *     @Index(name="idx_cita_historico_lugar_id", columns={"lugar_id"}),
 *     @Index(name="idx_cita_historico_clase_reproduccion_id", columns={"clase_reproduccion_id"}),
 *     @Index(name="idx_cita_historico_fuente_id", columns={"fuente_id"}),
 *     @Index(name="idx_cita_historico_especie_id", columns={"especie_id"}),
 *     @Index(name="idx_cita_historico_criterio_seleccion_cita_id", columns={"criterio_seleccion_cita_id"}),
 *     @Index(name="idx_cita_historico_observador_principal_id", columns={"observador_principal_id"}),
 *     @Index(name="fk_cita_historico_importancia_cita_id_idx", columns={"importancia_cita_id"}),
 *     @Index(name="fk_cita_historico_estudio_id_idx", columns={"estudio_id"})
 * })
 * @Entity
 */
class CitaHistorico
{
    /**
     * @var \DateTime
     *
     * @Column(name="fechaHistorico", type="datetime", nullable=false)
     */
    private $fechaHistorico;

    /**
     * @var string
     *
     * @Column(name="usuarioHistorico", type="string", length=250, nullable=false)
     */
    private $usuarioHistorico;

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
    private $indHabitatraro;

    /**
     * @var boolean
     *
     * @Column(name="indCriaHabitatRaro", type="boolean", nullable=true)
     */
    private $indCriaHabitatraro;

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
     * @var integer
     *
     * @Column(name="id", type="integer")
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

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
     * @var Fuente
     *
     * @ManyToOne(targetEntity="Fuente")
     * @JoinColumns({
     *   @JoinColumn(name="fuente_id", referencedColumnName="id")
     * })
     */
    private $fuente;

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
     * @var ClaseReproduccion
     *
     * @ManyToOne(targetEntity="ClaseReproduccion")
     * @JoinColumns({
     *   @JoinColumn(name="clase_reproduccion_id", referencedColumnName="id")
     * })
     */
    private $claseReproduccion;

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
     * @var Cita
     *
     * @ManyToOne(targetEntity="Cita")
     * @JoinColumns({
     *   @JoinColumn(name="cita_id", referencedColumnName="id")
     * })
     */
    private $cita;



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
     * Set fechaHistorico
     *
     * @param \DateTime $fechaHistorico
     * @return CitaHistorico
     */
    public function setFechaHistorico($fechaHistorico)
    {
        $this->fechaHistorico = $fechaHistorico;

        return $this;
    }

    /**
     * Get fechaHistorico
     *
     * @return \DateTime 
     */
    public function getFechaHistorico()
    {
        return $this->fechaHistorico;
    }

    /**
     * Set usuarioHistorico
     *
     * @param string $usuarioHistorico
     * @return CitaHistorico
     */
    public function setUsuarioHistorico($usuarioHistorico)
    {
        $this->usuarioHistorico = $usuarioHistorico;

        return $this;
    }

    /**
     * Get usuarioHistorico
     *
     * @return string 
     */
    public function getUsuarioHistorico()
    {
        return $this->usuarioHistorico;
    }

    /**
     * Set fechaAlta
     *
     * @param \DateTime $fechaAlta
     * @return CitaHistorico
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
     * @return CitaHistorico
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
     * @return CitaHistorico
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
     * @return CitaHistorico
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
     * @return CitaHistorico
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
     * @param boolean $indHabitatraro
     * @return CitaHistorico
     */
    public function setIndHabitatraro($indHabitatraro)
    {
        $this->indHabitatraro = $indHabitatraro;

        return $this;
    }

    /**
     * Get indHabitatRaro
     *
     * @return boolean 
     */
    public function getIndHabitatraro()
    {
        return $this->indHabitatraro;
    }

    /**
     * Set indCriaHabitatRaro
     *
     * @param boolean $indCriaHabitatraro
     * @return CitaHistorico
     */
    public function setIndCriaHabitatraro($indCriaHabitatraro)
    {
        $this->indCriaHabitatraro = $indCriaHabitatraro;

        return $this;
    }

    /**
     * Get indCriaHabitatRaro
     *
     * @return boolean 
     */
    public function getIndCriaHabitatraro()
    {
        return $this->indCriaHabitatraro;
    }

    /**
     * Set indHerido
     *
     * @param boolean $indHerido
     * @return CitaHistorico
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
     * @return CitaHistorico
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
     * Set indPrivacidad
     *
     * @param boolean $indPrivacidad
     * @return CitaHistorico
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
     * @return CitaHistorico
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
     * Set importanciaCita
     *
     * @param ImportanciaCita $importanciaCita
     * @return CitaHistorico
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
     * @return CitaHistorico
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
     * @return CitaHistorico
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
     * Set fuente
     *
     * @param Fuente $fuente
     * @return CitaHistorico
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
     * Set estudio
     *
     * @param Estudio $estudio
     * @return CitaHistorico
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
     * Set claseReproduccion
     *
     * @param ClaseReproduccion $claseReproduccion
     * @return CitaHistorico
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
     * Set criterioSeleccionCita
     *
     * @param CriterioSeleccionCita $criterioSeleccionCita
     * @return CitaHistorico
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
     * @return CitaHistorico
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
     * Set cita
     *
     * @param Cita $cita
     * @return CitaHistorico
     */
    public function setCita(Cita $cita = null)
    {
        $this->cita = $cita;

        return $this;
    }

    /**
     * Get cita
     *
     * @return Cita
     */
    public function getCita()
    {
        return $this->cita;
    }
}
