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
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Usuario
 *
 * @Table(name="usuario", uniqueConstraints={
 *     @UniqueConstraint(name="idx_uq_usuario_mail", columns={"email"}),
 *     @UniqueConstraint(name="fichero_id_UNIQUE", columns={"fichero_id"})
 * }, indexes={
 *     @Index(name="idx_usuario_perfil_id", columns={"perfil_id"}),
 *     @Index(name="fk_usuario_observador_principal_id_idx", columns={"observador_principal_id"})
 * })
 * @Entity
 */
class Usuario
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
     * @Column(name="email", type="string", length=150, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @Column(name="password", type="string", length=40, nullable=false)
     */
    private $password;

    /**
     * @var boolean
     *
     * @Column(name="indActivo", type="boolean", nullable=true)
     */
    private $indActivo;

    /**
     * @var string
     *
     * @Column(name="username", type="string", length=250, nullable=false)
     */
    private $username;

    /**
     * @var Perfil
     *
     * @ManyToOne(targetEntity="Perfil")
     * @JoinColumns({
     *   @JoinColumn(name="perfil_id", referencedColumnName="id")
     * })
     */
    private $perfil;

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
     * @var Fichero
     *
     * @ManyToOne(targetEntity="Fichero")
     * @JoinColumns({
     *   @JoinColumn(name="fichero_id", referencedColumnName="id")
     * })
     */
    private $fichero;



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
     * Set email
     *
     * @param string $email
     * @return Usuario
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Usuario
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set indActivo
     *
     * @param boolean $indActivo
     * @return Usuario
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
     * Set username
     *
     * @param string $username
     * @return Usuario
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set perfil
     *
     * @param Perfil $perfil
     * @return Usuario
     */
    public function setPerfil(Perfil $perfil = null)
    {
        $this->perfil = $perfil;

        return $this;
    }

    /**
     * Get perfil
     *
     * @return Perfil
     */
    public function getPerfil()
    {
        return $this->perfil;
    }

    /**
     * Set observadorPrincipal
     *
     * @param ObservadorPrincipal $observadorPrincipal
     * @return Usuario
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
     * Set fichero
     *
     * @param Fichero $fichero
     * @return Usuario
     */
    public function setFichero(Fichero $fichero = null)
    {
        $this->fichero = $fichero;

        return $this;
    }

    /**
     * Get fichero
     *
     * @return Fichero
     */
    public function getFichero()
    {
        return $this->fichero;
    }
}
