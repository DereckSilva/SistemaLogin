<div class="font-normal font-roboto_slab">

    <img src="{{ Vite::asset('resources/images/Privacy policy-rafiki.svg') }}"
         alt="login"class="w-40 container mx-auto self-center">

    <form wire:submit.prevent='validateForm'>
        <div class="p-8 grid gap-2 w-5/12 bg-white rounded-3xl container mx-auto shadow-lg" >

            <label for="email-usuario" class="text-gray-900 tracking-widest" >Email</label>
            <input type="email" name='email' wire:model='email' class="rounded-xl p-2 border-slate-900 border-solid border-2 w-4/3">

            @error('email')
            <span class="text-red-300">{{$message}}</span>
            @enderror

            <label for="senha-usuario" class="text-gray-900 tracking-widest">Senha</label>
            <input type="password" name='password' wire:model='password' class="rounded-xl p-2 border-slate-900 border-solid border-2 w-4/3">

            @error('password')
            <span class="text-red-300">{{$message}}</span>
            @enderror

            @if(!empty($error))
                <x-alert :error="$error"/>
            @endif
            <div class="flex justify-between items-center">


                <div>
                    <a href="" class="text-xs text-gray-400 underline">Esqueceu sua senha?</a>
                </div>
                <div class="flex gap-2">

                    <a class="place-self-center underline text-sm cursor-pointer" wire:click='cadUser'>Registre-se</a>
                    <button class="text-sm bg-gray-300 w-24 p-1 rounded-3xl my-2 text-gray-900 focus:ring-2 ring-slate-900">Entrar</button>
                </div>
            </div>
        </div>
    </form>
</div>
