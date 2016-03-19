<?php

namespace Aoa\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

/**
 * ClaseReproduccion
 *
 * @Table(name="clase_reproduccion")
 * @Entity
 */
class ClaseReproduccion
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
     * @Column(name="tipoCria", type="string", length=50, nullable=false)
     */
    private $tipoCria;

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
     * @var integer
     *
     * @Column(name="idTipoCria", type="integer", nullable=false)
     */
    private $idTipoCria;


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
     * @return ClaseReproduccion
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
     * Set tipoCria
     *
     * @param string $tipoCria
     * @return ClaseReproduccion
     */
    public function setTipoCria($tipoCria)
    {
        $this->tipoCria = $tipoCria;

        return $this;
    }

    /**
     * Get tipoCria
     *
     * @return string 
     */
    public function getTipoCria()
    {
        return $this->tipoCria;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return ClaseReproduccion
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
     * @return ClaseReproduccion
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
     * Set idTipoCria
     *
     * @param integer $idTipoCria
     * @return ClaseReproduccion
     */
    public function setIdTipoCria($idTipoCria)
    {
        $this->idTipoCria = $idTipoCria;

        return $this;
    }

    /**
     * Get idTipoCria
     *
     * @return integer 
     */
    public function getIdTipoCria()
    {
        return $this->idTipoCria;
    }
}
