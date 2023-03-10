@extends('layouts.master')
@section('title')
    Pengeluaran
@stop
@section('content')
    @include('admin.pengeluaran.card')
    <div class="card p-3">
        @role('admin')
            <button type="button" class="btn btn-primary btn-sm d-block my-2 ml-auto" data-toggle="modal"
                data-target="#createPengeluaran">
                Masukkan Pengeluaran
            </button>
            @include('admin.pengeluaran.create')
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
        <table id="table-excel" class="table table-bordered table-hover bg-white">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Nominal Bayar</th>
                    <th>Bukti</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($items as $item)
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
                @endforeach --}}
            </tbody>
        </table>
    </div>
@stop

@include('admin.function.datatables')
@include('admin.function.alert-hide')
@include('admin.function.rupiah')
