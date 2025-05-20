<?php
require '../check_admin_login.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
    }
    .menu {
      margin-bottom: 20px;
    }
    .menu a {
      margin-right: 15px;
      text-decoration: none;
      color: #007BFF;
    }
    .menu a:hover {
      text-decoration: underline;
    }
    table {
      border-collapse: collapse;
      width: 100%;
      margin-top: 20px;
    }
    th, td {
      padding: 8px;
      text-align: center;
      border: 1px solid #ddd;
    }
    th {
      background-color: #f4f4f4;
    }
  </style>
</head>
<body>

<h2>Trang quản trị hệ thống</h2>

<?php require '../menu.php'; ?>

<?php
$currentYear = date("Y");
$currentMonth = date("n");
$selectedMonth = $_GET['month'] ?? $currentMonth;
$selectedYear = $_GET['year'] ?? $currentYear;
?>

<form method="GET" id="filter-form">
  <label for="month">Tháng:</label>
  <select name="month" id="month">
    <?php
      $maxMonth = ($selectedYear == $currentYear) ? $currentMonth : 12;
      for ($m = 1; $m <= $maxMonth; $m++): 
    ?>
      <option value="<?= $m ?>" <?= $selectedMonth == $m ? 'selected' : '' ?>>
        Tháng <?= $m ?>
      </option>
    <?php endfor; ?>
  </select>

  <label for="year">Năm:</label>
  <select name="year" id="year">
    <?php for ($y = $currentYear - 5; $y <= $currentYear; $y++): ?>
      <option value="<?= $y ?>" <?= $selectedYear == $y ? 'selected' : '' ?>>
        <?= $y ?>
      </option>
    <?php endfor; ?>
  </select>

  <button type="submit">Lọc</button>
</form>

<!-- Bảng  -->
<table>
  <thead>
    <tr>
      <th>Ngày</th>
      <th>Doanh thu (VNĐ)</th>
    </tr>
  </thead>
  <tbody id="table-body">
    <!-- dữ liệu thống kê sẽ đổ vào đây -->
  </tbody>
</table>

<!-- Biểu đồ -->
<div id="container" style="height: 400px; margin-top: 30px;"></div>

<script>
  function loadChart(month, year) {
    $.ajax({
      url: '../orders/get_revenue.php',
      data: { month, year },
      dataType: 'json',
      success: function(data_chart) {
        const categories = data_chart.map(item => item.ngay);
        const doanhThu = data_chart.map(item => item.doanh_thu);

        Highcharts.chart('container', {
          title: {
            text: `Doanh thu tháng ${month}/${year}`
          },
          xAxis: {
            categories: categories,
            title: { text: 'Ngày' }
          },
          yAxis: {
            title: { text: 'Doanh thu (VNĐ)' }
          },
          tooltip: {
            valueSuffix: ' VNĐ'
          },
          series: [{
            name: 'Doanh thu',
            data: doanhThu
          }]
        });

        let html = '';
        data_chart.forEach(row => {
          html += `<tr><td>${row.ngay}</td><td>${parseInt(row.doanh_thu).toLocaleString()}</td></tr>`;
        });
        $('#table-body').html(html);
      }
    });
  }

  $('#filter-form').on('submit', function(e) {
    e.preventDefault();
    const month = $('#month').val();
    const year = $('#year').val();
    loadChart(month, year);
  });

  // Tải mặc định ban đầu
  $(document).ready(function() {
    loadChart(<?= $selectedMonth ?>, <?= $selectedYear ?>);
  });
</script>

</body>
</html>
