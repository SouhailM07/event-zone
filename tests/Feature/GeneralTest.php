<?php

use App\Models\User;

beforeEach(function () {
    \App\Models\Role::firstOrCreate(['name' => 'user']);
});

test('user can access support page', function () {
    $this->get('/support')
        ->assertStatus(200);
});

test('user can switch language to supported locale', function () {
    $response = $this->from('/support')
        ->get('/lang/fr');

    $response->assertRedirect('/support');
    $response->assertSessionHas('locale', 'fr');
});

test('user cannot switch language to unsupported locale', function () {
    $response = $this->from('/support')
        ->get('/lang/es');

    $response->assertRedirect('/support');
    expect(session('locale'))->not->toBe('es');
});

test('banned user is redirected to banned page', function () {
    $bannedUser = User::factory()->banned()->create();

    $response = $this->actingAs($bannedUser)->get('/events');

    $response->assertRedirect('/banned');
});

test('banned user can access banned page without infinite redirects', function () {
    $bannedUser = User::factory()->banned()->create();

    $response = $this->actingAs($bannedUser)->get('/banned');

    $response->assertStatus(200);
});
