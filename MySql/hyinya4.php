
<?php
if (isset($_POST['submit'])){
  $login = $_POST['login'];
  $password = $_POST['password'];
  $token = $_POST['token'];

  $connection = mysqli_connect('localhost', 'root', '', 'user_data');

  $select_query = "SELECT * FROM users WHERE login = '$login' AND password = '$password';";
  $select_query_result = mysqli_query($connection, $select_query);

  if(mysqli_num_rows($select_query_result) > 0){
    echo "Этот аккаунт уже существует, придумайте другой логин";
  }else {

    if($login == "" OR $password == "") {
      echo "Поля не должны быть пустыми!"; 
    }else{
      
      $query = "INSERT INTO users (login, password) VALUES ('$login', '$password')";
      session_start();
      $_SESSION['logined'] = $login;
      if (mysqli_query($connection, $query)) {
        echo "New record created successfully";
      }
      header("location: hyinya3.php");
    }

    
  }
}

?>


<html>
<head>
  <title>Регистрация</title>
</head>
<body>
  <h2>Регистрация</h2>
  <form action="hyinya4.php" method="post">
    <div class="form-floating mb-3">
      <input type="text" name="login" class="form-control" id="floatingInput" placeholder="Введите логин">
      <label for="floatingInput">Введите логин</label>
    </div>
    <div class="form-floating">
      <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>
    <input type="submit" name="submit" value="Зарегистрироваться">
    <!--**** Кнопочка (type="submit") отправляет данные на страничку save_user.php ***** --> 
  </p></form>
</body>
</html>



