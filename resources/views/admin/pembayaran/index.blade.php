@extends('layouts.master')
@section('title')
    Pemasukan
@stop
@section('content')
    {{-- Elemen 1 --}}
    @include('admin.pembayaran.card')
    <div class="card p-3">
        @role('admin')
            <button type="button" class="btn btn-primary btn-sm d-block my-2 ml-auto" data-toggle="modal"
                data-target="#createPembayaran">
                Masukkan Pemasukan
            </button>
            @include('admin.pembayaran.create')
            @include('admin.function.alert')
            <div class="row py-3">
                <div class="col-md-2">
                    <select class="form-control select2-normal" name="bulan_bayar" id="bulan_bayar">
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
                        <option value="Desember">Desember
                        </option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-control select2-normal" name="tahun_bayar" id="tahun_bayar">
                        <option selected disabled>Pilih Tahun</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                    </select>
                </div>
                <div class="col-md-2 my-auto">
                    <form action="{{ route('pembayaran.export') }}" method="post" id="ExportPembayaran">
                        @csrf
                        <input type="hidden" name="bulan" id="bulan_export">
                        <input type="hidden" name="tahun" id="tahun_export">
                        <button type="submit" class="btn btn-success btn-sm">
                            Export Excel
                        </button>
                    </form>
                </div>
            </div>
        @endrole
        <table id="table_pembayaran" class="table table-bordered table-hover bg-white">
            <thead>
                <tr>
                    <th width="15%">ID Absen</th>
                    <th>Nama</th>
                    <th width="15%">Nominal</th>
                    <th width="25%">Tanggal Pembayaran</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($items as $item)
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
                        @role('admin')
                            <td>
                                <button class="btn btn-sm btn-danger" data-toggle="modal"
                                    data-target="#deletePembayaran-{{ $item->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                @include('admin.pembayaran.delete')
                            </td>
                        @endrole
                    </tr>
                @endforeach --}}
            </tbody>
        </table>
    </div>

    {{-- Elemen 2 --}}
    @role('admin')
        <div class="card p-2">
            <button class="btn btn-danger py-3 my-2 text-bold text-uppercase" id="total_belum_bayar">
                <i class="fas fa-exclamation mr-2"></i>
                Pilih Bulan dan Tahun Terlebih Dahulu
                <i class="fas fa-exclamation ml-2"></i>
            </button>
            <div class="row py-3">
                <div class="col-md-2">
                    <select class="form-control select2-normal" name="bulan_dipilih" id="bulan_dipilih">
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
                        <option value="Desember">Desember
                        </option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-control select2-normal" name="tahun_dipilih" id="tahun_dipilih">
                        <option selected disabled>Pilih Tahun</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2024">2025</option>
                    </select>
                </div>
                <div class="col-md-2 my-auto">
                    <form action="{{ route('pembayaran.export') }}" method="post" id="ExportPembayaran">
                        @csrf
                        <input type="hidden" name="bulan" id="bulan_belum_bayar_export">
                        <input type="hidden" name="tahun" id="tahun_belum_bayar_export">
                        <button type="submit" class="btn btn-success btn-sm">
                            Export Excel
                        </button>
                    </form>
                </div>
            </div>
            <table id="table_orang" class="table table-bordered table-hover bg-white">
                <thead>
                    <tr>
                        <th width="15%">ID Absen</th>
                        <th>Nama</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    @endrole
    @push('js')
        {{-- Elemen 1 --}}
        <script>
            let tahun = $('#tahun_bayar').val();
            let bulan = $('#bulan_bayar').val();

            const table_pembayaran = $('#table_pembayaran').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('pembayaran.index.load') }}",
                    type: "POST",
                    data: function(d) {
                        d._token = "{{ csrf_token() }}";
                        d.tahun = tahun;
                        d.bulan = bulan;
                        return d;
                    }
                },
                columns: [{
                        data: 'id_absen',
                        name: 'id_absen'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'nominal',
                        name: 'nominal'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'bulan',
                        name: 'bulan'
                    },
                    {
                        data: 'tahun',
                        name: 'tahun'
                    }
                ]
            });

            $('#tahun_bayar').on('change', function() {
                tahun = $('#tahun_bayar').val();
                $('#tahun_export').val(tahun);
                table_pembayaran.ajax.reload(null, false);
            });

            $('#bulan_bayar').on('change', function() {
                bulan = $('#bulan_bayar').val();
                $('#bulan_export').val(bulan);
                table_pembayaran.ajax.reload(null, false);
            });
        </script>
        <script>
            let tahun_dipilih = $('#tahun_dipilih').val();
            let bulan_dipilih = $('#bulan_dipilih').val();

            // Table Daftar Orang Yang Belum Bayar
            const table_orang = $('#table_orang').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('pembayaran.belum_bayar.load') }}",
                    type: "POST",
                    data: function(d) {
                        d._token = "{{ csrf_token() }}";
                        d.bulan_dipilih = bulan_dipilih;
                        d.tahun_dipilih = tahun_dipilih;
                        return d;
                    },
                },
                columns: [{
                        data: 'id_absen',
                        name: 'id_absen'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    }
                ]
            });

            $("#tahun_dipilih").on('change', function() {
                tahun_dipilih = $('#tahun_dipilih').val();
                $('#tahun_belum_bayar_export').val(bulan);
                table_orang.ajax.reload(null, false);
            });

            $("#bulan_dipilih").on('change', function() {
                bulan_dipilih = $('#bulan_dipilih').val();
                $('#bulan_belum_bayar_export').val(bulan);
                table_orang.ajax.reload(null, false);
            });
        </script>
    @endpush
@stop

@include('admin.function.datatables')
@include('admin.function.alert-hide')
@include('admin.function.select')
@include('admin.function.rupiah')
