@extends('layouts/master')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" @endpush
    @section('title', 'Dashboard')
@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Dashboard /</span>
    </h4>

    <div class="row">
        <div class="col-lg-8 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Welcome {{ auth()->user()->name }}! 🎉</h5>
                            <p class="mb-4">
                                You have Different Products in your store.
                            </p>

                            <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-primary">View Products</a>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140"
                                alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg4 col-md-4 order-1">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('assets/img/icons/unicons/chart-success.png') }}" alt="chart success"
                                        class="rounded">
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Product</span>
                            <h3 class="card-title mb-2">
                                @if ($countProduct > 0)
                                    {{ $countProduct }}
                                @else
                                    0
                                @endif
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
            <div class="card">
                <div class="row row-bordered g-0">
                    <div class="col-md-12">
                        <div class="card-header">
                           <h2> Product Based on Unity Price</h2>
                        </div>
                        <div class="card-body">
                            <div id="chart-unity-price"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
    @push('scripts') <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <script>
        var options = {
            series: [{
                name: 'Products',
                data: getArrayofData(Object.values(@json($dataCharts)))
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            },
            yaxis: {
                title: {
                    text: 'FRW'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "" + val + " FRW"
                    }
                }
            }
        };

        function getArrayofData(data) {
            var array = [];
            for (var i = 0; i < data.length; i++) {
                var values = Object.values(data[i]);
                array = array.concat(values.map(Number));
            }

            return array;
        }

        var chart = new ApexCharts(document.querySelector("#chart-unity-price"), options);
        chart.render();
    </script>
@endpush
