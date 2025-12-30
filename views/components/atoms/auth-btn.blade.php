@props(["type" => "google"])

@switch($type)
@case('google') 
<button class="flex-1 flex items-center justify-center gap-2 bg-white border rounded-full py-3 shadow-sm hover:bg-gray-50">
        <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5">
        Google 
</button>
@break
@case('facebook')
    <button class="flex-1 flex items-center justify-center gap-2 bg-blue-600 text-white border rounded-full py-3 shadow-sm hover:bg-blue-700">
        <img src="https://upload.wikimedia.org/wikipedia/commons/0/05/Facebook_Logo_%282019%29.png" class="w-5">
        Facebook
    </button>
    @break

@case('twitter')
    <button class="flex-1 flex items-center justify-center gap-2 bg-blue-400 text-white border rounded-full py-3 shadow-sm hover:bg-blue-500">
        <img src="https://upload.wikimedia.org/wikipedia/commons/4/4f/Twitter-logo.svg" class="w-5">
        Twitter
    </button>
    @break

@default
    <button class="flex-1 flex items-center justify-center gap-2 bg-gray-200 border rounded-full py-3 shadow-sm">
        Social
    </button>
@endswitch
