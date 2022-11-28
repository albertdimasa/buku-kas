<!-- Create Modal -->
<div class="modal fade" id="createPekerja" tabindex="-1" role="dialog" aria-labelledby="createPekerjaLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPekerjaLabel">Tambah Pekerja</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('pekerja.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="InputNama" class="form-label">ID Absen</label>
                        <input type="text" class="form-control" name="id_absen" required>
                    </div>
                    <div class="mb-3">
                        <label for="InputNama" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="InputNomorHp" class="form-label">Nomor Hp</label>
                        <input type="number" class="form-control" name="nomor_hp" required>
                    </div>
                    <div class="mb-3">
                        <label for="InputTanggalBergabung" class="form-label">Tanggal Bergabung</label>
                        <input type="date" class="form-control" name="tanggal_bergabung" required>
                    </div>
                    @include('admin.components.button', ['submit' => 'submit', 'close' => 'close'])
                </form>
            </div>
        </div>
    </div>
</div>
