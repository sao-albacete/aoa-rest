<?php

namespace Aoa\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

/**
 * CriterioSeleccionCita
 *
 * @Table(name="criterio_seleccion_cita")
 * @Entity
 */
class CriterioSeleccionCita
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
     * @Column(name="tipoCita", type="string", length=100, nullable=false)
     */
    private $tipoCita;

    /**
     * @var string
     *
     * @Column(name="nombre", type="string", length=500, nullable=false)
     */
    private $nombre;

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
     * @return CriterioSeleccionCita
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
     * Set tipoCita
     *
     * @param string $tipoCita
     * @return CriterioSeleccionCita
     */
    public function setTipoCita($tipoCita)
    {
        $this->tipoCita = $tipoCita;

        return $this;
    }

    /**
     * Get tipoCita
     *
     * @return string 
     */
    public function getTipoCita()
    {
        return $this->tipoCita;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return CriterioSeleccionCita
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
     * @return CriterioSeleccionCita
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
