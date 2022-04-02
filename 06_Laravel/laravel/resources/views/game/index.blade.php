<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Game') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <?php if (auth()->user()->role == 'teacher') { ?>



                        <x-auth-validation-errors />
                        <x-success-message />
                        <form method="POST" enctype="multipart/form-data" id="upload-file" action="{{ route('game.store') }}">
                            @csrf

                            <div class="mt-4">
                                <x-label for="goiy" :value="__('Gợi ý')" />

                                <x-input id="goiy" class="block mt-1 w-full" type="text" name="goiy" value="Đây là ..." required />
                            </div>

                            <input type="file" name="file" placeholder="Choose file" id="file">
                            @error('file')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror



                            <x-button class="ml-4">
                                {{ __('Tạo game') }}
                            </x-button>

                        </form>
                        <br>
                    <?php } ?>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                        {{ __('Danh sách game') }}
                    </h2>
                    <br>
                    <table class="min-w-full divide-y divide-gray-200">
                        <colgroup>
                            <col span="1" style="width: 10%;">
                            <col span="1" style="width: 10%;">
                            <col span="1" style="width: 20%;">
                            <col span="1" style="width: 20%;">
                            <col span="1" style="width: 40%;">
                        </colgroup>
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Giáo viên
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Gợi ý
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Ngày tạo
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Trả lời</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($game as $info)
                            <tr>
                                <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-gray-500">
                                    {{ $info->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $author->where('id', $info->authorid)->first()->hoten }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $info->goiy }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $info->created_at }}
                                </td>
                                <td class="px-6 py-4 flex text-sm font-medium flex" style="justify-content: space-around;">
                                    <form method="POST" action="{{ route('game.update',$info->id) }}">
                                    @method('PUT')
                                    @csrf
                                    <x-input id="id" class="" name="id" type="hidden" value="{{ $info->id }}" />
                                    <x-input id="result" class="inline-block" type="text" name="result" placeholder="Đáp án" />
                                    <x-button class="">{{ __('Trả lời') }}</x-button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
