<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .main-content {
            padding: 20px;
        }
        .widget {
            background-color: white;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .cards {
            display: flex;
            gap: 20px;
        }
        .card {
            background: rgb(247,246,246);
            color: white;
            flex: 1;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .card h2  {
            color: #f82c04;
        }
        .card p  {
            color: #f82c04;
        }
        .card i {
            font-size: 50px;
            margin-bottom: 10px;
            color: #f82c04;
        }
        .chart {
            width: 100%;
            height: 400px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<div class="main-content">
        <h1>Dashboard</h1>
        <div class="cards">
            <div class="card">
                <i class="fas fa-users"></i>
                <h2>Pengguna</h2>
                <p>4</p>
            </div>
            <div class="card">
                <i class="fas fa-chart-line"></i>
                <h2>Sales</h2>
                <p>18</p>
            </div>
            <div class="card">
                <i class="fas fa-dollar-sign"></i>
                <h2>Customer</h2>
                <p>12.345</p>
            </div>
        </div>
        <div class="widget">
            <h2>Penjualan Sales</h2>
            <canvas id="salesChart" class="chart"></canvas>
        </div>
       
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('salesChart').getContext('2d');
        var salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: '2024',
                    data: [1200, 1500, 1700, 2000, 2300, 2500],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
