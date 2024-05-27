    
        {{-- colapse  --}}
     


    
    
    {{-- sigma_d  --}}
    <div class="collapse collapse-plus m-2 bg-teal-600 text-white">
        <input type="radio" name="my-accordion-3" checked="checked" /> 
        <div class="collapse-title text-xl font-medium">
            Perhitungan Nilai 𝝈𝒅
        </div>
        <div class="collapse-content"> 
          <p>
            \(\begin{array}{rcl} \sigma_d\ 
            & = & \sqrt{ \frac{\sum(X - \overline{X})}{n}} \\ 
            & = & \sqrt{ \frac{ {{ $total_powXbarMin }} }{ {{ $countData }} }} \\
            & = & \sqrt{ {{ $total_powXbarMin / $countData }} } \\
            & = & {{ $sigma_d }}\ ton \\
            \end{array}\)
          </p>
        </div>
      </div>

      {{-- Perhitungan Nilai FOI --}}
      <div class="collapse collapse-plus m-2 bg-teal-600 text-white"">
        <input type="radio" name="my-accordion-3" /> 
        <div class="collapse-title text-xl font-medium">
          Perhitungan Nilai FOI
        </div>
        <div class="collapse-content"> 
          <p>
            \(\begin{array}{rcl} FOI\ 
            & = & d(OI + LT) + z\sigma_d \sqrt{ OI + LT } - A \\ 
            & = & {{ number_format($Xbar, 3) }} ( {{ $oi }} + {{ $lt }} ) + 1.65 ( {{ $sigma_d }} ) \sqrt{ {{ $oi }} + {{ $lt }} } - {{ $stok }} \\
            & = & {{ number_format($dOiLt, 0) }} + {{ $zSigma }} - {{ $stok }} \\
            & = & {{ $foi }} \\
            \end{array}\)
          </p>
        </div>
      </div>
      {{-- Mencari Besar Biaya Penyimpanan Perunit--}}
      <div class="collapse collapse-plus m-2 bg-teal-600 text-white">
        <input type="radio" name="my-accordion-3" /> 
        <div class="collapse-title text-xl font-medium">
            Mencari Besar Biaya Penyimpanan Perunit (C)
        </div>
        <div class="collapse-content"> 
          <p>
            \(\begin{array}{rcl} C\ 
            & = & \frac{ jumlah\ biaya\ penyimpana\ pertahun }{ jumlah\ kebutuhan\ bahan\ baku } \\ 
            & = & \frac{ {{ number_format($h, 0, ',', '.') }} }{ {{ $D }} } \\
            & = & {{ number_format($c, 3, ',', '.') }}  \\
            & = & Rp\ {{ number_format($c, 0, ',', '.') }} \\
            \end{array}\)
          </p>
        </div>
      </div>
    {{-- Mencari Nilai Q Optimal--}}
    <div class="collapse collapse-plus m-2 bg-teal-600 text-white">
        <input type="radio" name="my-accordion-3" /> 
        <div class="collapse-title text-xl font-medium">
            Mencari Nilai Q Optimal
        </div>
        <div class="collapse-content"> 
          <p>
            \(\begin{array}{rcl} Q\ Optimal\ 
            & = & \sqrt{ \frac{2·D·P}{C} } \\ 
            & = & \sqrt{ \frac{2({{ $D }})({{ number_format($K, 0, ',', '.') }})} { {{ number_format($c, 0, ',', '.') }} } } \\
            & = & \sqrt{ \frac{ {{ number_format($Dp, 0, ',', '.') }} } { {{{ number_format($c, 0, ',', '.') }}} } } \\
            & = & \sqrt{ {{ $sqrtQOptimal }} }  \\
            & = & {{ number_format($qOptimal_1, 3) }} : 30 × 4 \\
            & = & {{ number_format(($qOptimal), 3) }} ton 
            \end{array}\)
          </p>
          <p class="text-justify">
            Berdasarkan perhitungan dengan menggunakan metode rumus FOI, perusahaan
            CV. Family Jaya dalam sebulan dapat melakukan pembelian bahan baku kayu
            sebanyak {{ number_format(($qOptimal), 3) }} ton
          </p>
        </div>
      </div>
          {{-- Menentukan Permintaan Harian--}}
    <div class="collapse collapse-plus m-2 bg-teal-600 text-white">
        <input type="radio" name="my-accordion-3" /> 
        <div class="collapse-title text-xl font-medium">
            Menentukan Permintaan Harian
        </div>
        <div class="collapse-content"> 
          <p>
            \(\begin{array}{rcl} d\ 
            & = & \frac{Jumlah\ Kebutuhan\ Bahan\ Baku}{Jumlah\ Hari\ Kerja} \\ 
            & = & \frac{ {{ $D }}} { 260 } \\
            & = & {{number_format($d,3)}} ton 
            \end{array}\)
          </p>
          <p>
            Dengan perhitungan diatas datapat dilakukan perhitungan order point sebagai berikut
        </p>
        <p>
            \(\begin{array}{rcl} Order\ Point\ 
            & = & (d·L)+SS\ \\ 
            & = & ({{number_format($d,3)}}·7)+{{$ss}} \\
            & = & {{number_format($d*7,3)}}+{{number_format($ss,3)}} \\
            & = & {{number_format($orderPoint,3)}}\ ton
            \end{array}\)
        </p>
        <p>
            Jadi, apabila persediaan telah mencapai {{number_format($orderPoint,3)}} ton, maka harus segera dilakukan pemesanan kembali sebesar {{number_format($qOptimal,3)}} ton untuk memperoleh hasil yang optimal.
        </p>
        </div>
      </div>
    {{-- end Colapse --}}