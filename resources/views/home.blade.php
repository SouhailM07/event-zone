<!DOCTYPE html>
<html lang="en">
<head>
    <x-atoms.metall title="Home"/>
    <x-atoms.tailwindcss/>
</head>
<body>
    @auth
        you are logged in
    @endauth
    @guest
        you are guest
    @endguest
</body>
</html>