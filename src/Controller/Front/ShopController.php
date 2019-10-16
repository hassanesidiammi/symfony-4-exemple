<?php

namespace App\Controller\Front;

use App\Entity\FavoriteShop;
use App\Entity\Location;
use App\Entity\Shop;
use App\Entity\User;
use App\Repository\ShopRepository;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ShopRepository $shopRepository)
    {
        $shops = $this->getUser() ? $shopRepository->findNotFavorite($this->getUser()) : $shopRepository->findBy([], ['createdAt' => 'DESC']);

        return $this->render('front/shop/index.html.twig', [
            'shops' => $shops,
        ]);
    }
    /**
     * @Route("/preferred", name="shop_preferred")
     */
    public function preferred(ShopRepository $shopRepository)
    {
        $shops = array_map(
            function (FavoriteShop $favoriteShop) {
                return $favoriteShop->getShop();
            },
            $this->getUser()->getFavoriteShops()->toArray());

        return $this->render('front/shop/favorite.html.twig', [
            'shops' => $shops,
        ]);
    }

    /**
     * @Route("/shop/{id}/like", name="shop_like")
     */
    public function like(Shop $shop)
    {
        /** @var User $user */
        $user = $this->getUser();

        try {
            $favoriteShop = new FavoriteShop();
            $user->addFavoriteShop($shop);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', "\"{$shop->getTitle()}\" Was added to Preferred shops!");

        } catch (UniqueConstraintViolationException $exception) {
            $this->addFlash('warning', "\"{$shop->getTitle()}\" Is already in Preferred shops!");
        }

        return new RedirectResponse($this->generateUrl('home'));
    }

    /**
     * @Route("/shop/{id}/unlike", name="shop_unlike")
     */
    public function unlike(Shop $shop)
    {
        /** @var User $user */
        $user = $this->getUser();

        if ($favoriteShop = $user->getFavoriteFromShop($shop)) {
            $this->getDoctrine()->getManager()->remove($favoriteShop);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', "\"{$shop->getTitle()}\" Was added to Preferred shops!");
        } else {
            $this->addFlash('warning', "\"{$shop->getTitle()}\" Is NOT in your Preferred shops!");
        }

        return new RedirectResponse($this->generateUrl('shop_preferred'));
    }

    /**
     * @Route("/shop/{id}/dislike", name="shop_dislike")
     */
    public function dislike(Shop $shop)
    {
        /** @var User $user */
        $user = $this->getUser();
        $user->addFavoriteShops($shop);

        $this->getDoctrine()->getManager()->flush();

        $this->addFlash('success', "\"{$shop->getTitle()}\" Was added to Preferred shops!");

        return new RedirectResponse($this->generateUrl('home'));
    }
}
