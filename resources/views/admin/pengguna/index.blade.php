@extends('layouts.master')
@section('title')
    Pengguna
@stop
@section('content')
    <div class="card p-2">
        <button type="button" class="btn btn-primary btn-sm d-block my-2 ml-auto" data-toggle="modal"
            data-target="#createPengguna">
            Tambah Pengguna
        </button>
        @include('admin.pengguna.create')
        @include('admin.function.alert')
        <table id="table_pengguna" class="table table-bordered table-hover bg-white">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    {{-- <th>Action</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                            @foreach ($item->roles as $role)
                                <span class="badge badge-primary">{{ $role->name }}</span>
                            @endforeach
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@stop

@include('admin.function.datatables')
@include('admin.function.select')
