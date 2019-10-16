<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DislikedShopRepository")
 * @ORM\Table(name="user_shop_disliked")
 */
class DislikedShop
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="dislikedShops")
     * @ORM\JoinColumn(name="user_id", nullable=false)
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Shop")
     * @ORM\JoinColumn(name="shop_id", nullable=false)
     */
    protected $shop;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dislikedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     * @return DislikedShop
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getShop()
    {
        return $this->shop;
    }

    /**
     * @param mixed $shop
     * @return DislikedShop
     */
    public function setShop($shop)
    {
        $this->shop = $shop;
        return $this;
    }

    public function getDislikedAt(): ?\DateTimeInterface
    {
        return $this->dislikedAt;
    }

    public function setDislikedAt(\DateTimeInterface $dislikedAt): self
    {
        $this->dislikedAt = $dislikedAt;

        return $this;
    }
}
