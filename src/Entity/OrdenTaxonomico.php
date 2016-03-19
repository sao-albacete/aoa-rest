<?php

namespace Aoa\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

/**
 * OrdenTaxonomico
 *
 * @Table(name="orden_taxonomico")
 * @Entity
 */
class OrdenTaxonomico
{
    /**
     * @var integer
     *
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     * @Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @Column(name="nombre", type="string", length=64, nullable=false)
     */
    private $nombre;

    /**
     * @var boolean
     *
     * @Column(name="indActivo", type="boolean", nullable=true)
     */
    private $indactivo;



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
     * @return OrdenTaxonomico
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
     * @param boolean $indactivo
     * @return OrdenTaxonomico
     */
    public function setIndactivo($indactivo)
    {
        $this->indactivo = $indactivo;

        return $this;
    }

    /**
     * Get indActivo
     *
     * @return boolean 
     */
    public function getIndactivo()
    {
        return $this->indactivo;
    }
}
