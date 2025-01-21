@props(['ArticleCount', 'UserCount', 'CommentCount'])

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="path/to/adminlte.js"></script>

<!-- Begin Chart Row -->
<div class="row">
    <!-- Donut Chart -->
    <div class="col-5">
        <div id="pie-chart"></div>
    </div> <!-- /.col -->
    <!-- Cards with Numbers -->
    <div class="col-4">
        <!-- Card for Articles -->
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <h5 class="card-title">Articles</h5>
                <p class="card-text"><strong>{{ $ArticleCount }}</strong></p>
            </div>
        </div>
        <!-- Card for Users -->
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <h5 class="card-title">Users</h5>
                <p class="card-text"><strong>{{ $UserCount }}</strong></p>
            </div>
        </div>
        <!-- Card for Comments -->
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <h5 class="card-title">Comments</h5>
                <p class="card-text"><strong>{{ $CommentCount }}</strong></p>
            </div>
        </div>
    </div> <!-- /.col -->
</div> <!-- /.row -->
<!-- End Chart Row -->

<script>
    const pie_chart_options = {
        series: [700, 50, 400],
        chart: {
            type: "donut",
        },
        labels: ["Articles", "Users", "Comments"],
        dataLabels: {
            enabled: false,
        },
        colors: [
            "#0d6efd",
            "#20c997",
            "#ffc107",
            "#d63384",
            "#6f42c1",
            "#adb5bd",
        ],
    };

    const pie_chart = new ApexCharts(
        document.querySelector("#pie-chart"),
        pie_chart_options
    );
    pie_chart.render();
</script>
