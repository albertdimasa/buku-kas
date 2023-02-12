@extends('layouts.master')
@section('title')
    Pengeluaran
@stop
@section('content')
    @include('admin.pengeluaran.card')
    <div class="card p-2">
        @role('admin')
            <button type="button" class="btn btn-primary btn-sm d-block my-2 ml-auto" data-toggle="modal"
                data-target="#createPengeluaran">
                Masukkan Pengeluaran
            </button>
            @include('admin.pengeluaran.create')
            @include('admin.function.alert')
        @endrole
        <table id="table-excel" class="table table-bordered table-hover bg-white">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Nominal Bayar</th>
                    <th>Bukti</th>
                    @role('admin')
                        <th>Action</th>
                    @endrole
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-capitalize">{{ $item->nama }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}</td>
                        <td>@rupiah($item->nominal)</td>
                        <td>
                            <a href="{{ asset('storage/bukti_pengeluaran/' . $item->bukti) }}" type="button"
                                class="btn btn-warning btn-sm" target="_blank">
                                Lihat Disini
                            </a>
                        </td>
                        @role('admin')
                            <td>
                                <button class="btn btn-sm btn-danger" data-toggle="modal"
                                    data-target="#deletePengeluaran-{{ $item->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                @include('admin.pengeluaran.delete')
                            </td>
                        @endrole
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop

@include('admin.function.datatables')
@include('admin.function.alert-hide')
@include('admin.function.rupiah')
