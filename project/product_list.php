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


$store_id = $employee_store['store_id'];

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

$sql_count = "SELECT COUNT(*) FROM products WHERE store_id = ?";
$stmt_count = $connection->prepare($sql_count);
$stmt_count->execute([$store_id]);
$total_products = $stmt_count->fetchColumn();

$total_pages = ceil($total_products / $limit);

$sql_products = "SELECT * FROM products WHERE store_id = :store_id LIMIT :limit OFFSET :offset";
$stmt_products = $connection->prepare($sql_products);
$stmt_products->bindParam(':store_id', $store_id, PDO::PARAM_STR);
$stmt_products->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt_products->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt_products->execute();
$products = $stmt_products->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Danh sách sản phẩm</title>
    <style>

    </style>
</head>
<body>
    <div class="container">
        <div class="row  mt-5 ">
            <h1 class="col-9 text-start">Danh sách sản phẩm</h1>
            <button class="col-2 btn bg-primary"><a class="nav-link" href="./add_product.php">Thêm sản phẩm</a></button>
        </div>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>Mã sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá niêm yết</th>
                    <th>Giá bán</th>
                    <th>Mô tả</th>
                    <th>Hình ảnh</th>
                    <th>Trạng thái</th>
                    <th>Số lượng</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr class="product-row">
                        <td><?php echo htmlspecialchars($product['product_id']); ?></td>
                        <td><a href="product_detail.php?product_id=<?php echo htmlspecialchars($product['product_id']); ?>"><?php echo htmlspecialchars($product['product_name']); ?></a></td>
                        <td><?php echo htmlspecialchars($product['list_price']); ?></td>
                        <td><?php echo htmlspecialchars($product['sale_price']); ?></td>
                        <td><?php echo htmlspecialchars($product['description']); ?></td>
                        <td><img src="<?php echo htmlspecialchars($product['image']); ?>" width="100" /></td>
                        <td><?php echo $product['status'] ? 'Đang bán' : 'Dừng bán'; ?></td>
                        <td><?php echo htmlspecialchars($product['quantity']); ?></td>
                        <td>
                            <div class="overlay justify-content-end">
                                <button class="btn btn-warning" onclick="window.location.href='edit_product.php?product_id=<?php echo $product['product_id']; ?>'">Sửa</button>
                                <button class="btn btn-danger" onclick="if(confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) window.location.href='delete_product.php?product_id=<?php echo $product['product_id']; ?>'">Xóa</button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php if($page > 1): ?>
                    <li class="page-item"><a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a></li>
                <?php endif; ?>
                <?php for($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php if($i == $page) echo 'active'; ?>"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php endfor; ?>
                <?php if($page < $total_pages): ?>
                    <li class="page-item"><a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
