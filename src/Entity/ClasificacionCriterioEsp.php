<?php

namespace Aoa\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

/**
 * ClasificacionCriterioEsp
 *
 * @Table(name="clasificacion_criterio_esp")
 * @Entity
 */
class ClasificacionCriterioEsp
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
     * @Column(name="codigo", type="string", length=2, nullable=false)
     */
    private $codigo;

    /**
     * @var string
     *
     * @Column(name="nombre", type="string", length=50, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @Column(name="descripcion", type="string", length=500, nullable=false)
     */
    private $descripcion;

    /**
     * @var boolean
     *
     * @Column(name="indActivo", type="boolean", nullable=true)
     */
    private $indActivo;




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
     * @return ClasificacionCriterioEsp
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
     * Set nombre
     *
     * @param string $nombre
     * @return ClasificacionCriterioEsp
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
     * @return ClasificacionCriterioEsp
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
     * Set indActivo
     *
     * @param boolean $indActivo
     * @return ClasificacionCriterioEsp
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
}
