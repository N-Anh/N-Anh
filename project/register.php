<?php
    include './database.php';
    session_start();

    if(isset($_SESSION['user_id'])) {
        header('location: my-account.php');
        exit();
    }

    $sql_get_stores = "SELECT store_id, store_name FROM stores";
    $stmt_get_stores = $connection->query($sql_get_stores);
    $stores = $stmt_get_stores->fetchAll();

    $name_value = '';
    $employee_id_value = '';
    $phone_value = '';
    $store_value = '';

    if(isset($_POST['register'])) {
        
        $employee_id = trim($_POST['employee_id']);
        $name = trim($_POST['name']);
        $pass = trim($_POST['pass']);
        $confirm_pass = trim($_POST['confirm_pass']);
        $phone = trim($_POST['phone']);
        $selected_store_id = trim($_POST['store']);

        if(empty($employee_id)) {
            $employee_id_error = "Mã nhân viên là bắt buộc";
        }

        if(empty($name)) {
            $name_error = "Tên người dùng là bắt buộc";
        }

        if(empty($pass)) {
            $pass_error = "Mật khẩu là bắt buộc";
        }

        if(empty($confirm_pass)) {
            $confirm_pass_error = "Xác nhận mật khẩu là bắt buộc";
        }

        if(empty($phone)) {
            $phone_error = "Số điện thoại là bắt buộc";
        }

        if(empty($selected_store_id)) {
            $store_error = "Vui lòng chọn cửa hàng";
        }

        if(empty($employee_id_error) && empty($name_error) && empty($pass_error) && empty($confirm_pass_error) && empty($phone_error) && empty($store_error)) {
            if($pass !== $confirm_pass) {
                $error_confirm_pass = "Mật khẩu và xác nhận mật khẩu không khớp";
            } else {
                $sql_check_user = "SELECT * FROM employees WHERE employee_name = ?";
                $stmt_check_user = $connection->prepare($sql_check_user);
                $stmt_check_user->execute([$name]);
                $existing_user = $stmt_check_user->fetch();

                if($existing_user) {
                    $error_name = "Tên người dùng đã tồn tại";
                } else {
                    $sql_insert_user = "INSERT INTO employees (employee_id, employee_name, password, phone, store_id) VALUES (?, ?, ?, ?, ?)";
                    $stmt_insert_user = $connection->prepare($sql_insert_user);
                    $stmt_insert_user->execute([$employee_id, $name, $pass, $phone, $selected_store_id]);
                    header('location: login.php');
                    exit();
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng ký tài khoản</title>
</head>
<body>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <form class="col-6 bg-primary-subtle px-3 py-3 mt-5" action="register.php" method="POST">
                <h1 class="text-center">Đăng ký tài khoản</h1>
                <div class="form-group">
                    <label for="employee_id">Mã nhân viên:</label>
                    <input class="form-control" type="text" name="employee_id" placeholder="Mã nhân viên" value="<?php echo $employee_id_value; ?>">
                    <p class="text-danger"><?php if(isset($employee_id_error)) { echo $employee_id_error; } ?></p>
                </div>
                <div class="form-group">
                    <label for="name">Tên người dùng:</label>
                    <input class="form-control" type="text" name="name" placeholder="Tên người dùng" value="<?php echo $name_value; ?>">
                    <p class="text-danger"><?php if(isset($name_error)) { echo $name_error; } ?></p>
                </div>
                <div class="form-group">
                    <label for="pass">Mật khẩu:</label>
                    <input class="form-control" type="password" name="pass" placeholder="Mật khẩu">
                    <p class="text-danger"><?php if(isset($pass_error)) { echo $pass_error; } ?></p>
                </div>
                <div class="form-group">
                    <label for="confirm_pass">Xác nhận mật khẩu:</label>
                    <input class="form-control" type="password" name="confirm_pass" placeholder="Xác nhận mật khẩu">
                    <p class="text-danger"><?php if(isset($confirm_pass_error)) { echo $confirm_pass_error; } ?></p>
                </div>
                <div class="form-group">
                    <label for="phone">Số điện thoại:</label>
                    <input class="form-control" type="text" name="phone" placeholder="Số điện thoại" value="<?php echo $phone_value; ?>">
                    <p class="text-danger"><?php if(isset($phone_error)) { echo $phone_error; } ?></p>
                </div>
                <div class="form-group">
                    <label for="store">Chọn cửa hàng:</label>
                    <select class="form-control" name="store">
                        <option value="">Chọn cửa hàng</option>
                        <?php foreach($stores as $store): ?>
                            <option value="<?php echo $store['store_id']; ?>" <?php if($store['store_id'] === $store_value) echo "selected"; ?>><?php echo $store['store_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <p class="text-danger"><?php if(isset($store_error)) { echo $store_error; } ?></p>
                </div>
                <button class="btn btn-primary" type="submit" name="register">Đăng ký</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
