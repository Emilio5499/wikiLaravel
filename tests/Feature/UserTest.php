<?php

namespace Tests\Feature;

use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

test('user_can_register', function () {
    $userData = [
        'name' => 'Usuario Prueba',
        'email' => 'usuario@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ];

    $this->post(route('register'), $userData)
        ->assertRedirect(route('home'));

    assertDatabaseHas('users', [
        'email' => 'usuario@example.com',
    ]);
});

test('user_can_login', function () {
    $user = User::factory()->create([
        'password' => bcrypt('password123'),
    ]);

    $this->post(route('login'), [
        'email' => $user->email,
        'password' => 'password123',
    ])->assertRedirect(route('home'));

    $this->assertAuthenticatedAs($user);
});

test('auth_user_can_enter_profile', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->get(route('profile'))
        ->assertStatus(200);
});

test('auth_user_can_update_profile', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->put(route('profile.update'), [
            'name' => 'Nuevo Nombre',
            'email' => $user->email,
        ])
        ->assertRedirect(route('profile'));

    assertDatabaseHas('users', [
        'id' => $user->id,
        'name' => 'Nuevo Nombre',
    ]);
});

test('guest_cannot_enter_profile', function () {
    $this->get(route('profile'))
        ->assertRedirect(route('login'));
});

test('user_cannot_change_role_to_admin', function () {
    $user = User::factory()->create(['role' => 'user']);

    actingAs($user)
        ->patch(route('profile.update'), [
            'role' => 'admin',
        ])
        ->assertForbidden();

    assertDatabaseHas('users', [
        'id' => $user->id,
        'role' => 'user',
    ]);
});
