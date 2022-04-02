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
                    <?php
                    if (auth()->user()->role == 'student') { ?>
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                            {{ __('Nộp bài') }}
                        </h2>
                        <br>
                        <x-auth-validation-errors />
                        <x-success-message />
                        <form method="POST" enctype="multipart/form-data" id="upload-file" action="{{ route('submission.store') }}">
                            @csrf
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                                {{ $assignment->name }}
                            </h2>

                            <div class="mt-4">
                                <x-input id="assignmentid" class="block mt-1 w-full" type="hidden" name="assignmentid" value="{{ $assignmentid }}" required />
                            </div>

                            <input type="file" name="file" placeholder="Choose file" id="file">
                            @error('file')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror

                            <x-button class="ml-4">
                                {{ __('Nộp bài') }}
                            </x-button>

                        </form>
                        <br>
                    <?php } ?>
                    <br>
                    <?php
                    if (auth()->user()->role == 'teacher') { ?>


                        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                            {{ __('Danh sách bài tập đã nộp') }}
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
                                        Sinh viên
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tên bài
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Ngày nộp
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="sr-only">Thao tác</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($submission as $sub)
                                <tr>
                                    <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-gray-500">
                                        {{ $sub->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $author->where('id', $sub->authorid)->first()->hoten }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $fileattach->where('part','submission')->where('partid',$sub->id)->first()->tenfile }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $sub->created_at }}
                                    </td>
                                    <td class="px-6 py-4 flex text-sm font-medium" style="justify-content: space-around;">
                                        <a href="{{ route('fileattach.show',$fileattach->where('part','submission')->where('partid',$sub->id)->first()->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                            <x-button class="ml-3">
                                                {{ __('Xem') }}
                                            </x-button>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
