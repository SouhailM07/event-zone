@php
    $userId=request('userId');
    $search=request('search');
@endphp
<x-templates.admin-template>
<main class="p-[1rem]">
    <section class="grid [height:calc(100vh-8rem)] gap-[1rem] grid-cols-[1fr_3fr]">
        @if($userId)
        @php
        $selectedUser = \App\Models\User::find($userId);
        @endphp
        <article class=" border border-gray-400 rounded-md row-span-full items-center justify-between flex-col flex p-2">
            <div class="w-full space-y-[2rem] ">
                <div class="flex justify-between">
                    <img src={{$selectedUser['avatar']}} alt="avatar" class="rounded-full size-[6rem]"/>
                    <div class="flex flex-col gap-2 justify-center items-end">
                        @if($selectedUser['account_verified'])
                        <span class="text-emerald-500 font-medium text-sm">Verified Account</span>
                        @else
                        <span class="text-red-500 font-medium text-sm">Unverified Account</span>
                        @endif
                        @if($selectedUser['email_verified_at'])
                        <span class="text-emerald-500 font-medium text-sm">Email Verified</span>
                        @else
                        <span class="text-red-500 font-medium text-sm">Email Not Verified</span>
                        @endif
                        <a href="#" class="text-sm bg-gray-300  p-2 rounded">
                            <x-heroicon-o-clock class="size-[1.2rem] inline-block mr-2"/>
                            <span>View User History</span>
                        </a>
                    </div>
                </div>
                <div class="my-2 space-y-2  text-sm self-start font-medium ">
                    <h1 class=""><span>Name : </span> <span class="">
                        {{$selectedUser['name']}}
                    </span>
                </h1>
                <h2>{{$selectedUser['email']}}</h2>
                <h3><span>Joined At :</span> {{$selectedUser['created_at']}}</h3>
                <h4><span>Updated At :</span> {{$selectedUser['updated_at']}}</h4>
            </div>
        </div>
            <div class="w-full  space-y-4 font-medium">
                <form 
                    method="POST" 
                    action="{{route('change.user.role')}}"
                    class="max-w-sm  mx-auto">
                @csrf
                @method('PUT')
                <label for="countries" class="block mb-2.5 text-sm font-medium text-heading">User Role</label>
                <input type="hidden" name="userId" value="{{$selectedUser['id']}}">
                <select name="roleId" onchange="this.form.submit()" id="countries" class="block w-full px-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded focus:ring-brand focus:border-brand shadow-xs placeholder:text-body">
                    <option selected value={{$selectedUser['role_id']}}>{{$selectedUser['role']->name}}</option>
                    @foreach ($roles as $role)
                    @if($role['id'] != $selectedUser['role_id'])
                    <option value={{$role['id']}}>{{$role['name']}}</option>
                    @endif
                    @endforeach
                </select>
                </form>
                <form action="{{route('verify.user')}}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="userId" value="{{$selectedUser['id']}}">
                @if($selectedUser['account_verified'])
                <button class="w-full bg-red-500 text-white py-4 px-4 rounded">Unverify User</button>
                @else
                <button class="w-full bg-emerald-500 text-white py-4 px-4 rounded">Verify User</button>
                @endif
                </form>
            <div class="grid grid-cols-2 gap-4 w-full h-[3.2rem]">
                <form action="{{route('ban.user')}}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="userId" value="{{$selectedUser['id']}}">
                    @if($selectedUser['is_banned'])
                    <button class="rounded bg-emerald-400 text-white h-full w-full">
                        <x-heroicon-o-check-circle class="size-[1.5rem] inline-block mr-2"/>
                        <span>Unban User</span>
                    </button>
                    @else
                    <button class="rounded bg-red-400 text-white h-full w-full">
                        <x-heroicon-o-no-symbol class="size-[1.5rem] inline-block mr-2"/>
                        <span>Ban User</span>
                    </button>
                    @endif
                </form>
                <form action="{{route('delete.user')}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="userId" value="{{$selectedUser['id']}}">
                    <button class="rounded bg-red-400 text-white h-full w-full">
                        <x-heroicon-o-trash class="size-[1.5rem] inline-block mr-2"/>
                        <span>Delete User</span>
                    </button>
                </form>
            </div>
            </div>
        </article>
        @else
            <article class="border border-gray-400 rounded-md row-span-full flexCenter flex-col">
            <x-heroicon-o-exclamation-circle class="size-[5rem] text-gray-400" />
            <p class="text-gray-400 mt-2">Select User</p>
        </article>
        @endif
        <article class="flex flex-col gap-[1rem]">
            <form action="{{route('admin.users')}}" method="GET" class="grid grid-cols-[1fr_6rem] gap-2 ">
                <x-atoms.input name="search" value={{$search}} icon="magnifying-glass" class="min-w-full rounded!" placeholder="search user by name" /> <button class="bg-gray-400 py-2 px-[1rem] rounded">Search</button>
            </form>
            <ul class="grid grid-cols-3  gap-[1rem] h-full items-start">
                @foreach($users as $index=>$user)
                @if(!$search || str_contains(strtolower($user['name']),strtolower($search)))
                <li>
                    <a href={{"/admin-panel/users?userId=".$user['id']}} 
                    @class(["bg-indigo-500! text-white"=>$userId==$user['id'],"bg-red-500! text-white "=>$user['is_banned']," flex text-start w-full cursor-pointer items-center gap-4 bg-white rounded border p-2 border-gray-400"])
                    >
                            <img 
                            src="{{$user['avatar']}}"
                            class="size-[3.8rem] p-1 bg-gray-200 rounded-full" alt="logo"/>
                            <div class="text-sm font-medium space-y-2">
                                <p>{{$user['name']}}</p>
                                <p>{{$user['email']}}</p>
                            </div>
                    </a>
                </li>
                @endif
                @endforeach
            </ul>
<div class="mt-4">
    {{ $users->links() }}
</div>
        </article>
    </section>
</main>
</x-templates.admin-template>