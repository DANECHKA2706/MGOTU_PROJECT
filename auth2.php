<?php
session_start();
$eCode = $_SESSION['ec'];
echo $_SESSION['logined'];
if (isset($_POST['submit'])){
  $password =$_POST['password'];
  echo $password;
  $login = $_SESSION['logined'];
  $connection = mysqli_connect('localhost', 'root', '', 'user_data');

  $query = "SELECT * FROM users WHERE login = '$login';";
  $query_result = mysqli_query($connection, $query);
  $data_array = mysqli_fetch_array($query_result);
  $token = $data_array['token'];
  if (mysqli_num_rows($query_result)>0){
    $key = $token;
    $pk  = openssl_get_privatekey($key);
    $data = $eCode;
    if (!openssl_private_decrypt(base64_decode($data), $decrypted, $pk)) {
      die('Failed to decrypt data');
    }
    echo "Decrypted value: ". $decrypted;
    ////
    if ($password == $decrypted){
      header("location:main.php");;
      echo "OK";
    }else{
      echo "Вы ввели неправильный ключ!";
    }

  }else{
    echo ' Аккаунт не найден!';
  }
}


?>


<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

  <title>Проверка входа</title>
</head>
<body>
  <form action="auth2.php" method="post">
    <div class="form-floating mb-3">
      <input type="text" name="password" class="form-control" id="floatingInput" placeholder="Введите одноразовый код">
      <label for="floatingInput">Введите одноразовый код</label>
    </div>
    <div class="form-floating mb-3">
      <button type="submit" name="submit">Отправить</button>
    </div>
  </form>






  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</body>
</html>