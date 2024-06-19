<?php

declare(strict_types=1);

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;
use InvalidArgumentException;

#[ORM\Embeddable]
final readonly class BoatName
{
    private function __construct(
        #[ORM\Column]
        private string $value,
    ) {
    }

    public static function fromString(string $value): self
    {
        if (empty($value)) {
            throw new InvalidArgumentException('Boat name cannot be empty');
        }

        return new self($value);
    }
}
