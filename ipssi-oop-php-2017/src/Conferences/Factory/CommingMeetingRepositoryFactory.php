<?php

declare(strict_types=1);

namespace Conferences\Factory;

use Conferences\Repository\MeetingRepository;
use PDO;
use Psr\Container\ContainerInterface;

final class CommingMeetingRepositoryFactory
{
    public function __invoke(ContainerInterface $container) : MeetingRepository
    {
        $pdo = $container->get(PDO::class);

        return new MeetingRepository($pdo);
    }
}
