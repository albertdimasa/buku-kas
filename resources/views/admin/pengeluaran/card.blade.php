<div class="row">
    <div class="col-lg-4">
        <div class="info-box bg-gradient-danger">
            <span class="info-box-icon"><i class="fas fa-money-bill-wave"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Pengeluaran {{ now()->subMonth()->isoFormat('MMMM Y') }}</span>
                <span class="info-box-number">Rp @rupiah($pengeluaran_bulan_ini)</span>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="info-box bg-gradient-indigo">
            <span class="info-box-icon"><i class="fas fa-exclamation"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Pengeluaran</span>
                <span class="info-box-number">{{ $total_bulan_ini }} Kali</span>
            </div>
        </div>
    </div>
</div>
