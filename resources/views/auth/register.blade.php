<form method="POST" action="/register">
    @csrf
    <input type="text" name="name" placeholder="Name">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">

    <button type="submit">Register</button>
</form>
<form method="post" action=" {{ route('logout') }} ">
    @csrf
    <button type="submit">Logout</button>
</form>
