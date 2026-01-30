<x-templates.home-template :title="__('profile.title')" class="h-full">
    <section class="grid grid-cols-[1.5fr_1fr] items-stretch h-full gap-[2rem]">
        <article>
            <form
                enctype="multipart/form-data"
                method="POST"
                action="{{ route('profile.update') }}"
                class="flex flex-col justify-between h-full"
            >
                @csrf
                @method('PUT')
                <article class="space-y-[1rem]">
                    <div class="flex items-center justify-between">
                        <img id="new-avatar" src="{{ auth()->user()->avatar }}" alt="avatar" class="size-[4rem] bg-gray-200 rounded-full"/>
                        <x-atoms.input name="avatar" id="avatar-input" type="file" :label="__('profile.avatar')" class="w-full"/>
                    </div>

                    <x-atoms.input name="name" value="{{ auth()->user()->name }}" :label="__('profile.name')"/>

                    <div class="flexBetween">
                        <p>{{ __('profile.account_verified') }}:</p>
                        @if(auth()->user()->account_verified)
                            <span class="bg-emerald-500 text-white w-[10rem] h-[2.8rem] flexCenter rounded">{{ __('profile.verified') }}</span>
                        @else
                            <x-molecules.dialog modelId="verify-account-modal" :title="__('profile.verify_account_title')">
                                <x-slot:trigger>
                                    <button type="button" data-modal-target="verify-account-modal" data-modal-toggle="verify-account-modal" class="bg-red-500 text-white w-[10rem] h-[2.8rem] flexCenter rounded">{{ __('profile.verify_account_btn') }}</button>
                                </x-slot:trigger>
                                {{ __('profile.verify_account_text') }}
                            </x-molecules.dialog>
                        @endif
                    </div>

                    <div class="flexBetween">
                        <p>{{ __('profile.email_verified') }}:</p>
                        @if(auth()->user()->email_verified_at)
                            <span class="bg-emerald-500 text-white w-[10rem] h-[2.8rem] flexCenter rounded">{{ __('profile.verified') }}</span>
                        @else
                            <a href="/email/verify" class="bg-red-500 text-white w-[10rem] h-[2.8rem] flexCenter rounded">{{ __('profile.verify_email_btn') }}</a>
                        @endif
                    </div>
                </article>

                <button type="submit" class="bg-indigo-500 p-[1rem] self-end text-white rounded">{{ __('profile.save_changes') }}</button>
            </form>
        </article>

        <article class="bg-white rounded-md h-full flex flex-col items-center justify-around p-[1rem]">
            <div class="space-y-[2rem]">
                <img src="{{ auth()->user()->avatar }}" alt="avatar" class="size-[6rem] bg-gray-200 rounded-full mx-auto"/>
                <h1 class="text-2xl">{{ auth()->user()->name }}</h1>
            </div>
            <div class="space-y-[1rem]">
                <div>
                    <span>{{ __('profile.last_update') }}:</span>
                    <span>{{ auth()->user()->updated_at }}</span>
                </div>
                <p>{{ auth()->user()->email }}</p>
                <div>
                    <span>{{ __('profile.role') }}:</span>
                    <span class="capitalize">{{ auth()->user()->role->name }}</span>
                </div>
                @if(auth()->user()->oauth)
                    <div>
                        <span>{{ __('profile.oauth_provider') }}:</span>
                        <span class="capitalize">{{ auth()->user()->oauth_provider }}</span>
                    </div>
                @endif
            </div>
        </article>
    </section>

    <script>
        let avatarInput = document.querySelector('#avatar-input');
        avatarInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if(file){
                const reader = new FileReader();
                reader.onload = function(evt){
                    document.querySelector('#new-avatar').src = evt.target.result;
                }
                reader.readAsDataURL(file);
            }
        })
    </script>
</x-templates.home-template>
