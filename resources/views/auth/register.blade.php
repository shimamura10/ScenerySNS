<x-guest-layout>
    <div class="profile-edit-box">
        <h2>プロフィール登録</h2>
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            
            <!-- Icon -->
            <div class="profile-image">
                <img id="selected-image" src="storage/icons/no_icon.png" style="width: 100%; height: 100%; border-radius: 50%;">
                <input type="file" name="icon" id="image-input" accept="image/*" style="display: none;">
                <button class="upload-button" id = "upload-button">+</button>
            </div>
    
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full profile-input" type="text" name="name" :value="old('name')" placeholder="ユーザー名" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
    
            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full profile-input" type="email" name="email" :value="old('email')" placeholder="メールアドレス" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            
            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
    
                <x-text-input id="password" class="block mt-1 w-full profile-input"
                                type="password"
                                name="password"
                                placeholder="パスワード"
                                required autocomplete="new-password" />
    
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
    
            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
    
                <x-text-input id="password_confirmation" class="block mt-1 w-full profile-input"
                                type="password"
                                name="password_confirmation"
                                placeholder="パスワードの確認" required autocomplete="new-password" />
    
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        
    
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
    
                <x-primary-button class="ml-4 save-button">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
    <script>
        const imageInput = document.getElementById("image-input");
        const selectedImage = document.getElementById("selected-image");
        const uploadButton = document.getElementById("upload-button");

        uploadButton.addEventListener("click", function () {
            imageInput.click();
        });

        imageInput.addEventListener("change", function (event) {
            const selectedFile = event.target.files[0];
            if (selectedFile) {
                const imageUrl = URL.createObjectURL(selectedFile);
                selectedImage.src = imageUrl;
            }
        });
    </script>
</x-guest-layout>
