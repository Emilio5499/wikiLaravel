<?php

namespace Tests\Feature;

use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;
use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\assertGuest;

test('user_can_login_with_correct_credentials', function () {
    $user = User::factory()->create([
        'password' => bcrypt('password123'),
    ]);

    post(route('login'), [
        'email' => $user->email,
        'password' => 'password123',
    ])->assertRedirect(route('home'));

    assertAuthenticated();
});

test('user_cannot_login_with_wrong_credentials', function () {
    $user = User::factory()->create([
        'password' => bcrypt('password123'),
    ]);

    post(route('login'), [
        'email' => $user->email,
        'password' => 'wrongpassword',
    ])->assertSessionHasErrors('email');

    assertGuest();
});

test('auth_user_can_log_out', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->post(route('logout'))
        ->assertRedirect('/');

    assertGuest();
});

test('guest_user_cannot_log_out', function () {
    post(route('logout'))->assertRedirect('/');

    assertGuest();
});
