<!-- Edit Modal -->
<div class="modal fade" id="editPekerja-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editPekerjaLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPekerjaLabel">Edit Pekerja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pekerja.update', $item) }}" method="post">
                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <label for="InputNama" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" value="{{ $item->nama }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="InputNomorHp" class="form-label">Nomor Hp</label>
                        <input type="number" class="form-control" name="nomor_hp" value="{{ $item->nomor_hp }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="InputTanggalBergabung" class="form-label">Tanggal Bergabung</label>
                        <input type="date" class="form-control" name="tanggal_bergabung"
                            value="{{ $item->tanggal_bergabung }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary d-block ml-auto">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
