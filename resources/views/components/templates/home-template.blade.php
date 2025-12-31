@props(['title'=>"home","class"=>""])
<!DOCTYPE html>
<html lang="en">
<head>
    <x-atoms.metall title="{{$title}}"/>
    <x-atoms.tailwindcss/>
</head>
<body class="flex bg-gray-200">
    <x-organisms.aside/>
    <div class="w-full flex flex-col">
        <x-organisms.navbar/>
        <main @class(["p-[1rem] ".$class])>
            {{ $slot }}
        </main>
    </div>
</body>
</html>