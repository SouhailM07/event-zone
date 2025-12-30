<h2 class="text-2xl font-bold text-gray-800">
Login Now!
</h2>
<p class="text-sm text-gray-500 mt-1">
Welcome back! Please enter your details.
</p>
<form class="mt-6 space-y-5" method="POST" action="{{ route('login') }}">
@csrf
<!-- EMAIL -->
    <x-atoms.input icon="envelope" label="Email" type="email" placeholder="example@gmail.com" value=""/>
    <x-atoms.input icon="lock-closed" label="Password" type="password" name="password" required placeholder="Your Password"/>
                    <!-- OPTIONS -->
                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" class="rounded text-blue-600">
                            Remember me
                        </label>

                        <a href="#" class="text-blue-600 hover:underline">
                            Forgot password?
                        </a>
                    </div>
                    <!-- LOGIN BUTTON -->
                    <button
                        type="submit"
                        class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2.5 rounded-lg transition"
                    >
                        Log in →
                    </button>

                    <!-- SIGN UP -->
                    <p class="text-center text-sm text-gray-500">
                        Don’t have an account?
                        <a href="#" class="text-blue-600 font-medium hover:underline">
                            Sign Up
                        </a>
                    </p>