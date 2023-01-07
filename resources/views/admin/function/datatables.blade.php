@push('js')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <!-- script tambahan  -->
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
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

            let tahun_dipilih = $('#tahun_dipilih').val();
            let bulan_dipilih = $('#bulan_dipilih').val();

            // Table Daftar Orang Yang Belum Bayar
            const table_orang = $('#table_orang').DataTable({
                columnDefs: [{
                    "defaultContent": "-",
                    "targets": "_all"
                }],
                "responsive": true,
                "scrollY": '200px',
                "processing": true,
                "bServerSide": true,
                dom: 'Bfrtip',
                buttons: [
                    'excel'
                ],
                "ajax": {
                    url: "{{ route('pembayaran.table') }}",
                    type: "POST",
                    data: function(d) {
                        d._token = "{{ csrf_token() }}";
                        d.bulan_dipilih = bulan_dipilih;
                        d.tahun_dipilih = tahun_dipilih;
                        return d;
                    }
                },
                "columns": [{
                        "render": function(data, type, row, meta) {
                            return row.id_absen
                        }
                    },
                    {
                        "render": function(data, type, row, meta) {
                            return row.nama
                        }
                    },
                ]
            });

            $("#tahun_dipilih").on('change', function() {
                tahun_dipilih = $('#tahun_dipilih').val();
                table_orang.ajax.reload(null, false);
            });

            $("#bulan_dipilih").on('change', function() {
                bulan_dipilih = $('#bulan_dipilih').val();
                table_orang.ajax.reload(null, false);
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
        })
    </script>
@endpush
