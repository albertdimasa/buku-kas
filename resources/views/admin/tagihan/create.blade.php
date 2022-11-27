<!-- Create Modal -->
<div class="modal fade" id="createTagihan" tabindex="-1" role="dialog" aria-labelledby="createTagihanLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTagihanLabel">Tambah Tagihan</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('tagihan.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="InputNama" class="form-label">Nominal</label>
                        <input type="text" class="form-control" name="nominal" id="rupiah" required>
                    </div>
                    <div class="mb-3">
                        <label for="InputNama" class="form-label">Bulan</label>
                        <select class="form-control select2" name="bulan" required>
                            @for ($i = 0; $i < count($bulan); $i++)
                                <option value="{{ $bulan[$i] }}">
                                    {{ $bulan[$i] }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="InputNomorHp" class="form-label">Tahun</label>
                        <input type="number" class="form-control" name="tahun" required>
                    </div>
                    <div class="mb-3">
                        <label for="InputTanggalBergabung" class="form-label">Catatan <span
                                class="text-secondary">(Optional)</span></label>
                        <input type="text" class="form-control" name="catatan">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-secondary mr-1" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
