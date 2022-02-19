@extends('backend.layouts.master')
@section('title','Tổng quan')
@section('css')
    <script src="{{ asset('backend/assets/vendors/apexcharts/apexcharts.js') }}"></script>

@endsection
@section('js')
    <script src="{{ asset('backend/assets/vendors/apexcharts/apexcharts.js') }}"></script>
    <script>
        var optionsProfileVisit = {
            annotations: {
                position: 'back'
            },
            dataLabels: {
                enabled:false
            },
            chart: {
                type: 'bar',
                height: 300
            },
            fill: {
                opacity:1
            },
            plotOptions: {
            },
            series: [{
                name: 'sales',
                data: [0,0,10,0,0,5,10,0,0,0,0,12]
            }],
            colors: '#435ebe',
            xaxis: {
                categories: ["Jan","Feb","Mar","Apr","May","Jun","Jul", "Aug","Sep","Oct","Nov","Dec"],
            },
        }
        let optionsVisitorsProfile  = {
            series: [70, 30],
            labels: ['Male', 'Female'],
            colors: ['#435ebe','#55c6e8'],
            chart: {
                type: 'donut',
                width: '100%',
                height:'350px'
            },
            legend: {
                position: 'bottom'
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '30%'
                    }
                }
            }
        }




        var chartProfileVisit = new ApexCharts(document.querySelector("#chart-profile-visit"), optionsProfileVisit);
        // var chartVisitorsProfile = new ApexCharts(document.getElementById('chart-visitors-profile'), optionsVisitorsProfile)
        // var chartEurope = new ApexCharts(document.querySelector("#chart-europe"), optionsEurope);
        // var chartAmerica = new ApexCharts(document.querySelector("#chart-america"), optionsAmerica);
        // var chartIndonesia = new ApexCharts(document.querySelector("#chart-indonesia"), optionsIndonesia);

        // chartIndonesia.render();
        // chartAmerica.render();
        // chartEurope.render();
        chartProfileVisit.render();
        // chartVisitorsProfile.render()
    </script>
@endsection
@section('content')
    @include('backend.partials.page-heading',['namepage'=>'Tổng quan'])
    <div class="container">
        <div class="row">
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon purple">
                                    <i class="fas fa-eye"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Số lượt xem</h6>
                                <h6 class="font-extrabold mb-0">112.000</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon blue">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Số lượt theo dõi</h6>
                                <h6 class="font-extrabold mb-0">183.000</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon green">
                                    <i class="fas fa-shopping-bag"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Số lượt mua</h6>
                                <h6 class="font-extrabold mb-0">50</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon red">
                                    <i class="fas fa-arrow-alt-circle-right"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Số lượt truy cập</h6>
                                <h6 class="font-extrabold mb-0">112</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Số người truy cập</h4>
                    </div>
                    <div class="card-body">
                        <div id="chart-profile-visit"></div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
