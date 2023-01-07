<div class="row">
    <div class="col-lg-4">
        <div class="info-box bg-gradient-info">
            <span class="info-box-icon"><i class="fas fa-money-bill-wave"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Pemasukan {{ now()->subMonth()->isoFormat('MMMM Y') }}</span>
                <span class="info-box-number">Rp @rupiah($total_bulan_ini)</span>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="info-box bg-gradient-warning">
            <span class="info-box-icon"><i class="fas fa-exclamation"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Belum Membayar</span>
                <span class="info-box-number">{{ $total_pekerja_belum_bayar }} Orang</span>
            </div>
        </div>
    </div>
</div>
