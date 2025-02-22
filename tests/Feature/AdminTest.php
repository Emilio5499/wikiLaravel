<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

beforeEach(function () {
    $this->admin = User::factory()->create(['role' => 'admin']);
    $this->user = User::factory()->create(['role' => 'user']);
});

test('admin_can_post_without_approval', function () {
    actingAs($this->admin)
        ->post(route('posts.store'), [
            'title' => 'Post de admin',
            'content' => 'Contenido de prueba.',
        ])
        ->assertRedirect(route('posts.index'));

    assertDatabaseHas('posts', [
        'title' => 'Post de admin',
        'content' => 'Contenido de prueba.',
        'user_id' => $this->admin->id,
        'is_approved' => true,
    ]);
});

test('admin_can_approve_any_post', function () {
    $post = Post::factory()->create(['is_approved' => false]);

    actingAs($this->admin)
        ->patch(route('posts.approve', $post))
        ->assertRedirect(route('posts.index'));

    assertDatabaseHas('posts', [
        'id' => $post->id,
        'is_approved' => true,
    ]);
});

test('admin_can_delete_any_post', function () {
    $post = Post::factory()->create();

    actingAs($this->admin)
        ->delete(route('posts.destroy', $post))
        ->assertRedirect(route('posts.index'));

    assertDatabaseMissing('posts', ['id' => $post->id]);
});

test('user_cannot_access_admin_dashboard', function () {
    actingAs($this->user)
        ->get(route('admin.dashboard'))
        ->assertForbidden();
});
