@props(['title'=>"home","class"=>""])
<!DOCTYPE html>
<html lang="en">
<head>
    <x-atoms.metall title="{{$title}}"/>
    <x-atoms.tailwindcss/>
</head>
<body class=" bg-gray-200">
        <x-organisms.navbar/>
    <div class="w-full flex ">
    <x-organisms.aside/>
        <main @class(["w-full p-[1rem] ".$class])>
            {{ $slot }}
        </main>
    </div>
</body>
</html>