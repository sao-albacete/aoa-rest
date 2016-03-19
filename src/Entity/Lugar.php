<?php

namespace Aoa\Entity;

use Doctrine\ORM\Mapping as ORM;
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
 * Lugar
 *
 * @Table(name="lugar", indexes={
 *     @Index(name="fk_lugar_municipio_id_idx", columns={"municipio_id"}),
 *     @Index(name="fk_lugar_comarca_id_idx", columns={"comarca_id"}),
 *     @Index(name="fk_lugar_cuadricula_utm_id_idx", columns={"cuadricula_utm_id"}),
 *     @Index(name="fk_lugar_observador_principal_id_idx", columns={"observador_principal_id"})
 * })
 * @Entity
 */
class Lugar
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
     * @Column(name="nombre", type="string", length=100, nullable=false)
     */
    private $nombre;

    /**
     * @var boolean
     *
     * @Column(name="indActivo", type="boolean", nullable=true)
     */
    private $indActivo;

    /**
     * @var integer
     *
     * @Column(name="coordenadaX", type="integer", nullable=true)
     */
    private $coordenadaX;

    /**
     * @var integer
     *
     * @Column(name="coordenadaY", type="integer", nullable=true)
     */
    private $coordenadaY;


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
     * @var Municipio
     *
     * @ManyToOne(targetEntity="Municipio")
     * @JoinColumns({
     *   @JoinColumn(name="municipio_id", referencedColumnName="id")
     * })
     */
    private $municipio;

    /**
     * @var CuadriculaUtm
     *
     * @ManyToOne(targetEntity="CuadriculaUtm")
     * @JoinColumns({
     *   @JoinColumn(name="cuadricula_utm_id", referencedColumnName="id")
     * })
     */
    private $cuadriculaUtm;

    /**
     * @var Comarca
     *
     * @ManyToOne(targetEntity="Comarca")
     * @JoinColumns({
     *   @JoinColumn(name="comarca_id", referencedColumnName="id")
     * })
     */
    private $comarca;



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
     * @return Lugar
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
     * Set indActivo
     *
     * @param boolean $indActivo
     * @return Lugar
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
     * Set coordenadaX
     *
     * @param integer $coordenadaX
     * @return Lugar
     */
    public function setCoordenadaX($coordenadaX)
    {
        $this->coordenadaX = $coordenadaX;

        return $this;
    }

    /**
     * Get coordenadaX
     *
     * @return integer 
     */
    public function getCoordenadaX()
    {
        return $this->coordenadaX;
    }

    /**
     * Set coordenadaY
     *
     * @param integer $coordenadaY
     * @return Lugar
     */
    public function setCoordenadaY($coordenadaY)
    {
        $this->coordenadaY = $coordenadaY;

        return $this;
    }

    /**
     * Get coordenadaY
     *
     * @return integer 
     */
    public function getCoordenadaY()
    {
        return $this->coordenadaY;
    }

    /**
     * Set observadorPrincipal
     *
     * @param ObservadorPrincipal $observadorPrincipal
     * @return Lugar
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
     * Set municipio
     *
     * @param Municipio $municipio
     * @return Lugar
     */
    public function setMunicipio(Municipio $municipio = null)
    {
        $this->municipio = $municipio;

        return $this;
    }

    /**
     * Get municipio
     *
     * @return Municipio
     */
    public function getMunicipio()
    {
        return $this->municipio;
    }

    /**
     * Set cuadriculaUtm
     *
     * @param CuadriculaUtm $cuadriculaUtm
     * @return Lugar
     */
    public function setCuadriculaUtm(CuadriculaUtm $cuadriculaUtm = null)
    {
        $this->cuadriculaUtm = $cuadriculaUtm;

        return $this;
    }

    /**
     * Get cuadriculaUtm
     *
     * @return CuadriculaUtm
     */
    public function getCuadriculaUtm()
    {
        return $this->cuadriculaUtm;
    }

    /**
     * Set comarca
     *
     * @param Comarca $comarca
     * @return Lugar
     */
    public function setComarca(Comarca $comarca = null)
    {
        $this->comarca = $comarca;

        return $this;
    }

    /**
     * Get comarca
     *
     * @return Comarca
     */
    public function getComarca()
    {
        return $this->comarca;
    }
}
