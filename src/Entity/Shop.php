<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ShopRepository")
 */
class Shop
{
    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Location", cascade={"persist"})
     */
    private $location;

    /**
     * @ORM\OneToMany(targetEntity="FavoriteShop", mappedBy="shop")
     */
    protected $favoriteShops;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DislikedShop", mappedBy="shop")
     */
    protected $dislikedShop;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    /**
     * @return mixed
     */
    public function getFavoriteShops()
    {
        return $this->favoriteShops;
    }

    /**
     * @param mixed $favoriteShops
     * @return Shop
     */
    public function setFavoriteShops($favoriteShops)
    {
        $this->favoriteShops = $favoriteShops;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDislikedShop()
    {
        return $this->dislikedShop;
    }

    /**
     * @param mixed $dislikedShop
     * @return Shop
     */
    public function setDislikedShop($dislikedShop)
    {
        $this->dislikedShop = $dislikedShop;
        return $this;
    }



    public function setLocation(Location $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
