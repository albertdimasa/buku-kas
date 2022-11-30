@extends('layouts.master')
@section('title')
    Pekerja
@stop
@section('content')
    <div class="card p-2">
        <div class="d-flex my-3">
            {{-- <span class="badge text-bg-primary">Primary</span> --}}
            <div class="ml-auto">
                <select class="form-control select2-normal" id="filter_report">
                    <option value="2022" @if ($tahun == '2022') selected @endif>2022</option>
                    <option value="2023" @if ($tahun == '2023') selected @endif>2023</option>
                </select>
            </div>
        </div>
        {{-- @include('admin.pekerja.create') --}}
        {{-- @include('admin.function.alert') --}}
        <table id="table_report" class="table table-bordered table-hover bg-white">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Bulan</th>
                    <th>Nominal</th>
                    <th>Pemasukan/Pengeluaran</th>
                    {{-- <th>Action</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($bulan as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item }}</td>
                        {{-- <td>{{ $item->id_absen }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->nomor_hp }}</td>
                        <td>{{ $item->tanggal_bergabung }}</td> --}}
                        {{-- <td>
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
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop

@include('admin.function.datatables')
{{-- @include('admin.function.alert-hide') --}}
@include('admin.function.select')
