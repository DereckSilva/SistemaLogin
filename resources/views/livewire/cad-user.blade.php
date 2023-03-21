<div  class="font-roboto_slab font-normal">

    <img src="{{ Vite::asset('resources/images/Privacy policy-rafiki.svg') }}"
         alt="login"class="w-40 container mx-auto self-center">
    <form wire:submit.prevent='cadUser'>
        @if (!empty($teste))
            {{dd($teste)}}
        @endif
        <div class="p-8 space-y-2 w-5/12 bg-white container mx-auto rounded-3xl shadow-lg" >

            <div class="flex flex-col gap-2">

                <label for="name-user">Nome</label>
                <input id="name-user" class="focus:outline-none border-slate-900 border-solid border-2 rounded-xl p-2 w-4/3" wire:model="name" type="text">
                @error('name')
                <span class="text-red-300 text-sm"> {{ $message }} </span>
                @enderror

                <label for="email-usuario">Email</label>
                <input id="email-usuario" class="focus:outline-none border-slate-900 border-solid border-2 rounded-xl p-2 w-4/3" wire:model='email' type="email">

                @error('email')
                <span class="text-red-300 text-sm"> {{$message}}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label for="senha-usuario">Senha</label>
                <input id="senha-usuario" class="focus:outline-none border-slate-900 border-solid border-2 rounded-xl p-2 w-4/3" wire:model='password' type="password">

                @error('password')
                <span class="text-red-300 text-sm"> {{$message}}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label for="confirma-senha">Confirma Senha</label>
                <input id="confirma-senha" class="focus:outline-none border-slate-900 border-solid border-2 rounded-xl p-2 w-4/3" wire:model='confirmed' type="password">

                @error('confirmed ')
                <span class="text-red-300 text-sm"> {{$message}}</span>
                @enderror
            </div>

            @if(!empty($message))
                <x-success :messages="$message"/>

            @endif
            @if(!empty($error))
                <x-alert :error="$error"/>
            @endif
            <div class="flex justify-center">
                <button class="text-sm bg-gray-300 w-24 p-1 rounded-3xl my-2 text-gray-900 focus:ring-2 ring-slate-900">Cadastrar</button>
            </div>

            <div>
                <p class="text-gray-500 text-sm text-center">Já possui uma conta <span wire:click="login" class="cursor-pointer underline text-sm">Login</span></p>
            </div>
        </div>
    </form>
</div>
