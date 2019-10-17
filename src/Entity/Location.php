<?php

namespace App\Entity;

use CrEOF\Spatial\PHP\Types\Geometry\Point;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="app_location")
 * @ORM\HasLifecycleCallbacks()
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
     * @ORM\Column(type="point", nullable=true)
     * @var Point
     */
    protected $point;

    /**
     * @ORM\Column(type="float")
     */
    private $latitude;

    /**
     * @ORM\Column(type="float")
     */
    private $longitude;

    public function __construct(array $option=[])
    {
        $this->setPoint($this->createPoint($option));
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

    public function setPoint(Point $point): self
    {
        $this->point = $point;
        $this->setLatitude($point->getLatitude());
        $this->setLongitude($point->getLongitude());

        return $this;
    }

    /**
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     * @return $this
     */
    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param $longitude
     * @return $this
     */
    public function setLongitude($longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function __toString()
    {
        return sprintf('%s, %s',$this->getPoint()->getLatitude(), $this->getPoint()->getLongitude());
    }

    /**
     * @ORM\PreUpdate()
     *
     * @param PreUpdateEventArgs $eventArgs
     */
    public function preUpdate( $eventArgs)
    {
        if ($eventArgs->hasChangedField('latitude') || $eventArgs->hasChangedField('longitude')){
            $options = $this->point->toArray();
            unset($this->point);

            $this->point = $this->createPoint([
                'lat' => $this->getLatitude(),
                'lng' => $this->getLongitude(),
                'srid' => Location::SRID,
            ]);
        }
    }
}
