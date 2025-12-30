<!DOCTYPE html>
<html lang="en">
<head>
    <x-atoms.metall title="Home"/>
    <x-atoms.tailwindcss/>
</head>
<body>
    @auth
        you are logged in
  <p>Welcome, {{ auth()->user()->name }}!</p>
    <p>Email: {{ auth()->user()->email }}</p>
    <p>Role ID: {{ auth()->user()->role_id }}</p>
    @endauth
    @guest
        you are guest
    @endguest
</body>
</html>