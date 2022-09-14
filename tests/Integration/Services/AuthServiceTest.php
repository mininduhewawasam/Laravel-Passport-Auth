<?php

use App\Models\User;
use App\Modules\Auth\Repositories\Interfaces\AuthRepositoryInterface;
use App\Modules\Auth\Services\AuthService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;

uses(RefreshDatabase::class);

it('uses configured repository to create user', function () {
    Event::fake();

    $user = User::factory()->raw();
    $user['password'] = 'foobar123';
    $modelUser = User::factory()->make($user);

    $this->mock(AuthRepositoryInterface::class)
        ->shouldReceive('create')
        ->once()
        ->withArgs(function (array $user) {
            expect($user)->toBeArray();

            return true;
        })->andReturn($modelUser);

    $user = resolve(AuthService::class)->register($user);

    $this->assertAuthenticatedAs($modelUser);
    Event::assertDispatched(Registered::class);
});
