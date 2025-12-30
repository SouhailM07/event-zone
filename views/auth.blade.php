<!DOCTYPE html>
<html lang="en">
<head>
    <x-atoms.metall title="auth page"/>
    <x-atoms.tailwindcss/>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white w-[28rem] rounded-3xl shadow-xl px-6 py-2 relative">

        <!-- Logo -->
        <div class="flex justify-center mb-3">
            <img src="/images/logo.jpg" class="w-16 h-16 rounded-full" alt="Logo">
        </div>

        <!-- Tabs -->
        <div class="flex rounded-full bg-gray-200 p-1 mb-4">
            <button class="w-1/2 py-2 rounded-full tab-active">
                Login
            </button>
            <button class="w-1/2 py-2 rounded-full">
                Register
            </button>
        </div>

        <!-- Email Input -->
        <div class="mb-4">
            <label class="text-gray-600 text-sm">Email Address</label>
            <div class="flex items-center border rounded-lg px-3 py-2 bg-gray-50">
                {{-- <x-icon name="mail" class="w-4 h-4 text-gray-400" /> --}}
                <input type="email" placeholder="Email Address"
                       class="w-full bg-transparent outline-none ml-2">
            </div>
        </div>

        <!-- Password Input -->
        <div class="mb-4">
            <label class="text-gray-600 text-sm">Password</label>
            <div class="flex items-center border rounded-lg px-3 py-2 bg-gray-50">
                {{-- <x-icon name="lock" class="w-4 h-4 text-gray-400" /> --}}
                <input type="password" placeholder="Password"
                       class="w-full bg-transparent outline-none ml-2">
            </div>
        </div>

        <!-- Remember + Forgot -->
        <div class="flex justify-between items-center mb-5">
            <label class="flex items-center gap-2 text-gray-700">
                <input type="checkbox">
                Remember me
            </label>

            <a href="#" class="text-blue-600 text-sm hover:underline">
                Forget password?
            </a>
        </div>

        <!-- Login Button -->
        <button class="w-full bg-gray-200 hover:bg-gray-300 py-3 rounded-full text-gray-900 font-medium mb-6">
            Login
        </button>

        <!-- Or Login With -->
        <p class="text-center text-gray-500 mb-4">Or Login With</p>

        <div class="flex gap-4">
            <!-- Google -->
            <x-atoms.auth-btn type="google"/>
            <!-- Facebook -->
            <x-atoms.auth-btn type="facebook"/>
        </div>

    </div>

</body>
</html>
