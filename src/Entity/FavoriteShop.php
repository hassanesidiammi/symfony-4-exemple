<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FavoriteShopsRepository")
 * @ORM\Table(name="user_shop_favorite")
 * @ORM\Table(uniqueConstraints={@uniqueConstraint(name="favorite_shop_idx", columns={"user_id", "shop_id"})})
 */
class FavoriteShop
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="favoriteShops")
     * @ORM\JoinColumn(name="user_id", nullable=false)
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Shop", inversedBy="favoriteShops")
     * @ORM\JoinColumn(name="shop_id", nullable=false)
     */
    protected $shop;

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
     * @return FavoriteShop
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
     * @return FavoriteShop
     */
    public function setShop($shop)
    {
        $this->shop = $shop;
        return $this;
    }
}
