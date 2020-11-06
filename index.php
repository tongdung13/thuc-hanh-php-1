<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; chatset=utf-8" />
<head>
    <title>Lọc Danh Sách Khách Hàng</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        img {
            width: 60px;
            height: 60px;
        }
    </style>
<body>
<form method="post">
    Từ: <input id="form" type="text" name="from" placeholder="yyyy/mm/dd"/>
    Đến: <input id="to" type="text" name="to" placeholder="yyyy/mm/dd" />
    <input type="submit" id="submit" value="Lọc"/>
</form>
<?php
$customer_list = array(
    "0" => array("name" => "Tống Văn Dũng",
        "day_of_birth" => "1989/0613",
        "address" => "Thanh Hóa",
        "image" => "image/image1.jpg" ),
    "1" => array("name" => "Tống Thị Vân Anh",
        "day_of_birth" => "2011/08/11",
        "address" => "Thanh Hóa"),
    "2" => array("name" => "Tống Thị Anh Thơ",
        "day_of_birth" => "2014/11/09",
        "address" => "Thanh Hóa")
);
function searchByDate($customers, $from_date, $to_date) {
    if (empty($from_date) && empty($to_date)) {
        return $customers;
    }
    $filetered_customers = [];
    foreach ($customers as $customer) {
        if (!empty($from_date) && (strtotime($customer['day_of_birth']) < strtotime($from_date)))
            continue;
        if (!empty($to_date) && (strtotime($customer['day_of_birth']) < strtotime($to_date)))
            continue;
        $filetered_customers[] = $customer;
    }
    return $filetered_customers;

}
$from_date = NULL;
$to_date = NULL;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $from_date = $_POST["from"];
    $to_date = $_POST["to"];
}
$filetered_customers = searchByDate($customer_list,$from_date, $to_date);
?>
<table border="0">
    <caption><h2>Danh Sách Khách Hàng</h2></caption>
    <tr>
        <th>STT</th>
        <th>Tên</th>
        <th>Ngày Sinh</th>
        <th>Địa Chỉ</th>
        <th>Ảnh</th>
    </tr>
    <?php if (count($filetered_customers) === 0): ?>
    <tr>
        <td colspan="5" class="message">không tìm thấy khách hàng nào</td>
    </tr>
    <?php endif ?>

    <?php foreach ($filetered_customers as $index => $customer):  ?>
    <tr>
        <td><?php echo $index + 1; ?></td>
        <td><?php echo $customer['name']; ?></td>
        <td><?php echo $customer['day_of_birth']; ?></td>
        <td><?php echo $customer['address']; ?></td>
        <td><div class="profile"><img src="<?php echo $customer['image'] ;  ?>"></div> </td>
    </tr>
    <?php endforeach; ?>

</table>
</body>
</head>
</html>
