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
 * AsoCitaClaseEdadSexo
 *
 * @Table(name="aso_cita_clase_edad_sexo", indexes={
 *     @Index(name="idx_cita_clases_edad_sexo_cita_id", columns={"cita_id"}),
 *     @Index(name="idx_cita_clases_edad_sexo_clase_edad_sexo_id", columns={"clase_edad_sexo_id"})
 * })
 * @Entity
 */
class AsoCitaClaseEdadSexo
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
     * @var integer
     *
     * @Column(name="cantidad", type="integer", nullable=false)
     */
    private $cantidad;

    /**
     * @var ClaseEdadSexo
     *
     * @ManyToOne(targetEntity="ClaseEdadSexo")
     * @JoinColumns({
     *   @JoinColumn(name="clase_edad_sexo_id", referencedColumnName="id")
     * })
     */
    private $claseEdadSexo;

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
     * Set cantidad
     *
     * @param integer $cantidad
     * @return AsoCitaClaseEdadSexo
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set claseEdadSexo
     *
     * @param ClaseEdadSexo $claseEdadSexo
     * @return AsoCitaClaseEdadSexo
     */
    public function setClaseEdadSexo(ClaseEdadSexo $claseEdadSexo = null)
    {
        $this->claseEdadSexo = $claseEdadSexo;

        return $this;
    }

    /**
     * Get claseEdadSexo
     *
     * @return ClaseEdadSexo
     */
    public function getClaseEdadSexo()
    {
        return $this->claseEdadSexo;
    }

    /**
     * Set cita
     *
     * @param Cita $cita
     * @return AsoCitaClaseEdadSexo
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
