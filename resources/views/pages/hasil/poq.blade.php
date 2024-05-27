    <div class="alert alert-lg bg-black my-2 text-white">
        <span class="hidden md:inline material-symbols-outlined">
            library_books
        </span>
        <div>
            <h3 class="font-bold"> Analisis Data dengan Metode Periodic Order Quantity (POQ)</h3>
            <div class="text-xs"></div>
        </div>

        <span class="hidden md:inline material-symbols-outlined">
            checklist_rtl
        </span>
    </div>

    {{-- sigma_d  --}}
    <div class="collapse collapse-plus m-2 bg-teal-600 text-white">
        <input type="radio" name="my-accordion-1" checked="checked" />
        <div class="collapse-title text-xl font-medium">
            Permintaan Harian
        </div>
        <div class="collapse-content">
            <p>
                \(\begin{array}{rcl} d\
                & = & \frac{D}{t} \\
                & = & \frac{ {{ $D }} }{ {{ 260 }} } \\
                & = & {{ number_format($d, 3) }}\ ton\ Perhari \\
                \end{array}\)
            </p>
        </div>
    </div>
    {{-- sigma_d  --}}
    <div class="collapse collapse-plus m-2 bg-teal-600 text-white">
        <input type="radio" name="my-accordion-1" checked="checked" />
        <div class="collapse-title text-xl font-medium">
            Persedian Harian
        </div>
        <div class="collapse-content">
            <p>
                \(\begin{array}{rcl} S\
                & = & \frac{s}{t} \\
                & = & \frac{ {{ number_format($s, 3) }} }{ {{ 260 }} } \\
                & = & {{ number_format($S, 3) }}\ ton\ Perhari \\
                \end{array}\)
            </p>
        </div>
    </div>
    {{-- sigma_d  --}}
    <div class="collapse collapse-plus m-2 bg-teal-600 text-white">
        <input type="radio" name="my-accordion-1" checked="checked" />
        <div class="collapse-title text-xl font-medium">
            Perhitungan Nilai POQ
        </div>
        <div class="collapse-content">
            <p>
                \(\begin{array}{rcl} \sigma_d\
                & = & \sqrt{ \frac{2·D·K}{h(1-\frac{d}{s})}} \\
                & = & \sqrt{ \frac{2({{ $D }})({{ number_format($K, 3) }})}{
                {{ number_format($h, 0, ',', '.') }}(1-\frac{ {{ number_format($d, 3) }} }{
                {{ number_format($S, 3) }} })}} \\
                & = & \sqrt{ \frac{ {{ number_format(2 * $D * $K, 3) }} }{
                {{ number_format($h, 0, ',', '.') }}(1- {{ number_format($d / $S, 3) }} )}} \\
                & = & \sqrt{ \frac{ {{ number_format(2 * $D * $K, 3) }} }{
                {{ number_format($h, 0, ',', '.') }}({{ number_format(1 - $d / $S, 3) }})}} \\
                & = & \sqrt{ \frac{ {{ number_format(2 * $D * $K, 3) }} }{
                {{ number_format($h * (1 - $d / $S), 0, ',', '.') }} }} \\
                & = & \sqrt{
                {{ number_format((2 * $D * $K) / ($h * (1 - $d / $S)), 3) }} }
                \\
                & = & {{ number_format($poq, 3) }}\ ton \\
                \end{array}\)
            </p>
            <p>
                Berdasarkan perhitungan dengan menggunakan metode rumus POQ, perusahaan dapat melakukan pembelian bahan
                baku kayu sebanyak {{ $poq }} ton
            </p>
        </div>
    </div>
    {{-- sigma_d  --}}
    <div class="collapse collapse-plus m-2 bg-teal-600 text-white">
        <input type="radio" name="my-accordion-1" checked="checked" />
        <div class="collapse-title text-xl font-medium">
            Frekuensi Pemesanan Dalam Setahun
        </div>
        <div class="collapse-content">
            <p>
                \(\begin{array}{rcl} S\
                & = & \frac{D}{q} \\
                & = & \frac{ {{ number_format($D, 3) }} }{ {{ number_format($poq, 3) }} } \\
                & = & {{ number_format($N, 3) }}\ Kali \\
                & = & {{ number_format($N, 0) }}\ Kali \\
                \end{array}\)
            </p>
        </div>
    </div>

    {{-- sigma_d  --}}
    <div class="collapse collapse-plus m-2 bg-teal-600 text-white">
        <input type="radio" name="my-accordion-1" checked="checked" />
        <div class="collapse-title text-xl font-medium">
            Biaya Penyediaan
        </div>
        <div class="collapse-content">
            <p>
                \(\begin{array}{rcl} 𝑐(𝑞)\
                & = & \frac{D·K}{q}+\frac{h·q}{2}+(1-\frac{d}{s}) \\

                & = & \frac{ {{$D}}·( {{number_format($K, 0)}} )} { {{number_format($poq,3)}} }+
                    \frac{ {{number_format($h, 0, ',', '.')}} · ( {{number_format($poq,3)}} ) }{2}
                    (1-\frac{ {{number_format($d,3)}} }{ {{number_format($S,3)}} }) \\

                & = & \frac{ {{number_format($D*$K,3)}} }{ {{number_format($poq,3)}} }+
                    \frac{ {{number_format($h*$poq,3)}} }{2}
                    (1-\ {{number_format($d/$S,3)}} ) \\

                & = & {{ number_format( ($D*$K)/$poq ,3) }}+
                    {{number_format(($h*$poq)/2,3)}}
                    (1-\ {{number_format($d/$S,3)}} ) \\

                & = & {{ number_format( ($D*$K)/$poq ,3) }}+
                    {{number_format(($h*$poq)/2,3)}}
                    ( {{number_format(1-($d/$S),3)}} ) \\

                & = & {{ number_format($cq, 3) }} \\
                & = & Rp\ {{ number_format($cq, 0) }} \\
                \end{array}\)
            </p>
            <p>
                Jadi, diperoleh biaya penyediaan 𝑐(𝑞) selama setahun sebesar Rp {{ number_format($cq, 0) }}.
            </p>
        </div>
    </div>
