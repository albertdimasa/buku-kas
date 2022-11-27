@extends('layouts.master')
@section('title')
    Pengeluaran
@stop
@section('content')
    @include('admin.pembayaran.card')
    <div class="card p-2">
        <button type="button" class="btn btn-primary btn-sm d-block my-2 ml-auto" data-toggle="modal"
            data-target="#createPembayaran">
            Masukkan Pembayaran
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
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->bulan }}</td>
                        <td>
                            <a href="{{ asset('storage/bukti_pembayaran/' . $item->bukti) }}" type="button"
                                class="btn btn-warning btn-sm" target="_blank">
                                Lihat Disini
                            </a>
                        </td>
                        <td>
                            {{-- <button class="btn btn-sm btn-primary" data-toggle="modal"
                                data-target="#editPembayaran-{{ $item->id }}">
                                <i class="fas fa-edit"></i>
                            </button> --}}
                            <button class="btn btn-sm btn-danger" data-toggle="modal"
                                data-target="#deletePembayaran-{{ $item->id }}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            {{-- @include('admin.pembayaran.edit') --}}
                            @include('admin.pembayaran.delete')
                        </td>
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
