<!-- Create Modal -->
<div class="modal fade" id="createPengeluaran" tabindex="-1" role="dialog" aria-labelledby="createPengeluaranLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPengeluaranLabel">Masukkan Pengeluaran</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('pengeluaran.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="InputNama" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="InputNominal" class="form-label">Nominal</label>
                        <input type="text" class="form-control" name="nominal" id="rupiah" required>
                    </div>
                    <div class="mb-3">
                        <label for="InputTanggal" class="form-label">Tanggal Bayar</label>
                        <input type="date" class="form-control" name="tanggal" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="InputBukti" class="form-label">Bukti Pembayaran</label>
                        <input type="file" class="form-control" name="bukti"
                            accept="image/png, image/jpeg, image/jpg" required>
                    </div>
                    @include('admin.components.button', ['submit' => 'submit', 'close' => 'close'])
                </form>
            </div>
        </div>
    </div>
</div>
