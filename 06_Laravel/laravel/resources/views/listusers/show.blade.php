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
                    <x-auth-validation-errors />
                    <x-success-message />

                    <form>
                        @method('PUT')
                        @csrf
                        <div class="grid grid-cols-2 gap-6 w-96">

                            <div class="grid grid-rows-2 gap-6">
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
                    <x-label for="noidung" :value="__('Tin nhắn')" />
                    <table class="min-w-full divide-y divide-gray-200">

                        <thead class="bg-gray-50">
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($messages as $mess)
                            <tr>
                                <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-gray-500">
                                    {{ $mess->updated_at }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 w-6/12 break-words">
                                    {{ $mess->noidung }}
                                </td>
                                <td class="flex items-center justify-center">
                                    <form method="POST" action="{{route('messages.destroy',$mess->id)}}" class="flex items-center">
                                        @method('DELETE')
                                        @csrf
                                        <x-button class="ml-3 btn btn-sm btn-danger btndelete">
                                            {{ __('Xóa') }}
                                        </x-button>
                                    </form>
                                    <form method="POST" action="{{route('messages.update',$mess->id)}}" class="flex items-center">
                                        @method('PUT')
                                        @csrf
                                        <x-button class="ml-3  btn btn-sm btn-danger btndelete">
                                            {{ __('Sửa') }}
                                        </x-button>
                                        <x-input id="noidung" class="inline-block ml-2" type="text" name="noidung" value="{{ $mess->noidung }}" />
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <form method="POST" action="{{ route('messages.store') }}">
                        @csrf
                        <div class="grid grid-rows-2 gap-6 w-48">
                            <div>
                                <x-input id="idrev" class="block mt-1 w-full" name="idrev" type="hidden" value="{{ $user->id }}" />
                                <x-input id="noidung" class="block mt-1 w-full" type="text" name="noidung" placeholder="Xin chào, mình là ..." />
                            </div>
                        </div>
                        <div class="flex items-center mt-4">
                            <x-button class="ml-4">
                                {{ __('Gửi tin nhắn') }}
                            </x-button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>

</x-app-layout>
