<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use function Pest\Laravel\actingAs;

beforeEach(function () {
    $this->user = User::factory()->create(['role' => 'user']);
    $this->admin = User::factory()->create(['role' => 'admin']);
});

test('auth_user_can_create_post', function () {
    actingAs($this->user)
        ->post(route('posts.store'), [
            'title' => 'Mi primer post',
            'content' => 'Este es el contenido del post.',
        ])
        ->assertRedirect(route('posts.index'));
});

test('user_cannot_see_unmodded_post', function () {
    $post = Post::factory()->create(['is_approved' => false]);

    $this->get(route('posts.show', $post))
        ->assertForbidden();
});

test('admin_can_aprove_post', function () {
    $post = Post::factory()->create(['is_approved' => false]);

    actingAs($this->admin)
        ->patch(route('posts.approve', $post))
        ->assertRedirect(route('posts.index'));
});

test('auth_user_cannot_delete_other_post', function () {
    $otroUsuario = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $otroUsuario->id]);

    actingAs($this->user)
        ->delete(route('posts.destroy', $post))
        ->assertForbidden();
});
