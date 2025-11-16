<?php

namespace Tests\Feature\Filament;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
    }

    public function test_users_resource_exists(): void
    {
        $this->assertTrue(class_exists(UserResource::class));
    }

    public function test_user_can_be_created(): void
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ];

        User::create($userData);

        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }

    public function test_user_can_be_created_with_role(): void
    {
        $role = Role::create(['name' => 'editor', 'guard_name' => 'web']);

        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $user->assignRole($role);

        $this->assertTrue($user->hasRole($role));
    }

    public function test_user_roles_can_be_updated(): void
    {
        $user = User::factory()->create();
        $role1 = Role::create(['name' => 'editor', 'guard_name' => 'web']);
        $role2 = Role::create(['name' => 'author', 'guard_name' => 'web']);

        $user->assignRole($role1);
        $this->assertTrue($user->hasRole($role1));

        $user->syncRoles([$role2]);
        $user->refresh();

        $this->assertFalse($user->hasRole($role1));
        $this->assertTrue($user->hasRole($role2));
    }

    public function test_user_can_be_deleted(): void
    {
        $user = User::factory()->create();
        $userId = $user->id;

        $user->delete();

        $this->assertDatabaseMissing('users', ['id' => $userId]);
    }

    public function test_user_password_can_be_hashed(): void
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $this->assertTrue(\Hash::check('password', $user->password));
    }
}

