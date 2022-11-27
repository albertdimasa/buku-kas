<!-- Create Modal -->
<div class="modal fade" id="deletePembayaran-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="deletePembayaranLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePembayaranLabel">Hapus Pembayaran {{ $item->id }}</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('pembayaran.destroy', $item) }}" method="post">
                    @method('delete')
                    @csrf
                    <p>Anda yakin ingin menghapus pembayaran milik <strong>{{ $item->nama }}</strong></p>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-secondary mr-1" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary ">Yakin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
