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
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Privacidad
 *
 * @Table(name="privacidad", uniqueConstraints={@UniqueConstraint(name="descripcion_UNIQUE", columns={"descripcion"})})
 * @Entity
 */
class Privacidad
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
     * @Column(name="descripcion", type="string", length=250, nullable=false)
     */
    private $descripcion;

    /**
     * @var boolean
     *
     * @Column(name="indActivo", type="boolean", nullable=false)
     */
    private $indActivo;

    /**
     * @var Collection
     *
     * @ManyToMany(targetEntity="Especie", mappedBy="idPrivacidad")
     */
    private $idEspecie;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idEspecie = new ArrayCollection();
    }


    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Privacidad
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
     * @return Privacidad
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add idEspecie
     *
     * @param Especie $idEspecie
     * @return Privacidad
     */
    public function addIdEspecie(Especie $idEspecie)
    {
        $this->idEspecie[] = $idEspecie;

        return $this;
    }

    /**
     * Remove idEspecie
     *
     * @param Especie $idEspecie
     */
    public function removeIdEspecie(Especie $idEspecie)
    {
        $this->idEspecie->removeElement($idEspecie);
    }

    /**
     * Get idEspecie
     *
     * @return Collection
     */
    public function getIdEspecie()
    {
        return $this->idEspecie;
    }
}
