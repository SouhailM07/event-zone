<?php

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

beforeEach(function () {
    // Seed default roles
    Role::firstOrCreate(['name' => 'user']);
    Role::firstOrCreate(['name' => 'admin']);
    Role::firstOrCreate(['name' => 'owner']);
});

test('guest can view registration form', function () {
    $response = $this->get('/register');
    $response->assertStatus(200);
});

test('user can register successfully', function () {
    Event::fake();

    $response = $this->post('/register', [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $response->assertRedirect('/');
    $this->assertDatabaseHas('users', [
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ]);

    Event::assertDispatched(Registered::class);
    $this->assertAuthenticated();
});

test('registration validation fails for short name or mismatch password', function () {
    $response = $this->post('/register', [
        'name' => 'Jo', // too short
        'email' => 'not-an-email',
        'password' => 'pass',
        'password_confirmation' => 'diff-pass',
    ]);

    $response->assertSessionHasErrors(['name', 'email', 'password']);
    $this->assertGuest();
});

test('guest can view login form', function () {
    $response = $this->get('/login');
    $response->assertStatus(200);
});

test('user can login successfully', function () {
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => Hash::make('secret-password'),
    ]);

    $response = $this->post('/login', [
        'email' => 'test@example.com',
        'password' => 'secret-password',
    ]);

    $response->assertRedirect('/');
    $this->assertAuthenticatedAs($user);
});

test('login validation fails and rejects invalid credentials', function () {
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => Hash::make('secret-password'),
    ]);

    $response = $this->post('/login', [
        'email' => 'test@example.com',
        'password' => 'wrong-password',
    ]);

    $response->assertSessionHasErrors(['email']);
    $this->assertGuest();
});

test('user can logout successfully via post', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/logout');

    $response->assertRedirect('/login');
    $this->assertGuest();
});

test('user can logout successfully via get', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/logout');

    $response->assertRedirect('/login');
    $this->assertGuest();
});

test('profile requires authentication', function () {
    $this->get('/profile')->assertRedirect('/login');
});

test('authenticated user can view profile page', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/profile');
    $response->assertStatus(200);
});

test('authenticated user can update profile details', function () {
    Storage::fake('public');
    $user = User::factory()->create(['name' => 'Old Name']);

    $avatar = UploadedFile::fake()->create('avatar.jpg', 100, 'image/jpeg');

    $response = $this->actingAs($user)->put(route('profile.update'), [
        'name' => 'New Name',
        'avatar' => $avatar,
    ]);

    $response->assertRedirect(route('profile'));
    $response->assertSessionHas('success');

    $user->refresh();
    expect($user->name)->toBe('New Name');
    expect($user->avatar)->not->toBe('/images/default-avatar.png');

    // Extract path to verify storage
    $avatarPath = str_replace('/storage/', '', $user->avatar);
    Storage::disk('public')->assertExists($avatarPath);
});
