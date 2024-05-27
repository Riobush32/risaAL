<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    @include('components.flash-messages')
    <div class="alert alert-lg bg-black my-2 text-white">
        <span class="material-symbols-outlined">
            library_books
        </span>
        <div>
            <h3 class="font-bold"> Analisis Data dengan Metode Fixed Order Interval (FOI)
            </h3>
            <div class="text-xs"></div>
        </div>
        <span class="material-symbols-outlined">
            checklist_rtl
        </span>
    </div>

    <div class="hero bg-base-200">
        <div class="hero-content flex-col lg:flex-row">
            <div class="card  bg-base-100 shadow-xl p-5">

                <form class="max-w-md mx-auto" method="POST" action="{{ url('/hasil-input') }}">
                    @csrf
                    <div class="grid md:grid-cols-2 md:gap-6">

                        <div class="relative z-0 w-full mb-5 group">
                            <label for="oi" class="block mb-2 text-sm font-medium text-gray-900">OI:</label>
                            <input name="oi" required type="number" id="oi"
                                aria-describedby="helper-text-explanation"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="90210" required />
                        </div>

                        <div class="relative z-0 w-full mb-5 group">
                            <label for="lt" class="block mb-2 text-sm font-medium text-gray-900">LT</label>
                            <input name="lt" required type="number" id="lt"
                                aria-describedby="helper-text-explanation"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="90210" required />
                        </div>
                    </div>
                    <div class="grid md:grid-cols-2 md:gap-6">

                        <div class="relative z-0 w-full mb-5 group">
                            <label for="stok" class="block mb-2 text-sm font-medium text-gray-900">Stok
                                Minimum:</label>
                            <input name="stok" required type="number" id="oi"
                                aria-describedby="helper-text-explanation"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="90210" required />
                        </div>
                        <div class="relative z-0 w-full mb-5 group">

                            <label for="tahun" class="block mb-2 text-sm font-medium text-gray-900">Tahun</label>
                            <select id="tahun" name="tahun" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option selected>Pilih Tahun</option>
                                @foreach ($dataTahun as $row)
                                    <option value="{{ $row }}">{{ $row }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Proses</button>
                </form>

            </div>
            <div>
                <div class="overflow-x-auto w-full">
                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th></th>
                                <th>Tahun</th>
                                <th>OI</th>
                                <th>LT</th>
                                <th>Stok</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($data as $item)
                                <tr class="hover:bg-base-200">
                                    <th>{{ $no++ }}</th>
                                    <td>{{ $item->tahun }}</td>
                                    <td>{{ $item->oi }}</td>
                                    <td>{{ $item->lt }}</td>
                                    <td>{{ $item->stok }}</td>
                                    <td class="text-center">
                                        <button onclick="edit_{{ $item->id }}.showModal()"
                                            class="btn btn-outline btn-xs btn-info">
                                            <span class="material-symbols-outlined">
                                                edit_note
                                            </span>
                                        </button>
                                        <a href="{{url("/proses/$item->id")}}'}}"
                                            class="btn btn-outline btn-xs btn-teal-500">
                                            <span class="material-symbols-outlined">
                                                receipt_long
                                            </span>
                                        </a>
                                        <button onclick="delete_{{ $item->id }}.showModal()"
                                            class="btn btn-outline btn-xs btn-error">
                                            <span class="material-symbols-outlined">
                                                delete
                                            </span>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach ($data as $item)
        <dialog id="edit_{{ $item->id }}" class="modal">
            <div class="modal-box">
                <form class="card-body" method="POST" action="{{ url("/hasil-input/$item->id") }}">
                    @csrf @method('PATCH')
                    <h2 class="card-title">Form Edit Proses {{ $item->id }}</h2>

                    <div class="grid md:grid-cols-2 md:gap-6">

                        <div class="relative z-0 w-full mb-5 group">
                            <label for="oi" class="block mb-2 text-sm font-medium text-gray-900">OI:</label>
                            <input name="oi" required type="number" id="oi"
                                value="{{ $item->oi }}
                                aria-describedby="helper-text-explanation"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="90210" required />
                        </div>

                        <div class="relative z-0 w-full mb-5 group">
                            <label for="lt" class="block mb-2 text-sm font-medium text-gray-900">LT</label>
                            <input name="lt" required type="number" id="lt" value="{{ $item->lt }}"
                                aria-describedby="helper-text-explanation"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="90210" required />
                        </div>
                    </div>
                    <div class="grid md:grid-cols-2 md:gap-6">

                        <div class="relative z-0 w-full mb-5 group">
                            <label for="stok" class="block mb-2 text-sm font-medium text-gray-900">Stok
                                Minimum:</label>
                            <input name="stok" required type="number" id="oi" value="{{ $item->stok }}"
                                aria-describedby="helper-text-explanation"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="90210" required />
                        </div>
                        <div class="relative z-0 w-full mb-5 group">

                            <label for="tahun" class="block mb-2 text-sm font-medium text-gray-900">Tahun</label>
                            <select id="tahun" name="tahun" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option selected value="{{ $item->tahun }}">{{ $item->tahun }}</option>
                                @foreach ($dataTahun as $row)
                                    <option value="{{ $row }}">{{ $row }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-outline">Save</button>
                </form>
            </div>
            <form method="dialog" class="modal-backdrop">
                <button>close</button>
            </form>
        </dialog>
    @endforeach

    {{-- Delete allert --}}
    @foreach ($data as $item)
        <dialog id="delete_{{ $item->id }}" class="modal">
            <div class="modal-box">
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>
                <h3 class="font-bold text-lg">Warning!!</h3>
                <p>Are you sure to delete this?</p>
                <p><span class="font-bold">Tahun : </span>{{ $item->tahun }}</p>
                <p><span class="font-bold">OI : </span>{{ $item->oi }}</p>
                <p><span class="font-bold">LT : </span>{{ $item->lt }}</p>
                <p><span class="font-bold">Stok : </span>{{ $item->stok }}</p>
                <form action="{{ url("/hasil-input/$item->id") }}" method="POST">
                    @csrf @method('delete')

                    <div class="modal-action">
                        <button class="btn btn-error btn-outline" type="submit">
                            <span class="material-symbols-outlined">
                                delete
                            </span>
                            delete
                        </button>
                    </div>

                </form>
            </div>
        </dialog>
    @endforeach
</x-layout>
