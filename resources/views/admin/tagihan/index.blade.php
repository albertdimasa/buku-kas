@extends('layouts.master')
@section('title')
    Tagihan
@stop
@section('content')
    <div class="card p-2">
        <button type="button" class="btn btn-primary btn-sm d-block my-2 ml-auto" data-toggle="modal"
            data-target="#createTagihan">
            Tambah Tagihan
        </button>
        @include('admin.tagihan.create')
        @include('admin.function.alert')
        @include('admin.function.rupiah')
        <table id="table" class="table table-bordered table-hover bg-white">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nominal</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>Catatan</th>
                    <th>Dibuat Oleh</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>@rupiah($item->nominal)</td>
                        <td>{{ $item->bulan }}</td>
                        <td>{{ $item->tahun }}</td>
                        <td>{{ $item->catatan }}</td>
                        <td>{{ $item->created_by }}</td>
                        <td>
                            <button class="btn btn-sm btn-primary" data-toggle="modal"
                                data-target="#editPekerja-{{ $item->id }}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" data-toggle="modal"
                                data-target="#deletePekerja-{{ $item->id }}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            @include('admin.pekerja.edit')
                            @include('admin.pekerja.delete')
                        </td>
                    </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </div>
@stop

@include('admin.function.datatables')
@include('admin.function.alert-hide')
