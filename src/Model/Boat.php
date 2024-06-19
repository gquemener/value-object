<?php

declare(strict_types=1);

namespace App\Model;

use App\Doctrine\BoatIdType;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
final class Boat
{
    #[ORM\Id]
    #[ORM\Column(type: BoatIdType::class)]
    private BoatId $id;

    #[ORM\Embedded]
    private BoatName $name;

    public function __construct(BoatId $id, BoatName $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function id(): BoatId
    {
        return $this->id;
    }

    public function name(): BoatName
    {
        return $this->name;
    }
}
