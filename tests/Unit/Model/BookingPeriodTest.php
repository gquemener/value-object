<?php

declare(strict_types=1);

namespace App\Tests\Unit\Model;

use App\Model\BookingPeriod;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @phpstan-type Range array{string, string}
 */
final class BookingPeriodTest extends TestCase
{
    #[Test]
    public function it_does_not_represent_a_reversed_period(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $subject = BookingPeriod::fromStrings('tomorrow', 'yesterday');
    }

    /**
    * @return array<string, array{Range, Range}>
    */
    public static function overlappingCases(): array
    {
        return [
            '{ * [ * ] * }' => [
                ['2023-05-13', '2023-05-20'],
                ['2023-05-01', '2023-05-25'],
            ],
            // [ * {} * ]
            // [ * { * ] * }
            // { * [ * } * ]
        ];
    }

    /**
    * @param Range $subjectRange
    * @param Range $targetRange
    */
    #[Test, DataProvider('overlappingCases')]
    public function it_tells_when_a_date_is_overlapping(array $subjectRange, array $targetRange): void
    {
        $subject = BookingPeriod::fromStrings(...$subjectRange);

        $this->assertTrue(
            $subject->isOverlapping(
                BookingPeriod::fromStrings(...$targetRange)
            )
        );
    }

    /**
    * @return array<string, array{Range, Range}>
    */
    public static function notOverlappingCases(): array
    {
        return [
            '{ * } * [ * ]' => [
                ['2023-05-01', '2023-05-10'],
                ['2023-05-13', '2023-05-20'],
            ],
            // '[ * ] * { * }' => [
        ];
    }

    /**
    * @param Range $subjectRange
    * @param Range $targetRange
    */
    #[Test, DataProvider('notOverlappingCases')]
    public function it_tells_when_a_date_is_not_overlapping(array $subjectRange, array $targetRange): void
    {
        $subject = BookingPeriod::fromStrings(...$subjectRange);

        $this->assertFalse($subject->isOverlapping(
            BookingPeriod::fromStrings(...$targetRange)
        ));
    }
}
