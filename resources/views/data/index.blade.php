<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Methode WP') }}
        </h2>
    </x-slot>

    <div class="pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <ul class="mb-5 flex list-none flex-row flex-wrap border-b-0 pl-0" role="tablist" data-te-nav-ref>
                <li role="presentation" class="flex-auto text-center">
                    <a href="#tabs-kriteria"
                        class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400"
                        data-te-toggle="pill" data-te-target="#tabs-kriteria" data-te-nav-active role="tab"
                        aria-controls="tabs-kriteria" aria-selected="true">Kriteria</a>
                </li>
                <li role="presentation" class="flex-auto text-center">
                    <a href="#tabs-Alternatif"
                        class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400"
                        data-te-toggle="pill" data-te-target="#tabs-Alternatif" role="tab"
                        aria-controls="tabs-Alternatif" aria-selected="false">Alternatif</a>
                </li>
                <li role="presentation" class="flex-auto text-center">
                    <a href="#tabs-Data"
                        class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400"
                        data-te-toggle="pill" data-te-target="#tabs-Data" role="tab" aria-controls="tabs-Data"
                        aria-selected="false">Data</a>
                </li>
            </ul>

            <!--Tabs content-->
            <div class="mb-6">
                <div class="hidden opacity-100 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
                    id="tabs-kriteria" role="tabpanel" aria-labelledby="tabs-home-tab01" data-te-tab-active>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-12">
                        <div>
                            @if (Session::has('success'))
                                <div id="success-alert"
                                    class="alert alert-success mt-3 p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                                    role="alert">
                                    {{ Session::get('success') }}
                                </div>
                                <script>
                                    setTimeout(function() {
                                        var successAlert = document.getElementById('success-alert');
                                        successAlert.style.display = 'none';
                                    }, 5000);
                                </script>
                            @endif
                            <a href="{{ route('kriteria.create') }}"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mb-4 tambah-kriteria-button">Tambah
                                Kriteria</a>

                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg pt-5">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                No
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Kriteria
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Bobot
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Attribut
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kriteria as $kriteria)
                                            <tr class="bg-white dark:bg-gray-900 dark:border-gray-700">
                                                <th scope="row"
                                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{ $loop->iteration }}
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{ $kriteria->kriteria }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{ number_format($kriteria->bobot / $totalBobot, 2) }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{ $kriteria->attribut }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    <form
                                                        onsubmit="return confirm('Apakah Anda Yakin Untuk Menghapus Data?');"
                                                        action="{{ route('kriteria.destroy', ['id' => $kriteria->id]) }}"
                                                        method="POST">
                                                        <a href="{{ route('kriteria.edit', ['id' => $kriteria->id]) }}"
                                                            class="font-medium bg-blue-600 text-white hover:bg-blue-800 py-2 px-4 rounded-md mr-4">Edit</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="font-medium bg-red-600 text-white hover:bg-red-800 py-2 px-4 rounded-md">Hapus</button>
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
                <div class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
                    id="tabs-Alternatif" role="tabpanel" aria-labelledby="tabs-profile-tab01">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-12">
                        <div>
                            @if (Session::has('success'))
                                <div id="success-alert"
                                    class="alert alert-success mt-3 p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                                    role="alert">
                                    {{ Session::get('success') }}
                                </div>
                                <script>
                                    setTimeout(function() {
                                        var successAlert = document.getElementById('success-alert');
                                        successAlert.style.display = 'none';
                                    }, 5000);
                                </script>
                            @endif
                            <a href="{{ route('alternatif.create') }}"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mb-4 tambah-kriteria-button">Tambah
                                Alternatif</a>

                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg pt-5">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                No
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Nama
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Keterangan
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($alternatif as $alter)
                                            <tr class="bg-white dark:bg-gray-900 dark:border-gray-700">
                                                <th scope="row"
                                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{ $loop->iteration }}
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{ $alter->nama }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{ $alter->keterangan }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    <form
                                                        onsubmit="return confirm('Apakah Anda Yakin Untuk Menghapus Data?');"
                                                        action="{{ route('alternatif.destroy', ['id' => $alter->id]) }}"
                                                        method="POST">
                                                        <a href="{{ route('alternatif.edit', ['id' => $alter->id]) }}"
                                                            class="font-medium bg-blue-600 text-white hover:bg-blue-800 py-2 px-4 rounded-md mr-4">Edit</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="font-medium bg-red-600 text-white hover:bg-red-800 py-2 px-4 rounded-md">Hapus</button>
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
                <div class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
                    id="tabs-Data" role="tabpanel" aria-labelledby="tabs-profile-tab01">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-12">
                        <div>
                            @if (Session::has('success'))
                                <div id="success-alert"
                                    class="alert alert-success mt-3 p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                                    role="alert">
                                    {{ Session::get('success') }}
                                </div>
                                <script>
                                    setTimeout(function() {
                                        var successAlert = document.getElementById('success-alert');
                                        successAlert.style.display = 'none';
                                    }, 5000);
                                </script>
                            @endif
                            <a href="{{ route('data.create') }}"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mb-4 tambah-kriteria-button">Update
                                Data</a>

                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg pt-5">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                No
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Alternatif
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Kriteria
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Value
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $data)
                                            <tr class="bg-white dark:bg-gray-900 dark:border-gray-700">
                                                <th scope="row"
                                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{ $loop->iteration }}
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{ $data->alternatif->nama }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{ $data->kriteria->kriteria }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{ $data->value }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    <form
                                                        onsubmit="return confirm('Apakah Anda Yakin Untuk Menghapus Data?');"
                                                        action="{{ route('data.destroy', ['id' => $data->id]) }}"
                                                        method="POST">
                                                        <a href="{{ route('data.edit', ['id' => $data->id]) }}"
                                                            class="font-medium bg-blue-600 text-white hover:bg-blue-800 py-2 px-4 rounded-md mr-4">Edit</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="font-medium bg-red-600 text-white hover:bg-red-800 py-2 px-4 rounded-md">Hapus</button>
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
            </div>
            <script>
                import {
                    Tab,
                    initTE,
                } from "tw-elements";

                initTE({
                    Tab
                });
            </script>
            <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
        </div>
    </div>
</x-app-layout>
