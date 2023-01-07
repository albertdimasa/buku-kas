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
                    <th>Tagihan</th>
                    <th>Nominal Bayar</th>
                    <th>Tanggal</th>
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
                        <td>@rupiah($item->tagihan)</td>
                        <td>@rupiah($item->nominal)</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}</td>
                        <td>{{ $item->bulan }}</td>
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
        <button class="btn btn-danger py-3 my-2 text-bold text-uppercase">
            <i class="fas fa-exclamation mr-2"></i>
            Ada {{ $total_pekerja_belum_bayar }} Orang yang belum membayar pada Bulan
            {{ now()->subMonth()->isoFormat('MMMM Y') }}
            <i class="fas fa-exclamation ml-2"></i>
        </button>
        <div class="row py-3">
            <div class="col-md-3 mr-auto">
                <select class="form-control select2-normal" id="bulan_dipilih" name="bulan_dipilih">
                    <option value="Januari" @if ($bulan_dipilih == 'Januari') selected @endif>Januari</option>
                    <option value="Februari" @if ($bulan_dipilih == 'Februari') selected @endif>Februari</option>
                    <option value="Maret" @if ($bulan_dipilih == 'Maret') selected @endif>Maret</option>
                    <option value="April" @if ($bulan_dipilih == 'April') selected @endif>April</option>
                    <option value="Mei" @if ($bulan_dipilih == 'Mei') selected @endif>Mei</option>
                    <option value="Juni" @if ($bulan_dipilih == 'Juni') selected @endif>Juni</option>
                    <option value="Juli" @if ($bulan_dipilih == 'Juli') selected @endif>Juli</option>
                    <option value="Agustus" @if ($bulan_dipilih == 'Agustus') selected @endif>Agustus</option>
                    <option value="September" @if ($bulan_dipilih == 'September') selected @endif>September</option>
                    <option value="Oktober" @if ($bulan_dipilih == 'Oktober') selected @endif>Oktober</option>
                    <option value="November" @if ($bulan_dipilih == 'November') selected @endif>November</option>
                    <option value="Desember" @if ($bulan_dipilih == 'Desember') selected @endif>Desember</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-control select2-normal" id="tahun_dipilih" name="tahun_dipilih">
                    <option value="2022" @if ($tahun_dipilih == '2022') selected @endif>2022</option>
                    <option value="2023" @if ($tahun_dipilih == '2023') selected @endif>2023</option>
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
@stop

@include('admin.function.datatables')
@include('admin.function.alert-hide')
@include('admin.function.select')
@include('admin.function.rupiah')
