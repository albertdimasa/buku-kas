@extends('layouts.master')

@section('title')
    Dashboard
@stop

@section('content')
    {{-- Elemen 1 --}}
    <div class="row">
        <div class="col-lg-4">
            <div class="info-box bg-gradient-warning">
                <span class="info-box-icon"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pekerja</span>
                    <span class="info-box-number">150</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="info-box bg-gradient-success">
                <span class="info-box-icon"><i class="fas fa-money-bill-wave"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Kas Bulan Ini</span>
                    <span class="info-box-number">Rp30.000</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="info-box bg-gradient-danger">
                <span class="info-box-icon"><i class="fas fa-exclamation"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Belum Membayar</span>
                    <span class="info-box-number">Rp30.000</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Elemen 2 --}}
    <div class="card card-indigo">
        <div class="card-header">
            <h3 class="card-title">Bar Chart</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="chart">
                <canvas id="barChart"
                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
@stop

@push('js')
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>

    <script>
        $(function() {

            var areaChartData = {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'Agustus',
                    'September'
                ],
                datasets: [{
                        label: 'Pemasukan',
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: [28, 48, 40, 19, 86, 27, 90, 30, 20]
                    },
                    {
                        label: 'Pengeluaran',
                        backgroundColor: 'rgba(210, 214, 222, 1)',
                        borderColor: 'rgba(210, 214, 222, 1)',
                        pointRadius: false,
                        pointColor: 'rgba(210, 214, 222, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data: [65, 59, 80, 81, 56, 55, 40, 120, 190]
                    },
                ]
            }

            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = $.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            var temp1 = areaChartData.datasets[1]
            barChartData.datasets[0] = temp1
            barChartData.datasets[1] = temp0

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false
            }

            new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })
        })
    </script>
@endpush
