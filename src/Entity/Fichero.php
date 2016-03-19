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
 * Fichero
 *
 * @Table(name="fichero", indexes={@Index(name="idx_fichero_cita_id", columns={"cita_id"})})
 * @Entity
 */
class Fichero
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
     * @Column(name="ruta", type="string", length=250, nullable=false)
     */
    private $ruta;

    /**
     * @var string
     *
     * @Column(name="tipoMime", type="string", length=100, nullable=false)
     */
    private $tipoMime;

    /**
     * @var string
     *
     * @Column(name="nombreFisico", type="string", length=50, nullable=false)
     */
    private $nombreFisico;

    /**
     * @var string
     *
     * @Column(name="nombre", type="string", length=100, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @Column(name="descripcion", type="string", length=500, nullable=true)
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @Column(name="fechaAlta", type="datetime", nullable=false)
     */
    private $fechaAlta;

    /**
     * @var boolean
     *
     * @Column(name="indImagenPortada", type="boolean", nullable=true)
     */
    private $indImagenPortada;

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
     * Set ruta
     *
     * @param string $ruta
     * @return Fichero
     */
    public function setRuta($ruta)
    {
        $this->ruta = $ruta;

        return $this;
    }

    /**
     * Get ruta
     *
     * @return string 
     */
    public function getRuta()
    {
        return $this->ruta;
    }

    /**
     * Set tipoMime
     *
     * @param string $tipoMime
     * @return Fichero
     */
    public function setTipoMime($tipoMime)
    {
        $this->tipoMime = $tipoMime;

        return $this;
    }

    /**
     * Get tipoMime
     *
     * @return string 
     */
    public function getTipoMime()
    {
        return $this->tipoMime;
    }

    /**
     * Set nombreFisico
     *
     * @param string $nombreFisico
     * @return Fichero
     */
    public function setNombreFisico($nombreFisico)
    {
        $this->nombreFisico = $nombreFisico;

        return $this;
    }

    /**
     * Get nombreFisico
     *
     * @return string 
     */
    public function getNombreFisico()
    {
        return $this->nombreFisico;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Fichero
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Fichero
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set fechaAlta
     *
     * @param \DateTime $fechaAlta
     * @return Fichero
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
     * Set indImagenPortada
     *
     * @param boolean $indImagenPortada
     * @return Fichero
     */
    public function setIndImagenPortada($indImagenPortada)
    {
        $this->indImagenPortada = $indImagenPortada;

        return $this;
    }

    /**
     * Get indImagenPortada
     *
     * @return boolean 
     */
    public function getIndImagenPortada()
    {
        return $this->indImagenPortada;
    }

    /**
     * Set cita
     *
     * @param Cita $cita
     * @return Fichero
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
