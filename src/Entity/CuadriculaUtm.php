<?php

namespace Aoa\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\Table;

/**
 * CuadriculaUtm
 *
 * @Table(name="cuadricula_utm")
 * @Entity
 */
class CuadriculaUtm
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
     * @Column(name="codigo", type="string", length=12, nullable=false)
     */
    private $codigo;

    /**
     * @var integer
     *
     * @Column(name="coordenadaX", type="integer", nullable=false)
     */
    private $coordenadaX;

    /**
     * @var integer
     *
     * @Column(name="coordenadaY", type="integer", nullable=false)
     */
    private $coordenadaY;

    /**
     * @var string
     *
     * @Column(name="area", type="string", length=2, nullable=false)
     */
    private $area;

    /**
     * @var boolean
     *
     * @Column(name="indActivo", type="boolean", nullable=true)
     */
    private $indActivo;

    /**
     * @var Collection
     *
     * @ManyToMany(targetEntity="Municipio", mappedBy="cuadriculaUtm")
     */
    private $municipio;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->municipio = new ArrayCollection();
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
     * @return CuadriculaUtm
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
     * Set coordenadaX
     *
     * @param integer $coordenadaX
     * @return CuadriculaUtm
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
     * @return CuadriculaUtm
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
     * Set area
     *
     * @param string $area
     * @return CuadriculaUtm
     */
    public function setArea($area)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get area
     *
     * @return string 
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Set indActivo
     *
     * @param boolean $indActivo
     * @return CuadriculaUtm
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
     * Add municipio
     *
     * @param Municipio $municipio
     * @return CuadriculaUtm
     */
    public function addMunicipio(Municipio $municipio)
    {
        $this->municipio[] = $municipio;

        return $this;
    }

    /**
     * Remove municipio
     *
     * @param Municipio $municipio
     */
    public function removeMunicipio(Municipio $municipio)
    {
        $this->municipio->removeElement($municipio);
    }

    /**
     * Get municipio
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMunicipio()
    {
        return $this->municipio;
    }
}
