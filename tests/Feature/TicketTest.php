<?php

use App\Models\Event;
use App\Models\Ticket;
use App\Models\User;

beforeEach(function () {
    \App\Models\Role::firstOrCreate(['name' => 'user']);
});

test('guest cannot access tickets page', function () {
    $this->get('/tickets')->assertRedirect('/login');
});

test('authenticated user can view their tickets list', function () {
    $user = User::factory()->create();
    $event = Event::factory()->create();
    $ticket = Ticket::factory()->create(['user_id' => $user->id, 'event_id' => $event->id]);

    $response = $this->actingAs($user)->get('/tickets');

    $response->assertStatus(200);
    $response->assertSee($event->title);
});

test('authenticated user can purchase a ticket successfully', function () {
    $user = User::factory()->create();
    $event = Event::factory()->create();

    $response = $this->actingAs($user)->post('/tickets', [
        'user_id' => $user->id,
        'event_id' => $event->id,
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success', 'You got a ticket , enjoy !');

    $this->assertDatabaseHas('tickets', [
        'user_id' => $user->id,
        'event_id' => $event->id,
        'used' => false,
    ]);
});

test('ticket purchase validation fails for missing parameters or non-existent user/event', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/tickets', [
        'user_id' => 999, // non-existent user
        'event_id' => 999, // non-existent event
    ]);

    $response->assertSessionHasErrors(['user_id', 'event_id']);
});
