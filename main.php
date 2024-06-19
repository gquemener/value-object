<?php

declare(strict_types=1);

use App\Model\Boat;
use Doctrine\ORM\EntityManagerInterface;

require './bootstrap.php';

/** @var EntityManagerInterface $entityManager */
$repository = $entityManager->getRepository(Boat::class);

foreach($repository->findAll() as $boat) {
    var_dump($boat);
}
