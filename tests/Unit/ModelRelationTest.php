<?php

use App\Models\Category;
use App\Models\Event;
use App\Models\Role;
use App\Models\Ticket;
use App\Models\User;

beforeEach(function () {
    Role::firstOrCreate(['name' => 'user']);
    Role::firstOrCreate(['name' => 'admin']);
    Role::firstOrCreate(['name' => 'owner']);
});

test('user belongs to role', function () {
    $role = Role::where('name', 'user')->first();
    $user = User::factory()->create(['role_id' => $role->id]);

    expect($user->role)->toBeInstanceOf(Role::class)
        ->and($user->role->id)->toBe($role->id);
});

test('user has many events', function () {
    $user = User::factory()->create();
    $event1 = Event::factory()->create(['userId' => $user->id]);
    $event2 = Event::factory()->create(['userId' => $user->id]);

    expect($user->events)->toHaveCount(2)
        ->and($user->events->pluck('id'))->toContain($event1->id, $event2->id);
});

test('user has many tickets', function () {
    $user = User::factory()->create();
    $ticket1 = Ticket::factory()->create(['user_id' => $user->id]);
    $ticket2 = Ticket::factory()->create(['user_id' => $user->id]);

    expect($user->tickets)->toHaveCount(2)
        ->and($user->tickets->pluck('id'))->toContain($ticket1->id, $ticket2->id);
});

test('event belongs to user and belongs to many categories', function () {
    $user = User::factory()->create();
    $category1 = Category::factory()->create();
    $category2 = Category::factory()->create();
    
    $event = Event::factory()->create(['userId' => $user->id]);
    $event->categories()->attach([$category1->id, $category2->id]);

    expect($event->user)->toBeInstanceOf(User::class)
        ->and($event->user->id)->toBe($user->id)
        ->and($event->categories)->toHaveCount(2)
        ->and($event->categories->pluck('id'))->toContain($category1->id, $category2->id);
});

test('ticket belongs to user and belongs to event', function () {
    $user = User::factory()->create();
    $event = Event::factory()->create();
    $ticket = Ticket::factory()->create([
        'user_id' => $user->id,
        'event_id' => $event->id,
    ]);

    expect($ticket->user)->toBeInstanceOf(User::class)
        ->and($ticket->user->id)->toBe($user->id)
        ->and($ticket->event)->toBeInstanceOf(Event::class)
        ->and($ticket->event->id)->toBe($event->id);
});

test('category belongs to many events', function () {
    $category = Category::factory()->create();
    $event1 = Event::factory()->create();
    $event2 = Event::factory()->create();

    $category->events()->attach([$event1->id, $event2->id]);

    expect($category->events)->toHaveCount(2)
        ->and($category->events->pluck('id'))->toContain($event1->id, $event2->id);
});
