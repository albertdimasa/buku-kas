@extends('layouts.master')
@section('title')
    Laporan
@stop
@section('content')
    <div class="card p-2">
        <div class="row py-3">
            <div class="col-md-3 mr-auto">
                <select class="form-control select2-normal" id="type_report" name="type">
                    <option value="pemasukan" @if ($type == 'pemasukan') selected @endif>Pemasukan</option>
                    <option value="pengeluaran" @if ($type == 'pengeluaran') selected @endif>Pengeluaran</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-control select2-normal" id="filter_report" name="tahun">
                    <option value="2022" @if ($tahun == '2022') selected @endif>2022</option>
                    <option value="2023" @if ($tahun == '2023') selected @endif>2023</option>
                </select>
            </div>
        </div>
        <table id="table_rep" class="table table-bordered table-hover bg-white">
            <thead>
                <tr>
                    <th width="30%">Bulan</th>
                    <th>Nominal</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

@stop

@include('admin.function.datatables')
@include('admin.function.select')
