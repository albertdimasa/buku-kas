@push('js')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script>
        $(function() {

            // Table Umum
            $('#table').DataTable({
                "autoWidth": false,
                "responsive": true,

            });

            // Table Daftar Orang Yang Belum Bayar
            $('#table2').DataTable({
                "responsive": true,
                "scrollY": '200px',
                "scrollCollapse": true,
            });

            // Table Report
            let tahun = $('#filter_report').val();
            let type = $('#type_report').val();
            var i = 1;
            const table = $('#table_rep').DataTable({
                columnDefs: [{
                    "defaultContent": "-",
                    "targets": "_all"
                }],
                "paging": false,
                "bInfo": false,
                "autoWidth": false,
                "responsive": true,
                "processing": true,
                "searching": false,
                "bServerSide": true,
                "ordering": false,
                "ajax": {
                    url: "{{ route('laporan.table') }}",
                    type: "POST",
                    data: function(d) {
                        d._token = "{{ csrf_token() }}";
                        d.tahun = tahun;
                        d.type = type;
                        return d;
                    }
                },
                "columns": [{
                        "render": function(data, type, row, meta) {
                            return formatRupiah(row.bulan)
                        }
                    },
                    {
                        "render": function(data, type, row, meta) {
                            return formatRupiah(row.total)
                        }
                    },
                ]
            });

            $("#filter_report").on('change', function() {
                tahun = $('#filter_report').val();
                table.ajax.reload(null, false);
            });

            $("#type_report").on('change', function() {
                type = $('#type_report').val();
                table.ajax.reload(null, false);
            });

            // Format Rupiah
            const formatRupiah = (money) => {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(money);
            }
        })
    </script>
@endpush
