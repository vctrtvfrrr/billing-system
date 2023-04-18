<?php

declare(strict_types=1);

namespace Tests\Domain\User;

use App\Domain\User\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function userProvider(): array
    {
        return [
            [1, 'bill.gates', 'Bill', 'Gates'],
            [2, 'steve.jobs', 'Steve', 'Jobs'],
            [3, 'mark.zuckerberg', 'Mark', 'Zuckerberg'],
            [4, 'evan.spiegel', 'Evan', 'Spiegel'],
            [5, 'jack.dorsey', 'Jack', 'Dorsey'],
        ];
    }

    /**
     * @test
     * @dataProvider userProvider
     */
    public function getters(int $id, string $username, string $firstName, string $lastName): void
    {
        $user = new User($id, $username, $firstName, $lastName);

        $this->assertSame($id, $user->getId());
        $this->assertSame($username, $user->getUsername());
        $this->assertSame($firstName, $user->getFirstName());
        $this->assertSame($lastName, $user->getLastName());
    }

    /**
     * @test
     * @dataProvider userProvider
     */
    public function json_serialize(int $id, string $username, string $firstName, string $lastName): void
    {
        $user = new User($id, $username, $firstName, $lastName);

        $expectedPayload = json_encode([
            'id'        => $id,
            'username'  => $username,
            'firstName' => $firstName,
            'lastName'  => $lastName,
        ]);

        $this->assertSame($expectedPayload, json_encode($user));
    }
}
