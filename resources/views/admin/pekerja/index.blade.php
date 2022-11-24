@extends('layouts.master')
@section('title')
    Pekerja
@stop
@section('content')
    <div class="card p-2">
        <button class="btn btn-primary btn-sm d-block my-2 mr-auto">Tambah Pekerja</button>
        <table id="example2" class="table table-bordered table-hover bg-white">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Nomor Hp</th>
                    <th>Tanggal Bergabung</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Budi</td>
                    <td>085745974148</td>
                    <td>21 Maret 2022</td>
                    <td>
                        <button class="btn btn-sm btn-primary">Edit</button>
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Ani</td>
                    <td>085742974142</td>
                    <td>22 Agustus 2022</td>
                    <td>
                        <button class="btn btn-sm btn-primary">Edit</button>
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@stop

@push('js')
    @include('admin.function.datatables')
    <script>
        $(function() {
            $('#example2').DataTable({
                // "paging": true,
                // "lengthChange": false,
                // "searching": false,
                // "ordering": true,
                // "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        })
    </script>
@endpush
