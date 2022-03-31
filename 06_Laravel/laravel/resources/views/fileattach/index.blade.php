<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Assignment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <?php if (auth()->user()->role == 'teacher') { ?>



                        <x-auth-validation-errors />
                        <x-success-message />
                        <form method="POST" enctype="multipart/form-data" id="upload-file" action="{{ route('assignment.store') }}">
                            @csrf

                            <div class="mt-4">
                                <x-label for="name" :value="__('Tên bài tập')" />

                                <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="Bài tập về nhà" required />
                            </div>

                            <div class="mt-4">
                                <x-label for="due" :value="__('Hạn nộp')" />
                                <?php $datetime = new DateTime('tomorrow');
                                $tomorrow = $datetime->format('Y-m-d'); ?>

                                <x-input id="due" type="date" name="due" value="{{ $tomorrow }}" required />
                            </div>

                            <input type="file" name="file" placeholder="Choose file" id="file">
                            @error('file')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror



                            <x-button class="ml-4">
                                {{ __('Thêm bài') }}
                            </x-button>

                        </form>
                        <br>
                    <?php } ?>
                    <br>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                        {{ __('Danh sách bài tập') }}
                    </h2>
                    <br>
                    <table class="min-w-full divide-y divide-gray-200">
                        <colgroup>
                            <col span="1" style="width: 10%;">
                            <col span="1" style="width: 20%;">
                            <col span="1" style="width: 20%;">
                            <col span="1" style="width: 20%;">
                            <col span="1" style="width: 30%;">
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
                                    Tên bài
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Hạn nộp
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Thao tác</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($assignments as $assm)
                            <tr>
                                <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-gray-500">
                                    {{ $assm->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $author->where('id', $assm->authorid)->first()->hoten }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $assm->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $assm->due }}
                                </td>
                                <td class="px-6 py-4 flex text-sm font-medium" style="justify-content: space-around;">
                                    <a href="{{ route('fileattach.show',$fileattach->where('part','assignment')->where('partid',$assm->id)->first()->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                        <x-button class="ml-3">
                                            {{ __('Xem') }}
                                        </x-button>
                                    </a>

                                    <a href="{{route('assignment.show',$assm->id)}}" class="text-indigo-600 hover:text-indigo-900">
                                        <x-button class="ml-3">
                                            {{ __('Nộp bài') }}
                                        </x-button>
                                    </a>
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
