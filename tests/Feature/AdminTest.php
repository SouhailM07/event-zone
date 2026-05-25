<?php

use App\Models\Category;
use App\Models\Event;
use App\Models\Role;
use App\Models\User;

beforeEach(function () {
    Role::firstOrCreate(['name' => 'user']);
    Role::firstOrCreate(['name' => 'admin']);
    Role::firstOrCreate(['name' => 'owner']);
});

test('guest cannot access admin dashboard', function () {
    $response = $this->get('/admin-panel/dashboard');
    $response->assertRedirect('/login');
});

test('unverified user cannot access admin dashboard', function () {
    $user = User::factory()->unverified()->create();
    
    $response = $this->actingAs($user)->get('/admin-panel/dashboard');
    
    // Redirects to email verification notice
    $response->assertRedirect('/email/verify');
});

test('verified user can access admin dashboard due to lack of role check in routing middleware', function () {
    $user = User::factory()->create(); // verified by default
    
    $response = $this->actingAs($user)->get('/admin-panel/dashboard');
    $response->assertStatus(200);
});

test('admin can view events in admin panel and filter them', function () {
    $admin = User::factory()->admin()->create();
    $category = Category::factory()->create();
    $event = Event::factory()->create(['validation' => 'pending']);
    $event->categories()->attach($category);

    $response = $this->actingAs($admin)->get('/admin-panel/events?validation=pending&category=' . $category->id);
    
    $response->assertStatus(200);
    $response->assertSee($event->title);
});

test('admin can approve a pending event', function () {
    $admin = User::factory()->admin()->create();
    $event = Event::factory()->pending()->create();

    $response = $this->actingAs($admin)->put('/admin-panel/events/' . $event->id, [
        'validation' => 'approved',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success', 'event validation was updated');
    
    $event->refresh();
    expect($event->validation)->toBe('approved');
    expect($event->whyRejected)->toBe('');
});

test('admin can reject a pending event with a reason', function () {
    $admin = User::factory()->admin()->create();
    $event = Event::factory()->pending()->create();

    $response = $this->actingAs($admin)->put('/admin-panel/events/' . $event->id, [
        'validation' => 'rejected',
        'whyRejected' => 'Inappropriate content',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success', 'event validation was updated');
    
    $event->refresh();
    expect($event->validation)->toBe('rejected');
    expect($event->whyRejected)->toBe('Inappropriate content');
});

test('admin can view users list', function () {
    $admin = User::factory()->admin()->create();
    $user = User::factory()->create(['name' => 'Regular User']);

    $response = $this->actingAs($admin)->get('/admin-panel/users');

    $response->assertStatus(200);
    $response->assertSee('Regular User');
});

test('admin can toggle verify user status', function () {
    $admin = User::factory()->admin()->create();
    $user = User::factory()->create(['account_verified' => false]);

    $response = $this->actingAs($admin)->put('/admin-panel/verify-user', [
        'userId' => $user->id,
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('status', 'User verification status updated successfully.');
    
    $user->refresh();
    expect((bool) $user->account_verified)->toBeTrue();
});

test('admin can toggle ban user status', function () {
    $admin = User::factory()->admin()->create();
    $user = User::factory()->create(['is_banned' => false]);

    $response = $this->actingAs($admin)->put('/admin-panel/ban-user', [
        'userId' => $user->id,
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('status', 'User ban status updated successfully.');
    
    $user->refresh();
    expect((bool) $user->is_banned)->toBeTrue();
});

test('admin can change user role', function () {
    $admin = User::factory()->admin()->create();
    $user = User::factory()->create();
    $newRole = Role::where('name', 'owner')->first();

    $response = $this->actingAs($admin)->put('/admin-panel/change-user-role', [
        'userId' => $user->id,
        'roleId' => $newRole->id,
    ]);

    $response->assertRedirect();
    
    $user->refresh();
    expect($user->role_id)->toBe($newRole->id);
});

test('admin can delete a regular user', function () {
    $admin = User::factory()->admin()->create();
    $user = User::factory()->create(['avatar' => '/images/default-avatar.png']);

    $response = $this->actingAs($admin)->delete('/admin-panel/delete-user', [
        'userId' => $user->id,
    ]);

    $response->assertRedirect(route('admin.users'));
    $response->assertSessionHas('status', 'User deleted successfully.');
    
    $this->assertDatabaseMissing('users', ['id' => $user->id]);
});
