<?php
use App\Modules\Auth\Repositories\Interfaces\AuthRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

uses(RefreshDatabase::class);

it('it will store user', function() {
    $user = User::factory()->raw();
    $user['password'] = 'foobar123';

    $modelUser = resolve(AuthRepositoryInterface::class)->create($user);

    $this->assertDatabaseHas('users', [
        'email' => $user['email'],
        'name' => $user['name'],
    ]);

    expect($modelUser)
        ->toBeInstanceOf(User::class)
        ->id->toBeInt
        ->name->toEqual($user['name'])
        ->email->toEqual($user['email']);
});