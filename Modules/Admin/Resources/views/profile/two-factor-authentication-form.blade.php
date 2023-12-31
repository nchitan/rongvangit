<x-jet-action-section>
    <x-slot name="title">
        {{ __('Xác thực 2 yếu tố') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Chúng tôi sẽ yêu cầu mã đăng nhập nếu phát hiện thấy lần đăng nhập từ thiết bị hoặc trình duyệt lạ.') }}
    </x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-medium text-gray-900">
            @if ($this->enabled)
                {{ __('Bạn đã bật xác thực 2 yếu tố.') }}
            @else
                {{ __('Bạn chưa bật xác thực 2 yếu tố.') }}
            @endif
        </h3>

        <div class="mt-3 max-w-xl text-sm text-gray-600">
            <p>
                {{ __('Khi xác thực 2 yếu tố được bật, bạn sẽ được nhắc nhập mã thông báo ngẫu nhiên, an toàn trong quá trình xác thực. Bạn có thể truy xuất mã thông báo này từ ứng dụng Google Authenticator trên điện thoại của mình') }}
            </p>
        </div>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        {{ __('Xác thực 2 yếu tố hiện đã được bật. Quét mã QR sau bằng ứng dụng xác thực trên điện thoại của bạn.') }}
                    </p>
                </div>

                <div class="mt-4">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>
            @endif

            @if ($showingRecoveryCodes)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        {{ __('Lưu trữ các mã khôi phục này trong trình quản lý mật khẩu an toàn. Chúng có thể được sử dụng để khôi phục quyền truy cập vào tài khoản của bạn nếu thiết bị xác thực hai yếu tố của bạn bị mất.') }}
                    </p>
                </div>

                <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="mt-5">
            @if (! $this->enabled)
                <x-jet-confirms-password wire:then="enableTwoFactorAuthentication">
                    <x-jet-button type="button" wire:loading.attr="disabled">
                        {{ __('Enable') }}
                    </x-jet-button>
                </x-jet-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-jet-confirms-password wire:then="regenerateRecoveryCodes">
                        <x-jet-secondary-button class="mr-3">
                            {{ __('Regenerate Recovery Codes') }}
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @else
                    <x-jet-confirms-password wire:then="showRecoveryCodes">
                        <x-jet-secondary-button class="mr-3">
                            {{ __('Show Recovery Codes') }}
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @endif

                <x-jet-confirms-password wire:then="disableTwoFactorAuthentication">
                    <x-jet-danger-button wire:loading.attr="disabled">
                        {{ __('Disable') }}
                    </x-jet-danger-button>
                </x-jet-confirms-password>
            @endif
        </div>
    </x-slot>
</x-jet-action-section>
