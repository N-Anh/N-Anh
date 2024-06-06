<?php
include './database.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$sql_get_store = "SELECT store_id FROM employees WHERE employee_id = ?";
$stmt_get_store = $connection->prepare($sql_get_store);
$stmt_get_store->execute([$user_id]);
$employee_store = $stmt_get_store->fetch();

if (!$employee_store) {
    echo "Không tìm thấy thông tin cửa hàng của nhân viên.";
    exit();
}

$store_id = $employee_store['store_id'];

$product_id_value = '';
$product_name_value = '';
$list_price_value = '';
$sale_price_value = '';
$des_value = '';
$quantity_value = '';

if (isset($_POST['add_product'])) {
    $product_id = trim($_POST['product_id']);
    $product_name = trim($_POST['product_name']);
    $list_price = floatval($_POST['list_price']);
    $sale_price = floatval($_POST['sale_price']);
    $des = trim($_POST['des']);
    $quantity = intval($_POST['quantity']);

    $target_dir = "uploads/";
    $target_file = $target_dir . time() . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (!empty($_FILES["image"]["tmp_name"]) && getimagesize($_FILES["image"]["tmp_name"])) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $sql_insert_product = "INSERT INTO products (product_id, store_id, product_name, list_price, sale_price, image, description, quantity) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt_insert_product = $connection->prepare($sql_insert_product);
            $stmt_insert_product->execute([$product_id, $store_id, $product_name, $list_price, $sale_price, $target_file, $des, $quantity]);
            header('location: product_list.php');
            exit();
        } else {
            echo "Có lỗi xảy ra khi tải lên tệp ảnh của bạn.";
        }
    } else {
        echo "Vui lòng chọn một tập tin ảnh hợp lệ.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Thêm sản phẩm</title>
</head>
<body>
    <div class="container">
        <h2 class="row mt-3">Thêm Sản Phẩm</h2>
        <div class="row d-flex justify-content-center">
            <form class="col-6 px-3 py-3 bg-primary-subtle" action="add_product.php" method="POST" enctype="multipart/form-data">
                <label for="product_id">Mã Sản Phẩm:</label><br>
                <input class="form-control mt-2" type="text" id="product_id" name="product_id" value="<?php echo $product_id_value; ?>"><br>
                
                <input type="hidden" id="store_id" name="store_id" value="<?php echo $store_id; ?>">
        
                <label for="product_name">Tên Sản Phẩm:</label><br>
                <input class="form-control mt-2" type="text" id="product_name" name="product_name" value="<?php echo $product_name_value; ?>"><br>
                
                <label for="list_price">Giá Niêm Yết:</label><br>
                <input class="form-control mt-2" type="text" id="list_price" name="list_price" value="<?php echo $list_price_value; ?>"><br>
        
                <label for="sale_price">Giá Bán:</label><br>
                <input class="form-control mt-2" type="text" id="sale_price" name="sale_price" value="<?php echo $sale_price_value; ?>"><br>
        
                <label for="image">Hình Ảnh:</label><br>
                <input class="form-control mt-2" type="file" id="image" name="image"><br>
        
                <label for="des">Mô Tả:</label><br>
                <textarea class="form-control mt-2" id="des" name="des"><?php echo $des_value; ?></textarea><br>
                
                <label for="quantity">Số Lượng:</label><br>
                <input class="form-control mt-2" type="text" id="quantity" name="quantity" value="<?php echo $quantity_value; ?>"><br>
                <button class="btn bg-primary" type="submit" name="add_product">Thêm sản phẩm</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
