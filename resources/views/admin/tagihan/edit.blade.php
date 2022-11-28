<!-- Edit Modal -->
<div class="modal fade" id="editTagihan-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editTagihanLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTagihanLabel">Edit Tagihan</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('tagihan.update', $item) }}" method="post">
                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <label for="InputNominal" class="form-label">Nominal</label>
                        <input type="text" class="form-control" name="nominal" id="rupiah"
                            value="{{ $item->nominal }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="InputNama" class="form-label">Bulan</label>
                        <select class="form-control select2" name="bulan" required>
                            @for ($i = 0; $i < count($bulan); $i++)
                                <option value="{{ $bulan[$i] }}" {{ $bulan[$i] == $item->bulan ? 'selected' : '' }}>
                                    {{ $bulan[$i] }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="InputNomorHp" class="form-label">Tahun</label>
                        <input type="number" class="form-control" name="tahun" value="{{ $item->tahun }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="InputTanggalBergabung" class="form-label">Catatan <span
                                class="text-secondary">(Optional)</span></label>
                        <input type="text" class="form-control" name="catatan" value="{{ $item->catatan }}">
                    </div>
                    @include('admin.components.button', ['submit' => 'submit', 'close' => 'close'])
                </form>
            </div>
        </div>
    </div>
</div>
