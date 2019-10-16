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
     * @ORM\JoinColumn(nullable=false)
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Shop")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $shop;

    public function getId(): ?int
    {
        return $this->id;
    }
}
