<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Methode WP') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg pt-5">
                <div>
                    <div class="text-center">
                        <p class="bg-gray-600 rounded-md text-white p-3">Berikut data Vektor S</p>
                    </div>
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 my-6">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Alternatif
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Vektor S
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alternatif as $a)
                                <tr class="bg-white dark:bg-gray-900 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $loop->iteration }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $a->nama }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $weightedValues[$a->id] }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        <p class="bg-gray-600 rounded-md text-white p-3">Berikut data Vektor V</p>
                    </div>
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Alternatif
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Vektor V
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alternatif as $a)
                                <tr class="bg-white dark:bg-gray-900 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $loop->iteration }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $a->nama }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $finalValues[$a->id] }}
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
