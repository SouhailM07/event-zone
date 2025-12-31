<!DOCTYPE html>
<html lang="en">
<head>
    <x-atoms.metall title="Home"/>
    <x-atoms.tailwindcss/>
</head>
<body class="flex bg-gray-200">
    <x-organisms.aside/>
    <div class="w-full ">
        <x-organisms.navbar/>
        <main class=" p-[1rem]">
            <div class="flex h-[80vh] gap-[1rem]">
                <div class="w-full">
                    <img src="{{asset('images/auth.jpg')}}" class="h-[80vh] w-full rounded-md"/>
                </div>
                <div class="">
                    <div   inline-datepicker data-date="02/25/2024"></div>
                </div>
            </div>
        </main>
        </div>
            {{-- <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script> --}}
    </body>
</html>