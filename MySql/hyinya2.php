<?php
session_start();
echo $_SESSION['logined'];
if (isset($_POST['submit'])){
  $token = $_POST['token'];

  $connection = mysqli_connect('localhost', 'root', '', 'user_data');

  $query = "SELECT * FROM users WHERE token = '$token';";
  $query_result = mysqli_query($connection, $query);
  if (mysqli_num_rows($query_result)>0){
    header("location:hyinya3.php");;
  }else{
    echo 'ЛОХ';
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

  <title>Hi Pidor2</title>
</head>
<body>
  <form action="hyinya2.php" method="post">
    <div class="form-floating mb-3">
      <input type="text" name="token" class="form-control" id="floatingInput" placeholder="Введите одноразовый код">
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