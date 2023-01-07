@extends('layouts.master')
@section('title')
    Pemasukan
@stop
@section('content')
    {{-- Elemen 1 --}}
    @include('admin.pembayaran.card')
    <div class="card p-2">
        <button type="button" class="btn btn-primary btn-sm d-block my-2 ml-auto" data-toggle="modal"
            data-target="#createPembayaran">
            Masukkan Pemasukan
        </button>
        @include('admin.pembayaran.create')
        @include('admin.function.alert')
        <table id="table" class="table table-bordered table-hover bg-white">
            <thead>
                <tr>
                    <th>ID Absen</th>
                    <th>Nama</th>
                    <th>Nominal</th>
                    <th>Tanggal Pembayaran</th>
                    <th>Bulan</th>
                    <th>Bukti</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->id_absen }}</td>
                        <td class="text-capitalize">{{ $item->nama }}</td>
                        <td>@rupiah($item->nominal)</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}</td>
                        <td>{{ $item->bulan }} {{ $item->tahun }}</td>
                        <td>
                            <a href="{{ asset('storage/bukti_pembayaran/' . $item->bukti) }}" type="button"
                                class="btn btn-warning btn-sm" target="_blank">
                                Lihat Disini
                            </a>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-danger" data-toggle="modal"
                                data-target="#deletePembayaran-{{ $item->id }}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            @include('admin.pembayaran.delete')
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Elemen 2 --}}
    <div class="card p-2">
        <button class="btn btn-danger py-3 my-2 text-bold text-uppercase" id="total_belum_bayar">
            <i class="fas fa-exclamation mr-2"></i> Pilih Bulan dan Tahun Terlebih Dahulu
            <i class="fas fa-exclamation ml-2"></i>
        </button>
        <div class="row py-3">
            <div class="col-md-3 mr-auto">
                <select class="form-control select2-normal" id="bulan_dipilih" name="bulan_dipilih">
                    <option selected disabled>Pilih Bulan</option>
                    <option value="Januari">Januari</option>
                    <option value="Februari">Februari</option>
                    <option value="Maret">Maret</option>
                    <option value="April">April</option>
                    <option value="Mei">Mei</option>
                    <option value="Juni">Juni</option>
                    <option value="Juli">Juli</option>
                    <option value="Agustus">Agustus</option>
                    <option value="September">September</option>
                    <option value="Oktober">Oktober</option>
                    <option value="November">November</option>
                    <option value="Desember">Desember</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-control select2-normal" id="tahun_dipilih" name="tahun_dipilih">
                    <option selected disabled>Pilih Tahun</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                </select>
            </div>
        </div>
        <table id="table_orang" class="table table-bordered table-hover bg-white">
            <thead>
                <tr>
                    <th>ID Absen</th>
                    <th>Nama</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>

    @push('js')
        <script>
            let tahun_dipilih = $('#tahun_dipilih').val();
            let bulan_dipilih = $('#bulan_dipilih').val();
            let bulan_id = {!! json_encode($bulan) !!};

            // Table Daftar Orang Yang Belum Bayar
            const table_orang = $('#table_orang').DataTable({
                columnDefs: [{
                    "defaultContent": "-",
                    "targets": "_all"
                }],
                "paging": false,
                "responsive": true,
                "scrollY": '300px',
                "processing": true,
                "serverSide": true,
                "searching": false,
                "ordering": false,
                "dom": 'lBftip',
                "buttons": [
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
                    },
                },
                "columns": [{
                        "render": function(data, type, row, meta) {
                            return row.id_absen
                        }
                    },
                    {
                        "render": function(data, type, row, meta) {
                            return row.nama.toUpperCase()
                        }
                    },
                ]
            });

            $("#tahun_dipilih").on('change', function() {
                tahun_dipilih = $('#tahun_dipilih').val();
                table_orang.ajax.reload(null, false);
                if (bulan_dipilih != null) {
                    $("#total_belum_bayar").html('Ada ' + table_orang.ajax.json().recordsFiltered +
                        ' Orang yang belum membayar pada Bulan ' + bulan_dipilih + ' ' +
                        tahun_dipilih);
                }
            });

            $("#bulan_dipilih").on('change', function() {
                bulan_dipilih = $('#bulan_dipilih').val();
                table_orang.ajax.reload(null, false);
                if (tahun_dipilih != null) {
                    $("#total_belum_bayar").html('Ada ' + table_orang.ajax.json().recordsFiltered +
                        ' Orang yang belum membayar pada Bulan ' + bulan_dipilih + ' ' +
                        tahun_dipilih);
                }
            });
        </script>
    @endpush
@stop

@include('admin.function.datatables')
@include('admin.function.alert-hide')
@include('admin.function.select')
@include('admin.function.rupiah')
