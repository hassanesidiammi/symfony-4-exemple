<?php

namespace App\Entity;

use CrEOF\Spatial\PHP\Types\Geometry\Point;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="app_location")
 */
class Location
{
    const SRID = 4326;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="point")
     * @var Point
     */
    protected $point;

    public function __construct(array $option=[])
    {
        $this->point = $this->createPoint($option);
    }

    protected function createPoint(?array $option)
    {
        $option = array_merge([
        'lat' => 0,
        'lng' => 0,
        'srid' => Location::SRID,
    ], $option);

        return new Point($option);
    }

    public function getPoint()
    {
        return $this->point;
    }

    public function setPoint($point): self
    {
        $this->point = $point;

        return $this;
    }

    public function getLatitude()
    {
        return $this->point instanceof  Point ? $this->point->getLatitude() : null;
    }

    public function setLatitude($latitude): self
    {
        $this->point->setLatitude($latitude);

        return $this;
    }

    public function getLongitude()
    {
        return $this->point instanceof  Point ? $this->point->getLongitude() : null;
    }

    public function setLongitude($longitude): self
    {
        $this->point->setLongitude($longitude);

        return $this;
    }
}
