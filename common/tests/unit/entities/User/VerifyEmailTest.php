<?php
namespace shop\entities\User;
use Codeception\Test\Unit;
use shop\entities\User\User;

class VerifyEmailTest extends Unit
{
    public function testSuccess()
    {
        $user = new User([
            'status' => User::STATUS_WAIT,
            'verification_token' => 'token'
            ]);
        $user->verifyEmail();

        $this->assertEmpty($user->verification_token);
        $this->assertFalse($user->isWait());
        $this->assertFalse($user->isBanned());
        $this->assertTrue($user->isActive());
    }

    public function testAlreadyActive()
    {
        $user = new User([
            'status' => User::STATUS_ACTIVE,
            'verification_token' => null
        ]);

        $this->expectExceptionMessage('User is already active.');

        $user->verifyEmail();

    }
    public function testAlreadyBanned()
    {
        $user = new User([
            'status' => User::STATUS_BANNED,
            'verification_token' => null
        ]);

        $this->expectExceptionMessage('User is banned.');


        $user->verifyEmail();

    }
}