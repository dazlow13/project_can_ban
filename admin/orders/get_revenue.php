<?php
require '../check_admin_login.php';
require '../connect.php';

header('Content-Type: application/json');

$currentYear = date("Y");
$selectedMonth = $_GET['month'] ?? date('n');
$selectedYear = $_GET['year'] ?? $currentYear;

$sql = "SELECT 
    DATE_FORMAT(create_at, '%d-%m') as ngay, 
    SUM(total_price) as doanh_thu 
FROM orders 
WHERE MONTH(create_at) = $selectedMonth AND YEAR(create_at) = $selectedYear
GROUP BY DATE(create_at)
ORDER BY DATE(create_at) ASC";

$result = mysqli_query($connect, $sql);

$data_chart = [];
while ($row = mysqli_fetch_array($result)) {
    $data_chart[] = [
        'ngay' => $row['ngay'],
        'doanh_thu' => (int)$row['doanh_thu']
    ];
}

echo json_encode($data_chart);
