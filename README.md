# Value Object

## Introduction

The goal of this repository is to illustrate the concept of a value object using PHP (and showing how to map them to table using Doctrine ORM).

You may navigate commits in order to see the different iterations.

## Example

```php
<?php

declare(strict_types=1);

readonly class PositiveInteger // NOTE: Rule #1 Value object is immutable
{
    private int $value;

    private function __construct(
        int $value
    ) {
        if ($value < 0) {
            throw new \InvalidArgumentException(); // NOTE: Rule #2 Impossible state is impossible to achieve
        }

        $this->value = $value;
    }

    public static function fromInt(int $value): self
    {
        return new self($value);
    }

    public function plus(self $other): self
    {
        return self::fromInt($this->value + $other->value);
    }

    public function equals(self $other): bool
    {
        return $this->value === $other->value; // NOTE: Rule #3 Two value objects are equal if the values of their properties are equal
    }
}

$one = PositiveInteger::fromInt(1);

var_dump($one === PositiveInteger::fromInt(1)); // false
var_dump($one == PositiveInteger::fromInt(1)); // true
var_dump($one->equals($one)); // true
var_dump($one->equals($one->plus($one))); // false
```

## Reading

  - https://martinfowler.com/bliki/ValueObject.html
  - https://refactoring.guru/fr/smells/primitive-obsession
  - https://learn.microsoft.com/en-us/dotnet/architecture/microservices/microservice-ddd-cqrs-patterns/implement-value-objects
  - https://github.com/moneyphp/money
