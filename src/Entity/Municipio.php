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
 * Municipio
 *
 * @Table(name="municipio", indexes={@Index(name="fk_municipio_comarca_id", columns={"comarca_id"})})
 * @Entity
 */
class Municipio
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
     * @Column(name="nombre", type="string", length=64, nullable=false)
     */
    private $nombre;

    /**
     * @var boolean
     *
     * @Column(name="indActivo", type="boolean", nullable=true)
     */
    private $indActivo;

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
     * @var Collection
     *
     * @ManyToMany(targetEntity="CuadriculaUtm", inversedBy="municipio")
     * @JoinTable(name="aso_cuadricula_utm_municipio",
     *   joinColumns={
     *     @JoinColumn(name="municipio_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @JoinColumn(name="cuadricula_utm_id", referencedColumnName="id")
     *   }
     * )
     */
    private $cuadriculaUtm;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cuadriculaUtm = new ArrayCollection();
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
     * Set nombre
     *
     * @param string $nombre
     * @return Municipio
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
     * @return Municipio
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
     * Set comarca
     *
     * @param Comarca $comarca
     * @return Municipio
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

    /**
     * Add cuadriculaUtm
     *
     * @param CuadriculaUtm $cuadriculaUtm
     * @return Municipio
     */
    public function addCuadriculaUtm(CuadriculaUtm $cuadriculaUtm)
    {
        $this->cuadriculaUtm[] = $cuadriculaUtm;

        return $this;
    }

    /**
     * Remove cuadriculaUtm
     *
     * @param CuadriculaUtm $cuadriculaUtm
     */
    public function removeCuadriculaUtm(CuadriculaUtm $cuadriculaUtm)
    {
        $this->cuadriculaUtm->removeElement($cuadriculaUtm);
    }

    /**
     * Get cuadriculaUtm
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCuadriculaUtm()
    {
        return $this->cuadriculaUtm;
    }
}
