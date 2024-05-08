<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        .login-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .login-container:hover {
            transform: translateY(-5px);
        }

        .login-container input[type="email"],
        .login-container input[type="password"] {
            width: calc(100% - 40px);
            padding: 12px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            transition: border-color 0.3s;
        }

        .login-container input[type="email"]:focus,
        .login-container input[type="password"]:focus {
            border-color: #4CAF50;
        }

        .login-container button[type="submit"] {
            width: calc(100% - 40px);
            padding: 12px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .login-container button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<?php
if(isset($_POST["submit"])){
    require_once "./admin/dbkoneksi.php";

    $user = $dbh->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $user->execute([
        $_POST["email"], $_POST["password"],
    ]);
    // var_dump($user->fetch());
    $count = $user->rowCount(); //untuk memastikan user tersedia atau tidak

    if($count > 0){
        session_start();

        $_SESSION["user"] = $user->fetch();
        header("location:./admin/index.php");
    }else { //jika login gagal
        header("location:login.php");
    }
}
?>

<body>
    <div class="login-container">
        <form action="" method="POST">
            <div>
                <label for="">Email</label>
                <input type="email" name="email" required>
            </div>
            <br>
            <div>
                <label for="">Password</label>
                <input type="password" name="password" required>
            </div>
            <br>
            <div>
                <button type="submit" name="submit">Login</button>
            </div>
        </form>
    </div>
</body>
</html>