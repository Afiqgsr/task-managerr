<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class RbacTest extends TestCase
{
    use RefreshDatabase;

    public function testAdminCanAccessAdminDashboard()
    {
        $adminUser = User::factory()->create();
        $adminUser->assignRole('admin');

        $response = $this->actingAs($adminUser)->get('/admin');

        $response->assertStatus(200);
    }

    public function testUserCannotAccessAdminDashboard()
    {
        $regularUser = User::factory()->create();
        $regularUser->assignRole('user');

        $response = $this->actingAs($regularUser)->get('/admin');

        $response->assertStatus(403);
    }

    public function testUserWithCreatePostsPermissionCanCreatePost()
    {
        $user = User::factory()->create();
        $user->givePermissionTo('create posts');

        $response = $this->actingAs($user)->post('/posts', [
            'title' => 'Test Post',
            'content' => 'This is a test post',
        ]);

        $response->assertStatus(201);
    }

    public function testUserWithoutCreatePostsPermissionCannotCreatePost()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/posts', [
            'title' => 'Test Post',
            'content' => 'This is a test post',
        ]);

        $response->assertStatus(403);
    }
}