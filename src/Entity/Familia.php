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
 * Familia
 *
 * @Entity
 * @Table(name="familia", indexes={@Index(name="idx_familia_orden_taxonomico_id", columns={"orden_taxonomico_id"})})
 */
class Familia
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
    private $indActivo;

    /**
     * @var OrdenTaxonomico
     *
     * @ManyToOne(targetEntity="OrdenTaxonomico")
     * @JoinColumns({
     *   @JoinColumn(name="orden_taxonomico_id", referencedColumnName="id")
     * })
     */
    private $ordenTaxonomico;



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
     * @return Familia
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
     * @return Familia
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
     * Set ordenTaxonomico
     *
     * @param OrdenTaxonomico $ordenTaxonomico
     * @return Familia
     */
    public function setOrdenTaxonomico(OrdenTaxonomico $ordenTaxonomico = null)
    {
        $this->ordenTaxonomico = $ordenTaxonomico;

        return $this;
    }

    /**
     * Get ordenTaxonomico
     *
     * @return OrdenTaxonomico
     */
    public function getOrdenTaxonomico()
    {
        return $this->ordenTaxonomico;
    }
}
