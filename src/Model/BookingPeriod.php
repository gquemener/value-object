<?php

declare(strict_types=1);

namespace App\Model;

use DateTimeImmutable;
use InvalidArgumentException;

final readonly class BookingPeriod
{
    private function __construct(
        private DateTimeImmutable $from,
        private DateTimeImmutable $to,
    ) {
    }

    public static function fromStrings(string $from, string $to): self
    {
        $from = new DateTimeImmutable($from);
        $to = new DateTimeImmutable($to);
        if ($from > $to) {
            throw new InvalidArgumentException('Reversed period detected!');
        }

        return new self($from, $to);
    }

    public function isOverlapping(self $range): bool
    {
        return $this->from > $range->from;
    }
}
