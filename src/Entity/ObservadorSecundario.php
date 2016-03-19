<?php

namespace Aoa\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Index;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinColumns;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * ObservadorSecundario
 *
 * @Table(name="observador_secundario", uniqueConstraints={
 *     @UniqueConstraint(name="IDX_UQ_OBSERVADOR_CODIGO", columns={"codigo"})
 * }, indexes={
 *     @Index(name="fk_observador_secundario_observador_principal_id_idx", columns={"observador_principal_id"})
 * })
 * @Entity
 */
class ObservadorSecundario
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
     * @Column(name="nombre", type="string", length=250, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @Column(name="codigo", type="string", length=3, nullable=false)
     */
    private $codigo;

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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ManyToMany(targetEntity="Cita", mappedBy="observadorSecundario")
     */
    private $cita;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cita = new ArrayCollection();
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
     * @return ObservadorSecundario
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
     * Set codigo
     *
     * @param string $codigo
     * @return ObservadorSecundario
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
     * Set observadorPrincipal
     *
     * @param ObservadorPrincipal $observadorPrincipal
     * @return ObservadorSecundario
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
     * Add cita
     *
     * @param Cita $cita
     * @return ObservadorSecundario
     */
    public function addCita(Cita $cita)
    {
        $this->cita[] = $cita;

        return $this;
    }

    /**
     * Remove cita
     *
     * @param Cita $cita
     */
    public function removeCita(Cita $cita)
    {
        $this->cita->removeElement($cita);
    }

    /**
     * Get cita
     *
     * @return Collection
     */
    public function getCita()
    {
        return $this->cita;
    }
}
