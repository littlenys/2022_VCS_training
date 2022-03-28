<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
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
                                                    Họ tên
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Email
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Số điện thoại
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    <span class="sr-only">Thao tác</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($tasks as $task)
                                            <tr>
                                                <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-gray-500">
                                                    {{ $task->id }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $task->hoten }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $task->email }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $task->phonenumber }}
                                                </td>
                                                <td class="px-6 py-4 flex text-sm font-medium" style="justify-content: space-around;">
                                                    <a href="{{route('listusers.show',$task->id)}}" class="text-indigo-600 hover:text-indigo-900">
                                                        <x-button class="ml-3">
                                                            {{ __('Xem') }}
                                                        </x-button>
                                                    </a>
                                                    <a href="{{route('listusers.edit',$task->id)}}" class="text-indigo-600 hover:text-indigo-900">
                                                        <x-button class="ml-3">
                                                            {{ __('Sửa') }}
                                                        </x-button>
                                                    </a>
                                                    <form method="POST" action="{{route('listusers.destroy',$task->id)}}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <x-button class="ml-3  btn btn-sm btn-danger btndelete">
                                                            {{ __('Xóa') }}
                                                        </x-button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                                <div class="mt-4">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@section('js')
<script>
    $('.btndelete').click(function(ev) {
        ev.preventDefault();
        var _href = $(this).attr('href');
        $('form#form-delete').attr('action', _href);
        if (confirm('Bạn muốn xóa bản ghi này không?')) {
            $('form#form-delete').submit()
        }
    });
</script>
@endsection
