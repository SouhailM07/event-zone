<!DOCTYPE html>
<html lang="en">
<head>
    <x-atoms.metall title="dashboard"/>
    <x-atoms.tailwindcss/>
</head>
<body class="bg-gray-100 ">
    <x-organisms.admin-navbar/>
    {{$slot}}
</body>
</html>