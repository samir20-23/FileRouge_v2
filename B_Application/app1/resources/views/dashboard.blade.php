@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="font-weight-bold text-dark">Dashboard</h1>
@stop

@section('content')
    <div class="row" style="display: flex; flex-wrap: wrap; justify-content: space-between; margin-bottom: 20px;">
        <div class="col-md-4 mb-4">
            <div class="small-box bg-info card-custom shadow-lg">
                <div class="inner p-3">
                    <h3 class="display-4 text-white">{{ $totalDocuments }}</h3>
                    <p class="lead text-white">Total Documents</p>
                </div>
                <div class="icon">
                    <i class="fas fa-file fa-3x"></i>
                </div>
                <a href="{{ route('documents.index') }}" class="small-box-footer bg-info text-white">
                    View Documents <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="small-box bg-success card-custom shadow-lg">
                <div class="inner p-3">
                    <h3 class="display-4 text-white">{{ $totalCategories }}</h3>
                    <p class="lead text-white">Total Categories</p>
                </div>
                <div class="icon">
                    <i class="fas fa-list fa-3x"></i>
                </div>
                <a href="{{ route('categories.index') }}" class="small-box-footer bg-success text-white">
                    View Categories <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="small-box bg-warning card-custom shadow-lg">
                <div class="inner p-3">
                    <h3 class="display-4 text-white">{{ $totalUsers }}</h3>
                    <p class="lead text-white">Total Users</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users fa-3x"></i>
                </div>
                <a href="{{ route('categories.index') }}" class="small-box-footer bg-warning text-white">
                    View Users <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <x-adminlte-card title="Documents and Categories" theme="primary" collapsible>
                <canvas id="barChart"></canvas>
            </x-adminlte-card>
        </div>

        <div class="col-md-6 mb-4">
            <x-adminlte-card title="Growth Over Time" theme="secondary" collapsible>
                <canvas id="lineChart"></canvas>
            </x-adminlte-card>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <x-adminlte-card title="Document Distribution" theme="info" collapsible>
                <canvas id="pieChart"></canvas>
            </x-adminlte-card>
        </div>

        <div class="col-md-6 mb-4">
            <x-adminlte-card title="Category Breakdown" theme="success" collapsible>
                <canvas id="doughnutChart"></canvas>
            </x-adminlte-card>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-center">
            <button class="btn btn-dark" id="darkModeToggle">Toggle Dark Mode</button>
        </div>
    </div>
@stop

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var totalDocuments = @json($totalDocuments);
            var totalCategories = @json($totalCategories);
            var totalUsers = @json($totalUsers);

            // Bar Chart
            var ctxBar = document.getElementById('barChart').getContext('2d');
            new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: ['Documents', 'Categories', 'Users'],
                    datasets: [{
                        label: 'Total Counts',
                        data: [totalDocuments, totalCategories, totalUsers],
                        backgroundColor: ['#1E90FF', '#32CD32', '#FFD700'],
                        borderColor: ['#1C86EE', '#28A745', '#FFA500'],
                        borderWidth: 1,
                        hoverBackgroundColor: ['#4682B4', '#28A745', '#FF8C00'],
                        hoverBorderColor: ['#1E3A8A', '#006400', '#FF6347']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        duration: 1000,
                        easing: 'easeInOutCubic'
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Line Chart
            var ctxLine = document.getElementById('lineChart').getContext('2d');
            new Chart(ctxLine, {
                type: 'line',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May'],
                    datasets: [{
                        label: 'Document Growth Over Time',
                        data: [65, 59, 80, 81, 56],
                        borderColor: '#007bff',
                        backgroundColor: 'rgba(0, 123, 255, 0.2)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        duration: 1000,
                        easing: 'easeInOutQuad'
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Pie Chart
            var ctxPie = document.getElementById('pieChart').getContext('2d');
            new Chart(ctxPie, {
                type: 'pie',
                data: {
                    labels: ['Documents Type 1', 'Documents Type 2', 'Documents Type 3'],
                    datasets: [{
                        label: 'Document Distribution',
                        data: [300, 50, 100],
                        backgroundColor: ['#dc3545', '#007bff', '#28a745'],
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        duration: 1200,
                        easing: 'easeInOutExpo'
                    }
                }
            });

            // Doughnut Chart
            var ctxDoughnut = document.getElementById('doughnutChart').getContext('2d');
            new Chart(ctxDoughnut, {
                type: 'doughnut',
                data: {
                    labels: ['Category 1', 'Category 2', 'Category 3'],
                    datasets: [{
                        label: 'Category Breakdown',
                        data: [150, 100, 250],
                        backgroundColor: ['#FFD700', '#28a745', '#1E90FF'],
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        duration: 1200,
                        easing: 'easeInOutExpo'
                    }
                }
            });

            // Dark Mode Toggle
            document.getElementById('darkModeToggle').addEventListener('click', function() {
                document.body.classList.toggle('dark-mode');
                localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
            });

            // Check dark mode state on load
            if (localStorage.getItem('darkMode') === 'true') {
                document.body.classList.add('dark-mode');
            }
        });
    </script>
@endpush
