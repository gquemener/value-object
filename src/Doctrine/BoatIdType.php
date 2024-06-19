<?php

declare(strict_types=1);

namespace App\Doctrine;

use App\Model\BoatId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use InvalidArgumentException;

final class BoatIdType extends Type
{
    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getStringTypeDeclarationSQL($column);
    }

    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): mixed
    {
        if (!$value instanceof BoatId) {
            throw new InvalidArgumentException('Value must be an instanceof BoatId.');
        }

        return $value->toString();
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): mixed
    {
        if (!\is_string($value)) {
            throw new InvalidArgumentException('Value must be a string.');
        }

        return BoatId::fromString($value);
    }
}
