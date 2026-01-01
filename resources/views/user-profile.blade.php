<x-templates.home-template title="user profile" class="h-full">
    <section class="grid grid-cols-[1.5fr_1fr] items-stretch h-full gap-[2rem]">
<article>
    <form
        enctype="multipart/form-data"
    method="POST"
     action="{{route('profile.update')}}" 
     class="flex flex-col justify-between h-full">
     @csrf
     @method('PUT')
        <article class="space-y-[1rem]">
            <div 
            class="flex items-center justify-between">
            <img id="new-avatar" src="{{auth()->user()->avatar}}" alt="avatar" class="size-[4rem] bg-gray-200 rounded-full "/>
            <x-atoms.input name="avatar" id="avatar-input" type="file" label="Avatar" class="w-full"/>
        </div>
        <x-atoms.input name="name" value="{{auth()->user()->name}}" label="Name"/>
            <div class="flexBetween">
                <p>Account Verified :</p>
                @if(auth()->user()->account_verified)
                <span class="bg-emerald-500 text-white w-[10rem] h-[2.8rem] flexCenter rounded">Verified</span>
                @else
                <x-molecules.dialog modelId="verify-account-modal" title="Verify Your Account">
                    <x-slot:trigger>
                        <button type="button" data-modal-target="verify-account-modal" data-modal-toggle="verify-account-modal" class="bg-red-500 text-white w-[10rem] h-[2.8rem] flexCenter rounded">Verify Account</button>
                    </x-slot:trigger>
                    Reach Us through those contacts to verify your account.
                </x-molecules.dialog>
                @endif
            </div>
            <div class="flexBetween">
                <p>Email Verified :</p>
                @if(auth()->user()->email_verified_at)
                <span class="bg-emerald-500 text-white w-[10rem] h-[2.8rem] flexCenter rounded">Verified</span>
                @else
                <a href="/email/verify" class="bg-red-500 text-white w-[10rem] h-[2.8rem] flexCenter rounded">Verify Email</a>
                @endif
            </div>
        </article>
            <button type="submit" class="bg-indigo-500 p-[1rem] self-end text-white rounded">Save Changes</button>
        </form>
</article>
<article class="bg-white rounded-md  h-full flex flex-col items-center justify-around p-[1rem]">
        <div class="space-y-[2rem]">
            <img  src="{{auth()->user()->avatar}}" alt="avatar" class="size-[6rem] bg-gray-200 rounded-full mx-auto"/>
            <h1 class="text-2xl">{{auth()->user()->name}}</h1>
        </div>
        <div class="space-y-[1rem]">
            <div>
                <span>Last Update :</span>
                <span>{{auth()->user()->updated_at}}</span>
            </div>
            <p>{{auth()->user()->email}}</p>
            <div>
                <span>Role :</span>
                <span class="capitalize">{{auth()->user()->role->name}}</span>
            </div>
            @if(auth()->user()->oauth)
            <div>
                <span>OAuth Provider :</span>
                <span class="capitalize">{{auth()->user()->oauth_provider}}</span>
            </div>
            @endif
        </div>
        </article>
    </section>
    <script>
        let avatarInput=document.querySelector('#avatar-input');
        avatarInput.addEventListener('change',(e)=>{
            const file=e.target.files[0];
            if(file){
                            console.log(file)
                const reader=new FileReader();
                reader.onload=function(evt){
                    document.querySelector('#new-avatar').src=evt.target.result;
                }
                reader.readAsDataURL(file);
            }
        })
    </script>
</x-templates.home-template>