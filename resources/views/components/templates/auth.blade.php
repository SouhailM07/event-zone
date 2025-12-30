<!DOCTYPE html>
<html lang="en">
<head>
    <x-atoms.metall title="Auth"/>
    <x-atoms.tailwindcss/>
</head>
<body >
    <main class=" min-h-screen w-full bg-white overflow-hidden shadow-2xl grid grid-cols-[2fr_1.5fr]">
        <!-- LEFT IMAGE SECTION -->
        <section class="relative ">
            <img
                src={{ asset('images/auth.jpg') }}
                alt="img"
                class="w-full absolute  h-full object-cover"
            />

            <div class="absolute inset-0 bg-black/40"></div>

            <article class=" text-white h-full flex flex-col justify-between p-[1rem] relative z-[1]">
                <h1 class="text-4xl font-bold">Events Zone</h1>
                <div class="space-y-3">
                    <h1 class="text-3xl font-bold">Welcome</h1>
                    <p class="text-sm opacity-90">
                        Log in to your account to manage your bookings,
                        preferences, and more.
                    </p>
                   <div class="flexBetween pt-4 text-sm">
                       <p class=" opacity-70 ">
                           © Events Zone 2026. All rights reserved.
                        </p>
                        <div class="flex gap-[3rem]">
                            <a href="#" class="underline font-bold">Terms Of Service</a>
                            <a href="#" class="underline font-bold">Privacy Policy</a>
                        </div>
                        </div> 
                </div>
            </article>
        </section>

        <!-- RIGHT FORM SECTION -->
        <section class="flex items-center justify-center p-10">
            <article class="w-full  max-w-md">
                    {{-- form --}}
                    {{ $slot }}
                    {{-- form --}}
                    <!-- SOCIAL LOGIN -->
                    <div class="pt-2">
                        <div class="relative text-center">
                            <span class="text-xs text-gray-400 bg-white px-3">
                                Or continue with
                            </span>
                            <div class="absolute inset-x-0 top-1/2 h-px bg-gray-200 -z-10"></div>
                        </div>

                        <div class="flex justify-center gap-3 mt-4">
                            <a href="{{route("google.login")  }}" class="border rounded-lg px-4 w-full py-2 text-sm hover:bg-gray-100">
                                Google
                            </a>
                        </div>
                    </div>
                </form>

            </article>
        </section>

    </main>

</body>
</html>
