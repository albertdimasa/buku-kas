@push('js')
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function() {
            $('.select2').select2({
                theme: 'bootstrap4',
                dropdownParent: $('#createPembayaran')
            })
        })
    </script>
@endpush
