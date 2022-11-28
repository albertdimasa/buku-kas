<!-- Create Modal -->
<div class="modal fade" id="deletePekerja-{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="deletePekerjaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePekerjaLabel">Delete Pekerja</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('pekerja.destroy', $item) }}" method="post">
                    @method('delete')
                    @csrf
                    <p>Anda yakin ingin menghapus <strong>{{ $item->nama }}</strong></p>
                    @include('admin.components.button', ['submit' => 'yakin', 'close' => 'tutup'])
                </form>
            </div>
        </div>
    </div>
</div>
