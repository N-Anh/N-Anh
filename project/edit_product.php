<?php
include './database.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
    exit();
}

$product_id = $_GET['product_id'];
$sql_get_product = "SELECT * FROM products WHERE product_id = ?";
$stmt_get_product = $connection->prepare($sql_get_product);
$stmt_get_product->execute([$product_id]);
$product = $stmt_get_product->fetch();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'];
    $list_price = $_POST['list_price'];
    $sale_price = $_POST['sale_price'];
    $description = $_POST['description'];
    $status = $_POST['status'] == '1' ? 1 : 0; 
    $quantity = $_POST['quantity'];

    if ($_FILES['image']['size'] > 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . time() . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $sql_update_image = "UPDATE products SET image = ? WHERE product_id = ?";
            $stmt_update_image = $connection->prepare($sql_update_image);
            $stmt_update_image->execute([$target_file, $product_id]);
        } else {
            echo "Có lỗi xảy ra khi tải lên ảnh.";
        }
    }

    $sql_update_product = "UPDATE products SET product_name = ?, list_price = ?, sale_price = ?, description = ?, status = ?, quantity = ? WHERE product_id = ?";
    $stmt_update_product = $connection->prepare($sql_update_product);
    $stmt_update_product->execute([$product_name, $list_price, $sale_price, $description, $status, $quantity, $product_id]);

    header('Location: product_list.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Chỉnh Sửa Sản Phẩm</title>
</head>
<body>
    <div class="container">
        <h2 class="row mt-3">Chỉnh Sửa Sản Phẩm</h2>
        <div class="row d-flex justify-content-center">
            <form class="col-6 px-3 py-3 bg-primary-subtle" action="" method="POST" enctype="multipart/form-data">
                <label for="product_name">Tên Sản Phẩm:</label><br>
                <input class="form-control mt-2" type="text" id="product_name" name="product_name" value="<?php echo $product['product_name']; ?>"><br>

                <label for="list_price">Giá Niêm Yết:</label><br>
                <input class="form-control mt-2" type="text" id="list_price" name="list_price" value="<?php echo $product['list_price']; ?>"><br>

                <label for="sale_price">Giá Bán:</label><br>
                <input class="form-control mt-2" type="text" id="sale_price" name="sale_price" value="<?php echo $product['sale_price']; ?>"><br>


                <label for="description">Mô Tả:</label><br>
                <textarea class="form-control mt-2" id="description" name="description"><?php echo $product['description']; ?></textarea><br>
                
                <label for="status">Trạng Thái:</label><br>
                <select class="form-control mt-2" id="status" name="status">
                    <option value="1" <?php if ($product['status'] == 1) echo 'selected'; ?>>Đang bán</option>
                    <option value="0" <?php if ($product['status'] == 0) echo 'selected'; ?>>Dừng bán</option>
                </select><br>

                <label for="quantity">Số Lượng:</label><br>
                <input class="form-control mt-2" type="text" id="quantity" name="quantity" value="<?php echo $product['quantity']; ?>"><br>
                <div class="row justify-content-end mx-2">
                    <button class="btn bg-primary col-3" type="submit">Lưu Thay Đổi</button>
                    <button class="btn btn-danger col-3 ms-3"><a class="nav-link" href="./product_list.php">Hủy</a></button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
