<?php

namespace App\Tests;

use App\Entity\User;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserTest extends TestCase
{
    private UserPasswordHasherInterface $passwordHasher;

    protected function setUp(): void
    {
        parent::setUp();
        $this->passwordHasher = $this->createMock(UserPasswordHasherInterface::class);
    }

    public function testSetterGetterUser(): void
    {
        $user = new User();

        $email = 'test@test.com';
        $lastname = 'Dupont';
        $firstname = 'Jean';
        $password = $this->passwordHasher->hashPassword($user, 'password');
        $role = 'ROLE_USER';
        $createdAt = new DateTimeImmutable('2021-01-01');

        $user->setEmail($email);
        $user->setLastname($lastname);
        $user->setFirstname($firstname);
        $user->setPassword($password);
        $user->setRole($role);
        $user->setCreatedAt($createdAt);

        $this->assertEquals($email, $user->getEmail());
        $this->assertEquals($lastname, $user->getLastname());
        $this->assertEquals($firstname, $user->getFirstname());
        $this->assertEquals($password, $user->getPassword());
        $this->assertEquals($role, $user->getRole());
        $this->assertEquals($createdAt, $user->getCreatedAt());

    }


}
