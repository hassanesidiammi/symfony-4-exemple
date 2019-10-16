<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Location", cascade={"persist"})
     */
    protected $location;

    /**
     * @ORM\OneToMany(targetEntity="FavoriteShop", mappedBy="user", cascade={"persist"})
     */
    protected $favoriteShops;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DislikedShop", mappedBy="user", cascade={"persist", "remove"})
     */
    protected $dislikedShops;

    public function __construct()
    {
        $this->favoriteShops = new ArrayCollection();
        $this->dislikedShops = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getFavoriteShops(): Collection
    {
        return $this->favoriteShops;
    }

    /**
     * @param ArrayCollection $favoriteShops
     * @return User
     */
    public function setFavoriteShops(ArrayCollection $favoriteShops): User
    {
        $this->favoriteShops = $favoriteShops;
        return $this;
    }

    /**
     * @param Shop $shop
     * @return User
     */
    public function addFavoriteShop(Shop $shop): self
    {
        $favoriteShop = new FavoriteShop();
        $favoriteShop->setShop($shop);
        $favoriteShop->setUser($this);

        $this->favoriteShops->add($favoriteShop);
        return $this;
    }

    /**
     * @param Shop $shop
     *
     * @return bool
     */
    public function isFavoriteShop(Shop $shop): bool
    {
        $shopsId = array_map(function(FavoriteShop$favShop){
            return $favShop->getShop()->getId();
        }, $this->getFavoriteShops()->toArray());

        return in_array($shop->getId(), $shopsId);
    }

    /**
     * @return Collection
     */
    public function getDislikedShops(): Collection
    {
        return $this->dislikedShops;
    }

    /**
     * @param ArrayCollection $dislikedShops
     * @return User
     */
    public function setDislikedShops(ArrayCollection $dislikedShops): self
    {
        $this->dislikedShops = $dislikedShops;
        return $this;
    }

    /**
     * @param Shop $shop
     * @return User
     */
    public function addDislikedShop(Shop $shop): self
    {
        $this->dislikedShops->add($shop);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     * @return User
     */
    public function setLocation($location)
    {
        $this->location = $location;
        return $this;
    }
}
