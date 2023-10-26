<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Nickname') }}" />
                <x-jet-input id="name" placeholder='Nhập số và các chữ cái không dấu' class="block mt-1 w-full" type="text" name="name" :value="old('name')" required pattern="[A-Za-z0-9_-]{1,20}" autofocus autocomplete="name" />
            </div>

            <div>
                <x-jet-label for="fullname" value="{{ __('Tên') }}" />
                <x-jet-input id="fullname"  class="block mt-1 w-full" type="text" name="fullname" :value="old('fullname')" required pattern="[A-Za-z0-9_-]{1,20}" autofocus autocomplete="fullname" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required pattern="{1,30}" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Mật khẩu') }}" />
                <x-jet-input id="password" placeholder='Nhập mật khẩu có ít nhất 8 ký tự' required pattern="[A-Za-z0-9_\W+]{8,20}" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Nhập lại mật khẩu') }}" />
                <x-jet-input id="password_confirmation" placeholder='Nhập mật khẩu có ít nhất 8 ký tự' required pattern="[A-Za-z0-9_\W+]{8,20}" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('Tôi đồng ý với :terms_of_service và :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Điều Kiện').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="/guideline" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Nguyên tắc cộng đồng').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Đã có tài khoản?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Tạo tài khoản') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
