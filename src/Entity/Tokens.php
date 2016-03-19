<?php

namespace Aoa\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Index;
use Doctrine\ORM\Mapping\Table;

/**
 * Tokens
 *
 * @Table(name="tokens", indexes={@Index(name="user_id", columns={"user_id"})})
 * @Entity
 */
class Tokens
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
     * @Column(name="user_id", type="integer", nullable=true)
     */
    private $userId;

    /**
     * @var string
     *
     * @Column(name="type", type="string", length=10, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @Column(name="key", type="string", length=60, nullable=false)
     */
    private $key;

    /**
     * @var string
     *
     * @Column(name="content", type="string", length=255, nullable=false)
     */
    private $content;

    /**
     * @var boolean
     *
     * @Column(name="used", type="boolean", nullable=false)
     */
    private $used;

    /**
     * @var boolean
     *
     * @Column(name="unlimited", type="boolean", nullable=false)
     */
    private $unlimited;

    /**
     * @var \DateTime
     *
     * @Column(name="created", type="datetime", nullable=true)
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @Column(name="modified", type="datetime", nullable=true)
     */
    private $modified;



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
     * Set userId
     *
     * @param integer $userId
     * @return Tokens
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Tokens
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set key
     *
     * @param string $key
     * @return Tokens
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * Get key
     *
     * @return string 
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Tokens
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set used
     *
     * @param boolean $used
     * @return Tokens
     */
    public function setUsed($used)
    {
        $this->used = $used;

        return $this;
    }

    /**
     * Get used
     *
     * @return boolean 
     */
    public function getUsed()
    {
        return $this->used;
    }

    /**
     * Set unlimited
     *
     * @param boolean $unlimited
     * @return Tokens
     */
    public function setUnlimited($unlimited)
    {
        $this->unlimited = $unlimited;

        return $this;
    }

    /**
     * Get unlimited
     *
     * @return boolean 
     */
    public function getUnlimited()
    {
        return $this->unlimited;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Tokens
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set modified
     *
     * @param \DateTime $modified
     * @return Tokens
     */
    public function setModified($modified)
    {
        $this->modified = $modified;

        return $this;
    }

    /**
     * Get modified
     *
     * @return \DateTime 
     */
    public function getModified()
    {
        return $this->modified;
    }
}
