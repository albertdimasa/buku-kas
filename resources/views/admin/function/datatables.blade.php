@push('js')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script>
        $(function() {
            let tahun = $('#filter_report').val();

            $('#table').DataTable({
                // "paging": true,
                // "lengthChange": false,
                // "searching": false,
                // "ordering": true,
                // "info": true,
                "autoWidth": false,
                "responsive": true,

            });

            $('#table2').DataTable({
                "responsive": true,
                "scrollY": '200px',
                "scrollCollapse": true,
            });

        })
    </script>
@endpush
