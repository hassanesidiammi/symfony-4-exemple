<?php

namespace App\Repository;

use App\Entity\Location;
use App\Entity\User;
use App\Entity\Shop;
use CrEOF\Spatial\PHP\Types\Geometry\Point;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Shop|null find($id, $lockMode = null, $lockVersion = null)
 * @method Shop|null findOneBy(array $criteria, array $orderBy = null)
 * @method Shop[]    findAll()
 * @method Shop[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShopRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Shop::class);
    }

    public function getWithJoinsQab(User $user)
    {
        return $this->createQueryBuilder('s')
            ->select()
            ->leftJoin('s.favoriteShops', 'f')
            ->addSelect('f')
            ->leftJoin('f.user', 'u')
            ->addSelect('u')
            ->where('f IS NULL OR u != :user')
            ->setParameter('user', $user)
            ;
    }

    public function findNotFavorite(User $user)
    {
        $userPoint = $user->getLocation()->getPoint();

        $results = $this->getWithJoinsQab($user)
            ->leftJoin('u.location', 'ul')
            ->leftJoin('s.location', 'sl')
            ->addSelect('ST_Distance(Point(X(sl.point), Y(sl.point)), Point(:lat, :lng)) distance')
            ->addSelect('X(sl.point) X')
            ->addSelect('Y(sl.point) Y')
            ->setParameter('lat', $userPoint->getX())
            ->setParameter('lng', $userPoint->getY())
            ->orderBy('distance', 'ASC')
            ->getQuery()
            ->getArrayResult();

        return array_map(function ($result){
            return array_merge($result[0], ['distance' => $result['distance'], 'X' => $result['X'], 'Y' => $result['Y']]);
        }, $results);
    }
}
