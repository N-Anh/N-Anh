<?php 
    include './database.php';
    session_start();
    function login($connection, $name, $pass) {
        $sql = "SELECT * FROM employees WHERE employee_name = ?";
        $stmt = $connection->prepare($sql);
        $stmt->execute([$name]);
        $user = $stmt->fetch();
        if($user && $pass === $user['password']) { 
            $_SESSION['user_id'] = $user['employee_id'];
            return true;
        }
        else {
            return false;
        }
    };

    if(isset($_POST['login'])) {
        $name = $_POST['name'];
        $pass = $_POST['pass'];
        
        if(empty($name)) {
            $name_error = "Tên người dùng là bắt buộc";
        }
        if(empty($pass)) {
            $pass_error = "Mật khẩu là bắt buộc";
        }

        if(empty($name_error) && empty($pass_error)) {
            if(login($connection, $name, $pass)) {
                header('location: my_store.php');
                exit();
            }
            else {
                $error = "Tên người dùng hoặc mật khẩu không đúng";
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <form class="col-6 bg-primary-subtle px-3 py-3 mt-5" action="login.php" method="POST">
                <h1 class="text-center">Đăng nhập</h1>    
                <div class="form-group">
                    <label for="name" >Tên: </label>
                    <input class="form-control" type="text" name="name" placeholder="Tên">
                    <p class="text-danger"><?php if(isset($name_error)) { echo $name_error; } ?></p>
                </div>
                <div class="form-group">
                    <label for="pass" >Mật khẩu: </label>
                    <input class="form-control " type="password" name="pass" placeholder="Mật khẩu">
                    <p class="text-danger"><?php if(isset($pass_error)) { echo $pass_error; } ?></p>
                </div>
                <button class="mt-3 btn bg-primary"  type="submit" name="login">Đăng nhập</button>
                <p class="mt-3">Bạn chưa có tài khoản? <a href="./register.php">Đăng ký</a></p>
                <p class="text-danger mt-3"><?php if(isset($error)) { echo $error; } ?></p>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
