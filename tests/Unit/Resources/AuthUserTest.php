<?php

use App\Http\Resources\AuthUserResource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

uses(RefreshDatabase::class);

it('can return auth user', function () {
    $this->artisan('passport:install', ['--no-interaction' => true,]);
    $user = User::factory()->make();

    $authUserResource = (new AuthUserResource($user))->resolve();

    $this->assertCount(4, $authUserResource);

    expect($authUserResource)->toBeArray();
    expect($authUserResource['name'])->toEqual($user->name);
    expect($authUserResource['email'])->toEqual($user->email);
});