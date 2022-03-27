<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-auth-validation-errors/>
                    <x-success-message/>

                    <form method="POST" action="{{route('listusers.update',$user->id)}}">
                        @method('PUT')
                        @csrf
                        <div class="grid grid-cols-2 gap-6 w-96">

                            <div class="grid grid-rows-2 gap-6">
                                <div>
                                    <x-label for="username" :value="__('Tên đăng nhập')" />
                                    <x-input id="username" class="block mt-1 w-full bg-red-200" type="text" name="username" value="{{ $user->username }}" readonly />
                                </div>
                                <div>
                                    <x-label for="hoten" :value="__('Họ tên')" />
                                    <x-input id="hoten" class="block mt-1 w-full bg-red-200" type="text" name="hoten" value="{{ $user->hoten }}" readonly />
                                </div>
                            </div>

                            <div class="grid grid-rows-2 gap-6 ">
                                <div>
                                    <x-label for="email" :value="__('Email')" />
                                    <x-input readonly id="email" class="block mt-1 w-full" type="email" name="email" value="{{ $user->email }}" autofocus />
                                </div>
                                <div>
                                    <x-label for="phonenumber" :value="__('Số điện thoại')" />
                                    <x-input readonly id="phonenumber" class="block mt-1 w-full" type="text" name="phonenumber" value="{{ $user->phonenumber }}" autofocus />
                                </div>
                            </div>

                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>

</x-app-layout>
