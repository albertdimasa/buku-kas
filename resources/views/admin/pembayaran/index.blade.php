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
            Ada {{ $pekerja_belum_bayar }} Orang yang belum membayar pada Bulan
            {{ now()->subMonth()->isoFormat('MMMM Y') }}
            <i class="fas fa-exclamation ml-2"></i>
        </button>
        <table id="table2" class="table table-bordered table-hover bg-white">
            <thead>
                <tr>
                    <th>ID Absen</th>
                    <th>Nama</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pekerja as $item)
                    <tr>
                        <td>{{ $item->id_absen }}</td>
                        <td class="text-capitalize">{{ $item->nama }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop

@include('admin.function.datatables')
@include('admin.function.alert-hide')
@include('admin.function.select')
@include('admin.function.rupiah')
