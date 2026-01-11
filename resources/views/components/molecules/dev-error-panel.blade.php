@props(["error"])

<style>
    body{
        overflow: hidden;
    }
</style>
<div class="z-[1000] flexCenter bg-black/30 h-screen top-0 fixed w-full">
    <main class="w-3/4 overflow-y-auto p-[2rem] aspect-video bg-slate-700 rounded-xl">
    <h1 class="text-2xl text-red-400 font-medium">Error</h1>
    <p class="w-full wrap-break-word mt-[2rem] text-white font-medium">
            {{$error}}
    </p>
    </main>
</div>