<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        
        <div class="profile-edit-box">
            <h2>ログイン</h2>
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full profile-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
    
            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
    
                <x-text-input id="password" class="block mt-1 w-full profile-input"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
    
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            
            <x-primary-button class="ml-3 save-button">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
    <form method="get" action="register">
        <div class="profile-edit-box">
            <h2>新規登録</h2>
            <form action="/password/change" method="post">
                <button type="submit" class="save-button">新規登録はこちら</button>
            </form>
        </div>
    </form>
</x-guest-layout>
