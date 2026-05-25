<?php

use App\Models\Event;
use App\Models\User;

beforeEach(function () {
    \App\Models\Role::firstOrCreate(['name' => 'user']);
});

test('guest cannot view inventory page', function () {
    $this->get('/inventory')->assertRedirect('/login');
});

test('authenticated user can view their own inventory of events', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();

    $myEvent = Event::factory()->create(['userId' => $user->id, 'title' => 'My Secret Event']);
    $otherEvent = Event::factory()->create(['userId' => $otherUser->id, 'title' => 'Someone Else\'s Event']);

    $response = $this->actingAs($user)->get('/inventory');

    $response->assertStatus(200);
    $response->assertSee('My Secret Event');
    $response->assertDontSee('Someone Else\'s Event');
});

test('authenticated user can view specific inventory event details', function () {
    $user = User::factory()->create();
    $event = Event::factory()->create(['userId' => $user->id]);

    $response = $this->actingAs($user)->get('/inventory/' . $event->id);

    $response->assertStatus(200);
    $response->assertSee($event->title);
});

test('viewing non-existent inventory event returns 302 redirect with error', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/inventory/999');

    $response->assertStatus(302);
    $response->assertSessionHas('error', 'event not found !');
});
