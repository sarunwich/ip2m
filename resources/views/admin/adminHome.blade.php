@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        You are a Admin User.
                        {{-- @dd($productData); --}}
                        <canvas id="myChart" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <!-- Include Chart.js datalabels plugin -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0"></script>
    <script>
        // Prepare data for Chart.js
        var productData = {!! json_encode($productData) !!};
        var offerbuyData = {!! json_encode($offerbuyData) !!};
        var groups = {!! json_encode($groups->pluck('group_name')) !!};
        var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
            "November", "December"
        ];

        var groupColors = [];
        for (var i = 0; i < groups.length; i++) {
            var randomColor = 'rgba(' + Math.floor(Math.random() * 256) + ', ' + Math.floor(Math.random() * 256) + ', ' +
                Math.floor(Math.random() * 256) + ', 20)';
            groupColors.push(randomColor);
        }
        // Initialize dataset
        var datasets = [];

        // Prepare datasets for Chart.js
        groups.forEach(function(group, index) {
            var productCounts = [];
            var offerbuyCounts = [];

            // Populate counts for each month
            months.forEach(function(month, monthIndex) {
                var productCount = productData.find(item => item.month === (monthIndex + 1) && item
                    .group_id === index + 1);
                var offerbuyCount = offerbuyData.find(item => item.month === (monthIndex + 1) && item
                    .group_id === index + 1);

                productCounts.push(productCount ? productCount.count : 0);
                offerbuyCounts.push(offerbuyCount ? offerbuyCount.offerCount : 0);
            });

            // Add dataset for each group
            datasets.push({
                label: group,
                data: productCounts,
                backgroundColor: groupColors[index], // Example color
                stack: 'Stack 1'

            });

            datasets.push({
                label: group + ' Offers',
                data: offerbuyCounts,
                backgroundColor: groupColors[index], // Example color
                stack: 'Stack 2'

            });
        });



        // Create chart
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: datasets
                },
                options: {
                    scales: {
                        x: {
                            stacked: true
                        },
                        y: {
                            stacked: true,
                            beginAtZero: true

                        },

                    },


                },
                plugins: [ChartDataLabels],
                //adminHome.blade.php
                options: {
                    plugins: {
                        // Change options for ALL labels of THIS CHART
                        datalabels: {
                            color: '#FDFEFE',
                            formatter: function(value, context) {
                                return value !== 0 ? value : null;
                            },


                        },
                        ///adminHome.blade.php

                        //
                    }
                }

            },

            //
        );
    </script>
@endpush
