<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <x-atoms.metall :title="__('banned.title')"/>
    <x-atoms.tailwindcss/>
</head>
<body>
    <main class="flexCenter h-screen">
        <section class="border-2 border-gray-400 aspect-video flexCenter rounded-lg bg-gray-300 h-[16rem]">
            <article class="text-center space-y-[1rem]">
                <x-heroicon-o-no-symbol class="size-[6rem] mx-auto bg-red-500 text-white rounded-full"/>
                <h1>{{ __('banned.heading') }}</h1>
                <h2>{{ __('banned.subheading') }}</h2>
            </article>
        </section>
    </main>
</body>
</html>
