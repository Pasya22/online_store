@extends('layouts.app')
@section('title', 'dashboard')

@section('content')
    <div class="contentdsb">
        <div class="Cardbar">
            <canvas id="myChart1"></canvas>
        </div>
        <div class="Cardbar">
            <canvas id="myChart2"></canvas>
        </div>
        <div class="Cardbar">
            <canvas id="myChart3"></canvas>
        </div>
        <div class="Cardbar2">
            <canvas id="myChart4"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ChartData1 = {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1,
                tension: 0.5,
            }]
        };

        const ChartData2 = {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1,
                tension: 0.5,
            }]
        };

        const ChartData3 = {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 13, 15, 12, 13],
                backgroundColor: (context) => {
                    const ctx = context.chart.ctx;
                    const gradient = ctx.createLinearGradient(0, 0, 0, 500);
                    gradient.addColorStop(0, "#f797e1");
                    gradient.addColorStop(1, "#3b71d6");
                    return gradient;
                },
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1,
                tension: 0.5,
            }]
        };

        const ChartData4 = {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes Set 1',
                data: [0, 19, 13, 15, 12, 13],
                backgroundColor: '#f797e1',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 2,
                tension: 0.5,
            }]
        };

        const ChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: (ctx) => `Chart: ${ctx.chart.data.datasets[0].label}`,
                },
            },
            scales: {
                yAxes: [{
                        id: "y-axis-bar",
                        type: "bar",
                        position: "left",
                        ticks: {
                            beginAtZero: true,
                        },
                    },
                    {
                        id: "y-axis-line",
                        type: "linear",
                        position: "right",
                        ticks: {
                            beginAtZero: true,
                        },
                    },
                ],
            },
        };

        var ctx1 = document.getElementById('myChart1').getContext('2d');
        var myChart1 = new Chart(ctx1, {
            type: 'line',
            data: ChartData1,
            options: ChartOptions
        });

        var ctx2 = document.getElementById('myChart2').getContext('2d');
        var myChart2 = new Chart(ctx2, {
            type: 'line',
            data: ChartData2,
            options: ChartOptions
        });

        var ctx3 = document.getElementById('myChart3').getContext('2d');
        var myChart3 = new Chart(ctx3, {
            type: 'line',
            data: ChartData3,
            options: ChartOptions
        });

        var ctx4 = document.getElementById('myChart4').getContext('2d');
        var myChart4 = new Chart(ctx4, {
            type: 'line',
            data: ChartData4,
            options: ChartOptions

        });
    </script>
@endsection
