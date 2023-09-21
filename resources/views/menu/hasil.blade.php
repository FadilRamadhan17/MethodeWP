<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Methode WP') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{-- @foreach ($ranking as $rankedItem)
                    <p>Peringkat {{ $rankedItem['rank'] }}: Alternatif {{ $rankedItem['alternatif_id'] }} dengan nilai
                        {{ $rankedItem['final_value'] }}</p>
                @endforeach --}}
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
                            <th scope="col" class="px-6 py-3">
                                Rank
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ranking as $rankedItem)
                            <tr class="bg-white dark:bg-gray-900 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $loop->iteration }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $rankedItem['alternatif_name'] }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $rankedItem['final_value'] }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $rankedItem['rank'] }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
