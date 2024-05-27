<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

    @include('components.flash-messages')

    <div class="card-bg-base-100 flex items-center justify-center">

        <div class="m-2 p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="stats" role="tabpanel"
            aria-labelledby="stats-tab">
            <ul class="hidden text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg sm:flex dark:divide-gray-600 dark:text-gray-400 rtl:divide-x-reverse"
                id="fullWidthTab" data-tabs-toggle="#fullWidthTabContent" role="tablist">
                <li class="w-full">
                    <button id="stats-tab" data-tabs-target="#stats" type="button" role="tab" aria-controls="stats"
                        aria-selected="true"
                        class="inline-block w-full p-4 rounded-ss-lg bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600">Data
                        Tahun {{ $tahun }}</button>
                </li>
            </ul>
            <dl
                class="grid max-w-screen-xl grid-cols-2 gap-8 p-4 mx-auto text-gray-900 sm:grid-cols-3 xl:grid-cols-6 dark:text-white sm:p-8">
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-xl font-extrabold">{{ $sigma_d }} ton</dt>
                    <dd class="text-gray-500 dark:text-gray-400">Nilai 𝝈𝒅</dd>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-xl font-extrabold">{{ $foi }}</dt>
                    <dd class="text-gray-500 dark:text-gray-400">Nilai FOI</dd>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-xl font-extrabold">Rp {{ number_format($c, 0, ',', '.') }}</dt>
                    <dd class="text-gray-500 dark:text-gray-400 text-xs">Besar Biaya Penyimpanan Perunit</dd>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-xl font-extrabold">{{ number_format($qOptimal, 3) }} ton </dt>
                    <dd class="text-gray-500 dark:text-gray-400">Q Optimal </dd>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-xl font-extrabold">{{ number_format($d, 3) }} ton </dt>
                    <dd class="text-gray-500 dark:text-gray-400">Permintaan Harian</dd>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-xl font-extrabold">{{ number_format($ss, 3) }} ton </dt>
                    <dd class="text-gray-500 dark:text-gray-400"> Safety Stock</dd>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-xl font-extrabold">{{ number_format($orderPoint, 3) }} ton</dt>
                    <dd class="text-gray-500 dark:text-gray-400">order point</dd>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-xl font-extrabold">{{ number_format($d, 3) }} ton</dt>
                    <dd class="text-gray-500 dark:text-gray-400">Permintaan Harian</dd>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-xl font-extrabold">{{ number_format($S, 3) }} ton</dt>
                    <dd class="text-gray-500 dark:text-gray-400">Persedian Harian</dd>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-xl font-extrabold">{{ number_format($poq, 3) }} ton</dt>
                    <dd class="text-gray-500 dark:text-gray-400">Nilai POQ</dd>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-xl font-extrabold">{{ number_format($N, 0) }} Kali</dt>
                    <dd class="text-gray-500 dark:text-gray-400 text-xs">Frekuensi Pemesanan Dalam Setahun</dd>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-xl font-extrabold">Rp {{ number_format($cq, 0) }}</dt>
                    <dd class="text-gray-500 dark:text-gray-400">Biaya Penyediaan</dd>
                </div>
            </dl>
            <div class=" p-4 bg-white rounded-lg dark:bg-gray-800" id="faq" role="tabpanel"
                aria-labelledby="faq-tab">

                <div
                    class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Kesimpulan</h2>

                    <dl class=" text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                        <div class="flex flex-col pb-3">
                            <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">
                                Berdasarkan hasil pengendalian persediaan dengan metode Fixed Order Interval
                                (FOI) diperoleh bahwa jika stok kayu di gudang telah mencapai
                                <span
                                    class="font-semibold text-gray-900 dark:text-white">{{ number_format($orderPoint, 3) }}
                                    ton</span>
                                , maka
                                dapat dilakukan pemesanan kembali bahan baku kayu sebanyak
                                <span
                                    class="font-semibold text-gray-900 dark:text-white">{{ number_format($qOptimal, 3) }}
                                    ton</span>.
                            </dt>
                        </div>
                        <div class="flex flex-col py-3">
                            <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">
                                Berdasarkan hasil pengendalian persediaan dengan metode Periodic Order
                                Quantity (POQ) menghasilkan ukuran pemesanan yang minimum dalam
                                pengendalian persediaan bahan baku sebesar
                                <span class="font-semibold text-gray-900 dark:text-white">
                                    {{ number_format($poq, 3) }} ton.
                                </span>.
                                Frekuensi pemesanan dalam setahunyang lebih efesien adalah
                                <span class="font-semibold text-gray-900 dark:text-white">
                                    {{ number_format($N, 0) }}
                                </span>
                                kali dalam setahun dengan biaya total persediaan
                                <span class="font-semibold text-gray-900 dark:text-white">
                                    Rp {{ number_format($cq, 2, ',', '.') }}.
                                </span>
                            </dt>
                        </div>
                        <div class="flex flex-col py-3">
                            <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">
                                Berdasarkan hasil dari jumlah persediaan pengaman (Safety Stock) untuk
                                periode ke depan yang harus ada di gudang agar tidak terjadi kehabisan
                                persediaan untuk bahan baku kayu sebesar
                                <span class="font-semibold text-gray-900 dark:text-white">
                                    {{ number_format($ss, 3) }} ton
                                </span>.
                            </dt>
                        </div>
                        <div class="flex flex-col pt-3">
                            <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">
                                Waktu pemesanan kembali order point yang harus dilakukan adalah
                                <span class="font-semibold text-gray-900 dark:text-white">
                                    {{ number_format($orderPoint, 3) }} ton
                                </span>.
                            </dt>
                        </div>
                    </dl>

                </div>

            </div>
        </div>



    </div>

    {{--  Perhitungan Nilai 𝝈𝒅 --}}

    <div class="alert alert-lg bg-black my-2 text-white">
        <span class="hidden md:inline material-symbols-outlined">
            library_books
        </span>
        <div>
            <h3 class="font-bold"> Analisis Data dengan Metode Fixed Order Interval (FOI)</h3>
            <div class="text-xs"></div>
        </div>

        <span class="hidden md:inline material-symbols-outlined">
            checklist_rtl
        </span>
    </div>

    <div class="overflow-x-auto">
        <table class="table table-xs table-pin-rows table-pin-cols md:table-md">
            <!-- head -->
            <thead class="bg-base-200">
                <tr>
                    <th class="text-center">NO</th>
                    <th class="text-center">Bulan</th>
                    <th class="text-center">X</th>
                    <th class="text-center overline">X</th>
                    <th class="text-center">X - <span class="overline">X</span></th>
                    <th class="text-center">(X - <span class="overline">X</span>)²</th>
                    <th class="text-center">NO</th>
                </tr>
            </thead>
            <tbody>
                <!-- row 1 -->
                @php
                    $no = 1;
                @endphp
                @foreach ($data as $row)
                    @php
                        $xbarMin = $row->pemakaian - $Xbar;
                        $powXbarMin = pow($xbarMin, 2);
                    @endphp
                    <tr>
                        <th class="text-center">{{ $no }}</th>
                        <td class="text-center">{{ $row->bulan}}</td>
                        <td class="text-center">{{ number_format($row->pemakaian, 2, ',', '.') }}</td>

                        @if ($no == 1)
                            <td class="text-center border-2 font-bold" rowspan="{{ count($data) }}">
                                {{ number_format($Xbar, 9) }}
                            </td>
                        @else
                            {{-- <td class="text-center text-red-500">{{ number_format($Xbar, 2, ',', '.') }}</td> --}}
                        @endif

                        <td class="text-center">{{ number_format($xbarMin, 9) }}</td>
                        <td class="text-center">{{ number_format($powXbarMin, 9) }}</td>
                        <th>{{ $no++ }}</th>
                    </tr>
                @endforeach
                <tr class="bg-slate-200">
                    <td class="text-center font-bold" colspan="2">Total</td>
                    <td class="text-center font-semibold">{{ number_format($D, 9) }}</td>
                    <td></td>
                    <td class="text-center font-semibold">{{ $total_xbarMin }}</td>
                    <td class="text-center font-semibold">{{ number_format($total_powXbarMin, 9) }}</td>
                    <td></td>
                </tr>

            </tbody>
        </table>
    </div>



    <div class="text-xs md:text-lg mx-auto">
        @include('pages.hasil.foi')
    </div>

    @include('pages.hasil.poq')
</x-layout>
