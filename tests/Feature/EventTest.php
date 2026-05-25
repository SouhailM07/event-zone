<?php

use App\Models\Category;
use App\Models\Event as EventModel;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    // Seed default roles
    \App\Models\Role::firstOrCreate(['name' => 'user']);
});

test('authenticated user can see approved events on events page', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create(['name' => 'Concerts']);
    $event = EventModel::factory()->create([
        'validation' => 'approved',
    ]);
    $event->categories()->attach($category);

    $response = $this->actingAs($user)->get('/events');
    $response->assertStatus(200);
    $response->assertSee($event->title);
});

test('unapproved events are not visible on events page', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create(['name' => 'Concerts']);
    $pendingEvent = EventModel::factory()->create([
        'validation' => 'pending',
    ]);
    $pendingEvent->categories()->attach($category);

    $response = $this->actingAs($user)->get('/events');
    $response->assertStatus(200);
    $response->assertDontSee($pendingEvent->title);
});

test('guest cannot access event creation form', function () {
    $this->get('/events/create')->assertRedirect('/login');
});

test('authenticated user can view event creation form', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/events/create');
    $response->assertStatus(200);
});

test('authenticated user can create an event', function () {
    Storage::fake('public');
    $user = User::factory()->create();
    $category = Category::factory()->create();
    $thumbnail = UploadedFile::fake()->create('event.jpg', 100, 'image/jpeg');

    $response = $this->actingAs($user)->post('/events', [
        'title' => 'Sample Concert',
        'description' => 'This is a sample description.',
        'thumbnail' => $thumbnail,
        'location' => 'Rabat',
        'coordination' => '34.013, -6.832',
        'price' => 150,
        'quantity_type' => 'custom',
        'quantity' => 50,
        'started_at' => now()->addDay()->format('Y-m-d H:i:s'),
        'categories' => [$category->id],
    ]);

    $response->assertRedirect(route('home'));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('events', [
        'title' => 'Sample Concert',
        'userId' => $user->id,
        'validation' => 'pending', // created events are pending by default
    ]);

    $event = EventModel::where('title', 'Sample Concert')->first();
    expect($event->categories->contains($category))->toBeTrue();
    Storage::disk('public')->assertExists($event->thumbnail);
});

test('event creation validation requires categories and dates', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/events', [
        'title' => '', // validation error
        'description' => 'Some desc',
        'location' => 'Rabat',
        'coordination' => '34, -6',
        'price' => -10, // validation error (min 0)
        'quantity_type' => 'custom',
        'started_at' => 'invalid-date', // validation error
        'categories' => [], // validation error
    ]);

    $response->assertSessionHasErrors(['title', 'price', 'started_at', 'categories']);
});

test('user can view specific event details', function () {
    $user = User::factory()->create();
    $event = EventModel::factory()->create();

    $response = $this->actingAs($user)->get('/events/' . $event->id);
    $response->assertStatus(200);
    $response->assertSee($event->title);
});

test('user can access edit form of event', function () {
    $user = User::factory()->create();
    $event = EventModel::factory()->create(['userId' => $user->id]);

    $response = $this->actingAs($user)->get('/events/' . $event->id . '/edit');
    $response->assertStatus(200);
    $response->assertSee($event->title);
});

test('user can update event details', function () {
    Storage::fake('public');
    $user = User::factory()->create();
    $event = EventModel::factory()->create(['userId' => $user->id]);
    $category = Category::factory()->create();
    $newThumbnail = UploadedFile::fake()->create('updated.jpg', 100, 'image/jpeg');

    $response = $this->actingAs($user)->put('/events/' . $event->id, [
        'title' => 'Updated Event Title',
        'description' => 'Updated desc',
        'thumbnail' => $newThumbnail,
        'location' => 'Casablanca',
        'coordination' => '33.573, -7.589',
        'price' => 200,
        'quantity_type' => 'infinite',
        'started_at' => now()->addDays(2)->format('Y-m-d H:i:s'),
        'categories' => [$category->id],
    ]);

    $response->assertRedirect(route('home'));
    $response->assertSessionHas('success');

    $event->refresh();
    expect($event->title)->toBe('Updated Event Title');
    expect($event->price)->toBe(200);
    expect($event->quantity)->toBe(0); // quantity is 0 for infinite quantity_type
    Storage::disk('public')->assertExists($event->thumbnail);
});

test('user can delete their own event', function () {
    Storage::fake('public');
    $user = User::factory()->create();
    $event = EventModel::factory()->create([
        'userId' => $user->id,
        'thumbnail' => 'thumbnails/test.jpg',
    ]);

    // Put mock thumbnail to simulate deletion
    Storage::disk('public')->put('thumbnails/test.jpg', 'fake content');

    $response = $this->actingAs($user)->delete('/events/' . $event->id);
    $response->assertRedirect();
    $response->assertSessionHas('success');

    $this->assertDatabaseMissing('events', ['id' => $event->id]);
    Storage::disk('public')->assertMissing('thumbnails/test.jpg');
});
