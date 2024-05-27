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
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Pembelian</th>
                    <th class="text-center">Pemakaian</th>
                    <th class="text-center">Stok <br> Akhir <br> Persediaan</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- row 1 -->
                @php
                    $no = 1;
                @endphp
                @foreach ($data as $row)
                    <tr>
                        <th class="text-center">{{ $no++ }}</th>
                        <td class="text-center">
                                {{ $row->bulan }}
                        </td>
                        <td class="text-center">{{ $row->pembelian }}</td>
                        <td class="text-center">{{ $row->pemakaian }}</td>
                        <td class="text-center">{{ $row->sisa }}</td>
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


            </tbody>
        </table>
    </div>

    {{-- form tambah data  --}}
    <!-- Open the modal using ID.showModal() method -->
    <dialog id="my_modal_2" class="modal">
        <div class="modal-box">
            <form class="card-body" method="POST" action="{{ url('/bahan-baku') }}">
                @csrf
                <h2 class="card-title mb-5">Form Data Bahan Baku</h2>

                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="bulan" class="block mb-2 text-sm font-medium text-gray-900">Bulan</label>
                        <select id="bulan" name="bulan"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option selected>Pilih Bulan</option>
                            <option value="Januari">Januari</option>
                            <option value="Februari">Februari</option>
                            <option value="Maret">Maret</option>
                            <option value="April">April</option>
                            <option value="Mei">Mei</option>
                            <option value="Juni">Juni</option>
                            <option value="Juli">Juli</option>
                            <option value="Agustus">Agustus</option>
                            <option value="September">September</option>
                            <option value="Oktober">Oktober</option>
                            <option value="November">November</option>
                            <option value="Desember">Desember</option>
                        </select>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="tahun" class="block mb-2 text-sm font-medium text-gray-900">Tahun</label>
                        <input  name="tahun" required type="text" id="tahun"
                            aria-describedby="helper-text-explanation"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="2022" required />
                    </div>
                </div>

                <div class="grid md:grid-cols-2 md:gap-6">

                    <div class="relative z-0 w-full mb-5 group">
                        <label for="pembelian" class="block mb-2 text-sm font-medium text-gray-900">Pembelian</label>
                        <input  step=any name="pembelian" required type="number" id="pembelian"
                            aria-describedby="helper-text-explanation"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="90210" required />
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="pemakaian" class="block mb-2 text-sm font-medium text-gray-900">Pemakaian</label>
                        <input step=any name="pemakaian" required type="number" id="pemakaian"
                            aria-describedby="helper-text-explanation"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="90210" required />
                    </div>
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
                <form class="card-body" method="POST" action="{{ url("/bahan-baku/$item->id") }}">
                    @csrf @method('PATCH')
                    <h2 class="card-title">Form Data Bahan Baku {{ $item->id }}</h2>

                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div class="relative z-0 w-full mb-5 group">
                            <label for="bulan" class="block mb-2 text-sm font-medium text-gray-900">Bulan</label>
                            <select id="bulan" name="bulan"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option selected value="{{$item->bulan}}">{{$item->bulan}}</option>
                                <option value="Januari">Januari</option>
                                <option value="Februari">Februari</option>
                                <option value="Maret">Maret</option>
                                <option value="April">April</option>
                                <option value="Mei">Mei</option>
                                <option value="Juni">Juni</option>
                                <option value="Juli">Juli</option>
                                <option value="Agustus">Agustus</option>
                                <option value="September">September</option>
                                <option value="Oktober">Oktober</option>
                                <option value="November">November</option>
                                <option value="Desember">Desember</option>
                            </select>
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <label for="tahun" class="block mb-2 text-sm font-medium text-gray-900">Tahun</label>
                            <input  name="tahun" required type="text" id="tahun" value="{{$item->tahun}}"
                                aria-describedby="helper-text-explanation"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="2022" required />
                        </div>
                    </div>
    
                    <div class="grid md:grid-cols-2 md:gap-6">
    
                        <div class="relative z-0 w-full mb-5 group">
                            <label for="pembelian" class="block mb-2 text-sm font-medium text-gray-900">Pembelian</label>
                            <input  step=any name="pembelian" required type="number" id="pembelian" value="{{$item->pembelian}}"
                                aria-describedby="helper-text-explanation"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="90210" required />
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <label for="pemakaian" class="block mb-2 text-sm font-medium text-gray-900">Pemakaian</label>
                            <input step=any name="pemakaian" required type="number" id="pemakaian" value="{{$item->pemakaian}}"
                                aria-describedby="helper-text-explanation"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="90210" required />
                        </div>
                    </div>

                    <div class="my-5 max-w-sm">
                        <label for="input-label-with-helper-text" class="block text-sm font-medium mb-2 ">Stok
                            Akhir</label>
                        <input type="number" name="sisa" required step=any id="input-label-with-helper-text"
                            class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                            placeholder="00.00" aria-describedby="hs-input-helper-text" value="{{ $item->sisa }}"
                            disabled>
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
                <p><span class="font-bold">Tanggal : </span>{{ $item->bulan }}</p>
                <p><span class="font-bold">Pembelian : </span>{{ $item->pembelian }}</p>
                <p><span class="font-bold">Pemakaian : </span>{{ $item->pemakaian }}</p>
                <p><span class="font-bold">Stok Akhir : </span>{{ $item->sisa }}</p>
                <form action="{{ url("/bahan-baku/$item->id") }}" method="POST">
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
