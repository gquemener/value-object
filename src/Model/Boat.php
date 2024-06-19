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

    #[ORM\Embedded]
    private RegistrationCountry $country;

    public function __construct(BoatId $id, BoatName $name, RegistrationCountry $country)
    {
        $this->id = $id->toString();
        $this->name = $name;
        $this->country = $country;
    }

    public function id(): BoatId
    {
        return BoatId::fromString($this->id);
    }

    public function name(): BoatName
    {
        return $this->name;
    }
}
