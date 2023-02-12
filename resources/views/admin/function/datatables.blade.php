@push('js')
    <script>
        $(function() {

            // Table Umum
            $('#table').DataTable({
                "autoWidth": false,
                "responsive": true,
            });

            // Table Pengguna
            $('#table_pengguna').DataTable({
                "autoWidth": false,
                "responsive": true,
                "paging": false,
            });

            // Table Report
            let tahun = $('#filter_report').val();
            let type = $('#type_report').val();

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
                "bServerSide": true,
                "searching": false,
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
                            return row.bulan
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

            $('#table-excel').DataTable({
                "paging": false,
                "dom": 'lBftip',
                "buttons": [
                    'excel'
                ]
            })
        })
    </script>
@endpush
