<?php

namespace App\DataFixtures;

use App\Entity\Location;
use App\Entity\Shop;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use KnpU\LoremIpsumBundle\KnpUIpsum;

class AppFixtures extends Fixture
{
    /**
     * @var KnpUIpsum
     */
    protected $knpUIpsum;

    public function __construct(KnpUIpsum $knpUIpsum)
    {
        $this->knpUIpsum = $knpUIpsum;
    }

    public function load(ObjectManager $manager)
    {
        $this->loadUser($manager);
        $this->loadShop($manager);

        $manager->flush();
    }

    protected function loadUser(ObjectManager $manager)
    {
        $users = [
            'admin user' => [
                'username' => 'admin',
                'mail' => 'admin@exemple.com',
                'password' => 'admin',
                'role' => 'ROLE_ADMIN',
                'lat' =>  31.574308,
                'lng' =>  -5.624561,
            ],
            'simple user' => [
                'username' => 'hassane',
                'mail' => 'h.sidiammi@gmail.com',
                'password' => 'hassane',
                'role' => 'ROLE_USER',
                'lat' =>  33.574308,
                'lng' =>  -7.624561,
            ],
        ];

        foreach ($users as $item) {
            $location = new Location([
                'lat' => $item['lat'],
                'lng' => $item['lng'],
            ]);
            $user = new User();
            $user->setUsername($item['username'])
                ->setEmail($item['mail'])
                ->setLocation($location)
                ->setPlainPassword($item['password'])
                ->setEnabled(true)
                ->addRole($item['role'])
            ;

            $manager->persist($user);
        }
    }

    protected function loadShop(ObjectManager $manager)
    {
        for($i=0; $i<12; $i++){
            $shop = new Shop();
            $shop->setTitle($this->knpUIpsum->getWords(rand(2, 3)));
            $shop->setDescription($this->knpUIpsum->getParagraphs(rand(2, 4)));
            $location = new Location([
                'lat' => rand(2000000, 3500000)/100000,
                'lng' => rand(-1700000, -400000)/100000,
            ]);
            $shop->setLocation($location);

            $createdAt = new \DateTime();
            $createdAt->modify(rand(1, 30).' day');
            $manager->persist($location);
            $manager->persist($shop);
        }
    }
}
