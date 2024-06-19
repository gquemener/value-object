<?php

declare(strict_types=1);

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
final class Boat
{
    #[ORM\Id]
    #[ORM\Column]
    private string $id;

    #[ORM\Embedded]
    private BoatName $name;

    public function __construct(string $id, BoatName $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): BoatName
    {
        return $this->name;
    }
}
