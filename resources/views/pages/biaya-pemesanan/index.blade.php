<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    @include('components.flash-messages')

    <div class="flex w-full">
        <button class="btn btn-outline btn-sm btn-info m-2" onclick="my_modal_2.showModal()">Tambah Data</button>
    </div>

    {{-- table bahan baku  --}}
    <div class="overflow-x-auto">
        <table class="table table-xs md:table-md">
            <!-- head -->
            <thead class="bg-base-200">
                <tr>
                    <th class="text-center">NO</th>
                    <th class="text-center">Jenis</th>
                    <th class="text-center">Jumlah</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- row 1 -->
                @php
                    $no = 1;
                    $total = 0;
                @endphp
                @foreach ($data as $row)
                    <tr>
                        @php
                            $total += $row->jumlah;
                        @endphp
                        <th class="text-center">{{ $no++ }}</th>
                        <td class="text-center">{{ $row->jenis_biaya }}</td>
                        <td class="text-center">Rp{{ number_format($row->jumlah, 2, ',', '.') }}</td>
                        <td class="text-center">
                            <button onclick="edit_{{ $row->id }}.showModal()"
                                class="btn btn-outline btn-xs btn-info">
                                <span class="material-symbols-outlined">
                                    edit_note
                                </span>
                            </button>
                            <button onclick="delete_{{ $row->id }}.showModal()"
                                class="btn btn-outline btn-xs btn-error">
                                <span class="material-symbols-outlined">
                                    delete
                                </span>
                            </button>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td class="text-center font-bold" rowspan="2">Total</td>
                    <td class="text-center font-bold"></td>
                    <td class="text-center font-bold">Rp {{ number_format($total, 2, ',', '.') }}</td>
                </tr>

            </tbody>
        </table>
    </div>

    {{-- form tambah data  --}}
    <!-- Open the modal using ID.showModal() method -->
    <dialog id="my_modal_2" class="modal">
        <div class="modal-box">
            <form class="card-body" method="POST" action="{{ url('/biaya-pemesanan') }}">
                @csrf
                <h2 class="card-title">Form Data Biaya Pemesanan</h2>

                <div class="my-5 max-w-sm">
                    <label for="input-label-with-helper-text" class="block text-sm font-medium mb-2 ">Jenis</label>
                    <input name="jenis" required type="text" id="input-label-with-helper-text"
                        class="py-3 px-4 block w-32 border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                        placeholder="Minyak" aria-describedby="hs-input-helper-text">
                </div>

                <div class="my-5 max-w-sm">
                    <label for="input-label-with-helper-text" class="block text-sm font-medium mb-2 ">Jumlah</label>
                    <input name="jumlah" required type="number" step=any id="input-label-with-helper-text"
                        class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                        placeholder="00.00" aria-describedby="hs-input-helper-text">
                </div>

                <button type="submit" class="btn btn-outline">Save</button>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    {{-- form Edit data  --}}
    <!-- Open the modal using ID.showModal() method -->
    @foreach ($data as $item)
        <dialog id="edit_{{ $item->id }}" class="modal">
            <div class="modal-box">
                <form class="card-body" method="POST" action="{{ url("/biaya-pemesanan/$item->id") }}">
                    @csrf @method('PATCH')
                    <h2 class="card-title">Form Edit Biaya Pemesanan {{ $item->id }}</h2>

                    <div class="my-5 max-w-sm">
                        <label for="input-label-with-helper-text" class="block text-sm font-medium mb-2 ">Jenis</label>
                        <input name="jenis" required type="text" id="input-label-with-helper-text"
                            class="py-3 px-4 block w-32 border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                            aria-describedby="hs-input-helper-text" value="{{ $item->jenis_biaya }}">
                    </div>

                    <div class="my-5 max-w-sm">
                        <label for="input-label-with-helper-text" class="block text-sm font-medium mb-2 ">Jumlah</label>
                        <input name="jumlah" required type="number" step=any id="input-label-with-helper-text"
                            class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                            aria-describedby="hs-input-helper-text" value="{{ $item->jumlah }}">
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
                <p><span class="font-bold">Tanggal : </span>{{ $item->jenis_biaya }}</p>
                <p><span class="font-bold">Pembelian : </span>{{ $item->julah }}</p>
                <form action="{{ url("/biaya-pemesanan/$item->id") }}" method="POST">
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
