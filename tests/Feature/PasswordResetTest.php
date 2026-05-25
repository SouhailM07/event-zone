<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

beforeEach(function () {
    \App\Models\Role::firstOrCreate(['name' => 'user']);
});

test('guest can view forgot password page', function () {
    $this->get('/forgot-password')
        ->assertStatus(200);
});

test('guest can request a password reset link', function () {
    $user = User::factory()->create(['email' => 'user@example.com']);

    $response = $this->post('/forgot-password', [
        'email' => 'user@example.com',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('status');
});

test('guest cannot request password reset link for unregistered email', function () {
    $response = $this->post('/forgot-password', [
        'email' => 'nonexistent@example.com',
    ]);

    $response->assertSessionHasErrors(['email']);
});

test('guest can view reset password page with token', function () {
    $response = $this->get('/reset-password/sample-token');
    
    $response->assertStatus(200)
        ->assertSee('sample-token');
});

test('guest can reset password with valid token', function () {
    $user = User::factory()->create([
        'email' => 'user@example.com',
        'password' => Hash::make('old-password'),
    ]);

    $token = Password::createToken($user);

    $response = $this->post('/reset-password', [
        'token' => $token,
        'email' => 'user@example.com',
        'password' => 'new-password123',
        'password_confirmation' => 'new-password123',
    ]);

    $response->assertRedirect(route('login'));
    $response->assertSessionHas('status');

    $user->refresh();
    expect(Hash::check('new-password123', $user->password))->toBeTrue();
});
