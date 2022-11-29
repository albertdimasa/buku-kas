<!-- Create Modal -->
<div class="modal fade" id="deletePengeluaran-{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="deletePengeluaranLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePengeluaranLabel">Hapus Pengeluaran</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('pengeluaran.destroy', $item) }}" method="post">
                    @method('delete')
                    @csrf
                    <p>Anda yakin ingin menghapus pengeluaran <strong>{{ $item->nama }}</strong>?</p>
                    @include('admin.components.button', ['submit' => 'yakin', 'close' => 'tidak'])
                </form>
            </div>
        </div>
    </div>
</div>
