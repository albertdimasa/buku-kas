<!-- Create Modal -->
<div class="modal fade" id="deleteTagihan-{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="deleteTagihanLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteTagihanLabel">Delete Tagihan</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('tagihan.destroy', $item) }}" method="post">
                    @method('delete')
                    @csrf
                    <p>Anda yakin ingin menghapus Tagihan Bulan <strong>{{ $item->bulan }} {{ $item->tahun }}</strong>
                        dengan nominal <strong>@rupiah($item->nominal)?</strong>
                    </p>
                    @include('admin.components.button', ['submit' => 'yakin', 'close' => 'tidak'])
                </form>
            </div>
        </div>
    </div>
</div>
