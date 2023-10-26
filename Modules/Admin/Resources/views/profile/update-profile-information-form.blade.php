<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Thông tin cá nhân') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Chỉnh sửa thông tin cá nhân của bạn') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        {{-- @if (Laravel\Jetstream\Jetstream::managesProfilePhotos()) --}}
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            wire:model="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-jet-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-jet-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-jet-secondary-button>
                @endif

                <x-jet-input-error for="photo" class="mt-2" />
            </div>
        {{-- @endif --}}

        <!-- Name -->
<!--         <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('Nickname') }}" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" />
            <x-jet-input-error for="name" class="mt-2" />
        </div> -->

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="fullname" value="{{ __('Họ tên') }}" />
            <x-jet-input id="fullname" type="text" class="mt-1 block w-full" wire:model.defer="state.fullname" autocomplete="fullname" />
            <x-jet-input-error for="fullname" class="mt-2" />
        </div>

        <!-- About -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="about" value="{{ __('Giới thiệu bản thân') }}" />
            <x-jet-input id="about" type="text" class="mt-1 block w-full" wire:model.defer="state.about" autocomplete="about" />
            <x-jet-input-error for="about" class="mt-2" />
        </div>

        <!-- Facebook -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="facebook" value="{{ __('Facebook') }}" />
            <x-jet-input id="facebook" type="text" class="mt-1 block w-full" wire:model.defer="state.facebook" autocomplete="facebook" />
            <x-jet-input-error for="facebook" class="mt-2" />
        </div>

        <!-- Zalo -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="zalo" value="{{ __('Zalo') }}" />
            <x-jet-input id="zalo" type="text" class="mt-1 block w-full" wire:model.defer="state.zalo" autocomplete="zalo" />
            <x-jet-input-error for="zalo" class="mt-2" />
        </div>

        <!-- Youtube -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="youtube" value="{{ __('Youtube') }}" />
            <x-jet-input id="youtube" type="text" class="mt-1 block w-full" wire:model.defer="state.youtube" autocomplete="youtube" />
            <x-jet-input-error for="youtube" class="mt-2" />
        </div>
        <!-- Github -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="github" value="{{ __('Github') }}" />
            <x-jet-input id="github" type="text" class="mt-1 block w-full" wire:model.defer="state.github" autocomplete="github" />
            <x-jet-input-error for="github" class="mt-2" />
        </div>

        <!-- Website -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="website" value="{{ __('Website') }}" />
            <x-jet-input id="website" type="text" class="mt-1 block w-full" wire:model.defer="state.website" autocomplete="website" />
            <x-jet-input-error for="website" class="mt-2" />
        </div>

        <!-- Adress -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="adress" value="{{ __('Nơi sống') }}" />
            <x-jet-input id="adress" type="text" class="mt-1 block w-full" wire:model.defer="state.adress" autocomplete="adress" />
            <x-jet-input-error for="adress" class="mt-2" />
        </div>

        <!-- University -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="university" value="{{ __('Trường học') }}" />
            <x-jet-input id="university" type="text" class="mt-1 block w-full" wire:model.defer="state.university" autocomplete="university" />
            <x-jet-input-error for="university" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
            <x-jet-input-error for="email" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
