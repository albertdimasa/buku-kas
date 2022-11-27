<!-- Create Modal -->
<div class="modal fade" id="createPembayaran" tabindex="-1" role="dialog" aria-labelledby="createPembayaranLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPembayaranLabel">Masukkan Pembayaran</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('pembayaran.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="InputNama" class="form-label">Nama</label>
                        <select class="form-control select2" name="id_absen" required>
                            @foreach ($pekerja as $data)
                                <option value="{{ $data->id_absen }}">{{ $data->id_absen }} - {{ $data->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col">
                                <label for="InputTagihan" class="form-label">Tagihan</label>
                                <input type="number" class="form-control" name="tagihan" value="@rupiah(20000)"
                                    readonly required>
                            </div>
                            <div class="col">
                                <label for="InputNominal" class="form-label">Nominal</label>
                                <input type="text" class="form-control" name="nominal" id="rupiah"
                                    value="@rupiah(20000)" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="InputTanggal" class="form-label">Tanggal Bayar</label>
                        <input type="date" class="form-control" name="tanggal" required value="{{ date('Y-m-d') }}">
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col">
                                <label for="InputBulan" class="form-label">Pembayaran Bulan</label>
                                <select class="form-control select2" name="bulan" required>
                                    @for ($i = 0; $i < count($bulan); $i++)
                                        <option value="{{ $bulan[$i] }}"
                                            @if (date('F') == $bulan[$i]) selected @endif>
                                            {{ $bulan[$i] }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col">
                                <label for="InputTahun" class="form-label">Tahun</label>
                                <input type="number" class="form-control" name="tahun" required
                                    value="{{ date('Y') }}">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="InputBukti" class="form-label">Bukti Pembayaran</label>
                        <input type="file" class="form-control" name="bukti"
                            accept="image/png, image/jpeg, image/jpg" required>
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
