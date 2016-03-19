<?php

namespace Aoa\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
 * Especie
 *
 * @Table(name="especie", indexes={@Index(name="idx_especie_abundancia_id", columns={"distribucion_ab_id"}), @Index(name="idx_especie_estatus_cuantitativo_ab_id", columns={"estatus_cuantitativo_ab_id"}), @Index(name="idx_especie_proteccion_clm_id", columns={"proteccion_clm_id"}), @Index(name="idx_especie_proteccion_lr_id", columns={"proteccion_lr_id"}), @Index(name="idx_especie_familia_id", columns={"familia_id"}), @Index(name="idx_especie_clasificacion_criterio_esp_id", columns={"clasificacion_criterio_esp_id"}), @Index(name="fk_especie_estatus_reproductivo_ab_id", columns={"estatus_reproductivo_ab_id"})})
 * @Entity
 */
class Especie
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
     * @var string
     *
     * @Column(name="codigo", type="string", length=3, nullable=true)
     */
    private $codigo;

    /**
     * @var string
     *
     * @Column(name="categoria", type="string", length=4, nullable=true)
     */
    private $categoria;

    /**
     * @var string
     *
     * @Column(name="codigoPresenteCanarias", type="string", length=4, nullable=true)
     */
    private $codigoPresenteCanarias;

    /**
     * @var string
     *
     * @Column(name="codigoPresentePiYBaleares", type="string", length=4, nullable=true)
     */
    private $codigoPresentePiyBaleares;

    /**
     * @var string
     *
     * @Column(name="nombreComun", type="string", length=250, nullable=false)
     */
    private $nombreComun;

    /**
     * @var string
     *
     * @Column(name="nombreIngles", type="string", length=250, nullable=false)
     */
    private $nombreIngles;

    /**
     * @var integer
     *
     * @Column(name="codigoEuring", type="integer", nullable=true)
     */
    private $codigoEuring;

    /**
     * @var integer
     *
     * @Column(name="codigoAerc", type="integer", nullable=true)
     */
    private $codigoAerc;

    /**
     * @var integer
     *
     * @Column(name="indRareza", type="integer", nullable=true)
     */
    private $indRareza;

    /**
     * @var string
     *
     * @Column(name="comentarioHistorico", type="text", nullable=true)
     */
    private $comentarioHistorico;

    /**
     * @var string
     *
     * @Column(name="codigoEstatusEsp", type="string", length=20, nullable=true)
     */
    private $codigoEstatusEsp;

    /**
     * @var boolean
     *
     * @Column(name="indCitadaAlbacete", type="boolean", nullable=true)
     */
    private $indCitadaAlbacete;

    /**
     * @var string
     *
     * @Column(name="genero", type="string", length=100, nullable=false)
     */
    private $genero;

    /**
     * @var string
     *
     * @Column(name="especie", type="string", length=100, nullable=false)
     */
    private $especie;

    /**
     * @var string
     *
     * @Column(name="subespecie", type="string", length=100, nullable=true)
     */
    private $subespecie;

    /**
     * @var string
     *
     * @Column(name="estatus", type="text", nullable=true)
     */
    private $estatus;

    /**
     * @var string
     *
     * @Column(name="reproduccion", type="text", nullable=true)
     */
    private $reproduccion;

    /**
     * @var string
     *
     * @Column(name="poblacion", type="text", nullable=true)
     */
    private $poblacion;

    /**
     * @var string
     *
     * @Column(name="distribucion", type="text", nullable=true)
     */
    private $distribucion;

    /**
     * @var string
     *
     * @Column(name="habitat", type="text", nullable=true)
     */
    private $habitat;

    /**
     * @var string
     *
     * @Column(name="migracion", type="text", nullable=true)
     */
    private $migracion;

    /**
     * @var string
     *
     * @Column(name="amenazas", type="text", nullable=true)
     */
    private $amenazas;

    /**
     * @var ProteccionClm
     *
     * @ManyToOne(targetEntity="ProteccionClm")
     * @JoinColumns({
     *   @JoinColumn(name="proteccion_clm_id", referencedColumnName="id")
     * })
     */
    private $proteccionClm;

    /**
     * @var ProteccionLr
     *
     * @ManyToOne(targetEntity="ProteccionLr")
     * @JoinColumns({
     *   @JoinColumn(name="proteccion_lr_id", referencedColumnName="id")
     * })
     */
    private $proteccionLr;

    /**
     * @var Familia
     *
     * @ManyToOne(targetEntity="Familia")
     * @JoinColumns({
     *   @JoinColumn(name="familia_id", referencedColumnName="id")
     * })
     */
    private $familia;

    /**
     * @var EstatusReproductivoAb
     *
     * @ManyToOne(targetEntity="EstatusReproductivoAb")
     * @JoinColumns({
     *   @JoinColumn(name="estatus_reproductivo_ab_id", referencedColumnName="id")
     * })
     */
    private $estatusReproductivoAb;

    /**
     * @var DistribucionAb
     *
     * @ManyToOne(targetEntity="DistribucionAb")
     * @JoinColumns({
     *   @JoinColumn(name="distribucion_ab_id", referencedColumnName="id")
     * })
     */
    private $distribucionAb;

    /**
     * @var EstatusCuantitativoAb
     *
     * @ManyToOne(targetEntity="EstatusCuantitativoAb")
     * @JoinColumns({
     *   @JoinColumn(name="estatus_cuantitativo_ab_id", referencedColumnName="id")
     * })
     */
    private $estatusCuantitativoAb;

    /**
     * @var ClasificacionCriterioEsp
     *
     * @ManyToOne(targetEntity="ClasificacionCriterioEsp")
     * @JoinColumns({
     *   @JoinColumn(name="clasificacion_criterio_esp_id", referencedColumnName="id")
     * })
     */
    private $clasificacionCriterioEsp;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ManyToMany(targetEntity="Privacidad", inversedBy="idEspecie")
     * @JoinTable(name="aso_especie_privacidad",
     *   joinColumns={
     *     @JoinColumn(name="id_especie_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @JoinColumn(name="id_privacidad_id", referencedColumnName="id")
     *   }
     * )
     */
    private $idPrivacidad;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idPrivacidad = new ArrayCollection();
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
     * Set codigo
     *
     * @param string $codigo
     * @return Especie
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
     * Set categoria
     *
     * @param string $categoria
     * @return Especie
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return string 
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set codigoPresenteCanarias
     *
     * @param string $codigoPresenteCanarias
     * @return Especie
     */
    public function setCodigoPresenteCanarias($codigoPresenteCanarias)
    {
        $this->codigoPresenteCanarias = $codigoPresenteCanarias;

        return $this;
    }

    /**
     * Get codigoPresenteCanarias
     *
     * @return string 
     */
    public function getCodigoPresenteCanarias()
    {
        return $this->codigoPresenteCanarias;
    }

    /**
     * Set codigoPresentePiyBaleares
     *
     * @param string $codigoPresentePiyBaleares
     * @return Especie
     */
    public function setCodigoPresentePiyBaleares($codigoPresentePiyBaleares)
    {
        $this->codigoPresentePiyBaleares = $codigoPresentePiyBaleares;

        return $this;
    }

    /**
     * Get codigoPresentePiyBaleares
     *
     * @return string 
     */
    public function getCodigoPresentePiyBaleares()
    {
        return $this->codigoPresentePiyBaleares;
    }

    /**
     * Set nombreComun
     *
     * @param string $nombreComun
     * @return Especie
     */
    public function setNombreComun($nombreComun)
    {
        $this->nombreComun = $nombreComun;

        return $this;
    }

    /**
     * Get nombreComun
     *
     * @return string 
     */
    public function getNombreComun()
    {
        return $this->nombreComun;
    }

    /**
     * Set nombreIngles
     *
     * @param string $nombreIngles
     * @return Especie
     */
    public function setNombreIngles($nombreIngles)
    {
        $this->nombreIngles = $nombreIngles;

        return $this;
    }

    /**
     * Get nombreIngles
     *
     * @return string 
     */
    public function getNombreIngles()
    {
        return $this->nombreIngles;
    }

    /**
     * Set codigoEuring
     *
     * @param integer $codigoEuring
     * @return Especie
     */
    public function setCodigoEuring($codigoEuring)
    {
        $this->codigoEuring = $codigoEuring;

        return $this;
    }

    /**
     * Get codigoEuring
     *
     * @return integer 
     */
    public function getCodigoEuring()
    {
        return $this->codigoEuring;
    }

    /**
     * Set codigoAerc
     *
     * @param integer $codigoAerc
     * @return Especie
     */
    public function setCodigoAerc($codigoAerc)
    {
        $this->codigoAerc = $codigoAerc;

        return $this;
    }

    /**
     * Get codigoAerc
     *
     * @return integer 
     */
    public function getCodigoAerc()
    {
        return $this->codigoAerc;
    }

    /**
     * Set indRareza
     *
     * @param integer $indRareza
     * @return Especie
     */
    public function setIndRareza($indRareza)
    {
        $this->indRareza = $indRareza;

        return $this;
    }

    /**
     * Get indRareza
     *
     * @return integer 
     */
    public function getIndRareza()
    {
        return $this->indRareza;
    }

    /**
     * Set comentarioHistorico
     *
     * @param string $comentarioHistorico
     * @return Especie
     */
    public function setComentarioHistorico($comentarioHistorico)
    {
        $this->comentarioHistorico = $comentarioHistorico;

        return $this;
    }

    /**
     * Get comentarioHistorico
     *
     * @return string 
     */
    public function getComentarioHistorico()
    {
        return $this->comentarioHistorico;
    }

    /**
     * Set codigoEstatusEsp
     *
     * @param string $codigoEstatusEsp
     * @return Especie
     */
    public function setCodigoEstatusEsp($codigoEstatusEsp)
    {
        $this->codigoEstatusEsp = $codigoEstatusEsp;

        return $this;
    }

    /**
     * Get codigoEstatusEsp
     *
     * @return string 
     */
    public function getCodigoEstatusEsp()
    {
        return $this->codigoEstatusEsp;
    }

    /**
     * Set indCitadaAlbacete
     *
     * @param boolean $indCitadaAlbacete
     * @return Especie
     */
    public function setIndCitadaAlbacete($indCitadaAlbacete)
    {
        $this->indCitadaAlbacete = $indCitadaAlbacete;

        return $this;
    }

    /**
     * Get indCitadaAlbacete
     *
     * @return boolean 
     */
    public function getIndCitadaAlbacete()
    {
        return $this->indCitadaAlbacete;
    }

    /**
     * Set genero
     *
     * @param string $genero
     * @return Especie
     */
    public function setGenero($genero)
    {
        $this->genero = $genero;

        return $this;
    }

    /**
     * Get genero
     *
     * @return string 
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * Set especie
     *
     * @param string $especie
     * @return Especie
     */
    public function setEspecie($especie)
    {
        $this->especie = $especie;

        return $this;
    }

    /**
     * Get especie
     *
     * @return string 
     */
    public function getEspecie()
    {
        return $this->especie;
    }

    /**
     * Set subespecie
     *
     * @param string $subespecie
     * @return Especie
     */
    public function setSubespecie($subespecie)
    {
        $this->subespecie = $subespecie;

        return $this;
    }

    /**
     * Get subespecie
     *
     * @return string 
     */
    public function getSubespecie()
    {
        return $this->subespecie;
    }

    /**
     * Set estatus
     *
     * @param string $estatus
     * @return Especie
     */
    public function setEstatus($estatus)
    {
        $this->estatus = $estatus;

        return $this;
    }

    /**
     * Get estatus
     *
     * @return string 
     */
    public function getEstatus()
    {
        return $this->estatus;
    }

    /**
     * Set reproduccion
     *
     * @param string $reproduccion
     * @return Especie
     */
    public function setReproduccion($reproduccion)
    {
        $this->reproduccion = $reproduccion;

        return $this;
    }

    /**
     * Get reproduccion
     *
     * @return string 
     */
    public function getReproduccion()
    {
        return $this->reproduccion;
    }

    /**
     * Set poblacion
     *
     * @param string $poblacion
     * @return Especie
     */
    public function setPoblacion($poblacion)
    {
        $this->poblacion = $poblacion;

        return $this;
    }

    /**
     * Get poblacion
     *
     * @return string 
     */
    public function getPoblacion()
    {
        return $this->poblacion;
    }

    /**
     * Set distribucion
     *
     * @param string $distribucion
     * @return Especie
     */
    public function setDistribucion($distribucion)
    {
        $this->distribucion = $distribucion;

        return $this;
    }

    /**
     * Get distribucion
     *
     * @return string 
     */
    public function getDistribucion()
    {
        return $this->distribucion;
    }

    /**
     * Set habitat
     *
     * @param string $habitat
     * @return Especie
     */
    public function setHabitat($habitat)
    {
        $this->habitat = $habitat;

        return $this;
    }

    /**
     * Get habitat
     *
     * @return string 
     */
    public function getHabitat()
    {
        return $this->habitat;
    }

    /**
     * Set migracion
     *
     * @param string $migracion
     * @return Especie
     */
    public function setMigracion($migracion)
    {
        $this->migracion = $migracion;

        return $this;
    }

    /**
     * Get migracion
     *
     * @return string 
     */
    public function getMigracion()
    {
        return $this->migracion;
    }

    /**
     * Set amenazas
     *
     * @param string $amenazas
     * @return Especie
     */
    public function setAmenazas($amenazas)
    {
        $this->amenazas = $amenazas;

        return $this;
    }

    /**
     * Get amenazas
     *
     * @return string 
     */
    public function getAmenazas()
    {
        return $this->amenazas;
    }

    /**
     * Set proteccionClm
     *
     * @param ProteccionClm $proteccionClm
     * @return Especie
     */
    public function setProteccionClm(ProteccionClm $proteccionClm = null)
    {
        $this->proteccionClm = $proteccionClm;

        return $this;
    }

    /**
     * Get proteccionClm
     *
     * @return ProteccionClm
     */
    public function getProteccionClm()
    {
        return $this->proteccionClm;
    }

    /**
     * Set proteccionLr
     *
     * @param ProteccionLr $proteccionLr
     * @return Especie
     */
    public function setProteccionLr(ProteccionLr $proteccionLr = null)
    {
        $this->proteccionLr = $proteccionLr;

        return $this;
    }

    /**
     * Get proteccionLr
     *
     * @return ProteccionLr
     */
    public function getProteccionLr()
    {
        return $this->proteccionLr;
    }

    /**
     * Set familia
     *
     * @param Familia $familia
     * @return Especie
     */
    public function setFamilia(Familia $familia = null)
    {
        $this->familia = $familia;

        return $this;
    }

    /**
     * Get familia
     *
     * @return Familia
     */
    public function getFamilia()
    {
        return $this->familia;
    }

    /**
     * Set estatusReproductivoAb
     *
     * @param EstatusReproductivoAb $estatusReproductivoAb
     * @return Especie
     */
    public function setEstatusReproductivoAb(EstatusReproductivoAb $estatusReproductivoAb = null)
    {
        $this->estatusReproductivoAb = $estatusReproductivoAb;

        return $this;
    }

    /**
     * Get estatusReproductivoAb
     *
     * @return EstatusReproductivoAb
     */
    public function getEstatusReproductivoAb()
    {
        return $this->estatusReproductivoAb;
    }

    /**
     * Set distribucionAb
     *
     * @param DistribucionAb $distribucionAb
     * @return Especie
     */
    public function setDistribucionAb(DistribucionAb $distribucionAb = null)
    {
        $this->distribucionAb = $distribucionAb;

        return $this;
    }

    /**
     * Get distribucionAb
     *
     * @return DistribucionAb
     */
    public function getDistribucionAb()
    {
        return $this->distribucionAb;
    }

    /**
     * Set estatusCuantitativoAb
     *
     * @param EstatusCuantitativoAb $estatusCuantitativoAb
     * @return Especie
     */
    public function setEstatusCuantitativoAb(EstatusCuantitativoAb $estatusCuantitativoAb = null)
    {
        $this->estatusCuantitativoAb = $estatusCuantitativoAb;

        return $this;
    }

    /**
     * Get estatusCuantitativoAb
     *
     * @return EstatusCuantitativoAb
     */
    public function getEstatusCuantitativoAb()
    {
        return $this->estatusCuantitativoAb;
    }

    /**
     * Set clasificacionCriterioEsp
     *
     * @param ClasificacionCriterioEsp $clasificacionCriterioEsp
     * @return Especie
     */
    public function setClasificacionCriterioEsp(ClasificacionCriterioEsp $clasificacionCriterioEsp = null)
    {
        $this->clasificacionCriterioEsp = $clasificacionCriterioEsp;

        return $this;
    }

    /**
     * Get clasificacionCriterioEsp
     *
     * @return ClasificacionCriterioEsp
     */
    public function getClasificacionCriterioEsp()
    {
        return $this->clasificacionCriterioEsp;
    }

    /**
     * Add idPrivacidad
     *
     * @param Privacidad $idPrivacidad
     * @return Especie
     */
    public function addIdPrivacidad(Privacidad $idPrivacidad)
    {
        $this->idPrivacidad[] = $idPrivacidad;

        return $this;
    }

    /**
     * Remove idPrivacidad
     *
     * @param Privacidad $idPrivacidad
     */
    public function removeIdPrivacidad(Privacidad $idPrivacidad)
    {
        $this->idPrivacidad->removeElement($idPrivacidad);
    }

    /**
     * Get idPrivacidad
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdPrivacidad()
    {
        return $this->idPrivacidad;
    }
}
