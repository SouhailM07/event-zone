@php
 $books = [
[
'title' => '1984',
'author' => 'George Orwell',
'published_date' => '1949-06-08',
'cover' => 'https://covers.openlibrary.org/b/id/7222246-L.jpg',
'description' => 'A dystopian social science fiction novel and cautionary tale about the dangers of totalitarianism.'
],
[
'title' => 'Pride and Prejudice',
'author' => 'Jane Austen',
'published_date' => '1813-01-28',
'cover' => 'https://covers.openlibrary.org/b/id/8231856-L.jpg',
'description' => 'A romantic novel of manners that depicts the British Regency era.'
],
[
'title' => 'The Great Gatsby',
'author' => 'F. Scott Fitzgerald',
'published_date' => '1925-04-10',
'cover' => 'https://covers.openlibrary.org/b/id/7222161-L.jpg',
'description' => 'A novel about the decline of the American Dream in the 1920s.'
],
];
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <x-atoms.metall title="home"/>
    <x-atoms.tailwindcss/>
</head>
<body class=" min-h-screen flex overflow-x-hidden gap-x-[2rem]">
    <x-organisms.aside/>
    <div class="w-full px-2 py-3">
        <x-organisms.navbar/>
        <main class="space-y-[4rem]">
            <x-organisms.hero/>
            <x-molecules.book-recommendation :books="$books"/>
            <x-molecules.book-shelf :books="$books" title="hello" link="#"/>
        </main>
    </div>
                            <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
</body>
</html>