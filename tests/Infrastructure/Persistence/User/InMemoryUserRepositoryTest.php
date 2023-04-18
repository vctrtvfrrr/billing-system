<?php

declare(strict_types=1);

namespace Tests\Infrastructure\Persistence\User;

use App\Domain\User\User;
use App\Domain\User\UserNotFoundException;
use App\Infrastructure\Persistence\User\InMemoryUserRepository;
use Tests\TestCase;

class InMemoryUserRepositoryTest extends TestCase
{
    /** @test */
    public function find_all(): void
    {
        $user = new User(1, 'bill.gates', 'Bill', 'Gates');

        $userRepository = new InMemoryUserRepository([1 => $user]);

        $this->assertSame([$user], $userRepository->findAll());
    }

    /** @test */
    public function find_all_users_by_default(): void
    {
        $users = [
            1 => new User(1, 'bill.gates', 'Bill', 'Gates'),
            2 => new User(2, 'steve.jobs', 'Steve', 'Jobs'),
            3 => new User(3, 'mark.zuckerberg', 'Mark', 'Zuckerberg'),
            4 => new User(4, 'evan.spiegel', 'Evan', 'Spiegel'),
            5 => new User(5, 'jack.dorsey', 'Jack', 'Dorsey'),
        ];

        $userRepository = new InMemoryUserRepository();

        $this->assertSame(array_values($users), $userRepository->findAll());
    }

    /** @test */
    public function find_user_of_id(): void
    {
        $user = new User(1, 'bill.gates', 'Bill', 'Gates');

        $userRepository = new InMemoryUserRepository([1 => $user]);

        $this->assertSame($user, $userRepository->findUserOfId(1));
    }

    /** @test */
    public function find_user_of_id_throws_not_found_exception(): void
    {
        $userRepository = new InMemoryUserRepository([]);
        $this->expectException(UserNotFoundException::class);
        $userRepository->findUserOfId(1);
    }
}
