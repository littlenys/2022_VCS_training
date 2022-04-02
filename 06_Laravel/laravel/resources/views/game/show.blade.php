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
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                        {{ __('Kết quả') }}
                    </h2>
                    <br>
                    <?php if ($iscorrect == false) { ?>
                        <h2 class="font-semibold text-xl text-red-600 leading-tight text-center">
                            {{ __('INCORRECT') }}
                        </h2>
                    <?php } ?>
                    <?php if ($iscorrect == true) {
                    ?>
                        <h2 class="font-semibold text-xl text-green-600 leading-tight text-center ">
                            {{ $content }}
                        </h2>



                    <?php } ?>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
