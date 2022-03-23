<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-auth-validation-errors/>
                    <x-success-message/>

                    <form method="POST" action="{{ route('profile.update') }}">
                        @method('PUT')
                        @csrf
                        <div class="grid grid-cols-2 gap-6 w-96">

                        <!--
                            <div class="grid grid-rows-2 gap-6">
                                <div>
                                    <x-label for="avatar" :value="__('Avatar')" />
                                    <x-input id="avatar" class="block mt-1 w-full" type="text" name="avatar" value="{{ auth()->user()->avatar }}" autofocus />
                                </div>
                            </div>
-->

                            <div class="grid grid-rows-2 gap-6">
                                <div>
                                    <x-label for="username" :value="__('Tên đăng nhập')" />
                                    <x-input id="username" class="block mt-1 w-full bg-red-200" type="text" name="username" value="{{ auth()->user()->username }}" readonly />
                                </div>
                                <div>
                                    <x-label for="hoten" :value="__('Họ tên')" />
                                    <x-input id="hoten" class="block mt-1 w-full bg-red-200" type="text" name="hoten" value="{{ auth()->user()->hoten }}" readonly />
                                </div>
                            </div>

                            <div class="grid grid-rows-2 gap-6 ">
                                <div>
                                    <x-label for="email" :value="__('Email')" />
                                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ auth()->user()->email }}" autofocus />
                                </div>
                                <div>
                                    <x-label for="phonenumber" :value="__('Số điện thoại')" />
                                    <x-input id="phonenumber" class="block mt-1 w-full" type="text" name="phonenumber" value="{{ auth()->user()->phonenumber }}" autofocus />
                                </div>
                            </div>
                            <div class="grid grid-rows-2 gap-6">
                                <div>
                                    <x-label for="new_password" :value="__('New password')" />
                                    <x-input id="new_password" class="block mt-1 w-full"
                                             type="password"
                                             name="password"
                                             autocomplete="new-password" />
                                </div>
                                <div>
                                    <x-label for="confirm_password" :value="__('Confirm password')" />
                                    <x-input id="confirm_password" class="block mt-1 w-full"
                                             type="password"
                                             name="password_confirmation"
                                             autocomplete="confirm-password" />
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-3">
                                {{ __('Update') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
