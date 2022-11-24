<?php


if (isset($_POST['submit'])){
  $login = $_POST['login'];
  $password = $_POST['password'];

  $connection = mysqli_connect('localhost', 'root', '', 'user_data');

  $select_query = "SELECT * FROM users WHERE login = '$login';";
  $select_query_result = mysqli_query($connection, $select_query);

  if(mysqli_num_rows($select_query_result) > 0){
    echo "Этот аккаунт уже существует, придумайте другой логин";
  }else {
    ///////
    if (mb_strlen($password) < 8) {
        echo "Password too short!";
    }
    elseif (!preg_match("#[0-9]+#", $password)) {
        echo "Password must include at least one number!";
    }
    elseif (!preg_match("#[a-zA-Z]+#", $password)) {
        echo "Password must include at least one letter!";
    }
    elseif($login == "" OR $password == "") {
      echo "Поля не должны быть пустыми!"; 
    }else{

      $query = "INSERT INTO users (login, password) VALUES ('$login', '$password')";
      session_start();
      $_SESSION['logined'] = $login;
      if (mysqli_query($connection, $query)) {
        echo "New record created successfully";
      }
      ////////////
      $configargs = array(
        "config" => "D:/xampp/php/extras/openssl/openssl.cnf",
        'private_key_bits'=> 1024,
        'private_key_type' => OPENSSL_KEYTYPE_RSA,
      );

      $res = openssl_pkey_new($configargs);
      openssl_pkey_export($res, $privKey,NULL,$configargs);

      $connection = mysqli_connect('localhost', 'root', '', 'user_data');
      $select_query = "SELECT * FROM users WHERE token = '$privKey';";
      $select_query_result = mysqli_query($connection, $select_query);
      if(mysqli_num_rows($select_query_result) > 0){
        echo "Ключ уже создан";
      }else {
        echo $login;
        $query = "UPDATE users SET token = '$privKey' WHERE login = '$login';" ;
        if ($connection->query($query) === TRUE) {
          echo "Record updated successfully";
        } else {
          echo "Error updating record: " . $connection->error;
        }
      }
      ////////////
      header("location:auth.php");
    }

    
  }
}

?>


<html lang="en">

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<head>
  <title>Регистрация</title>
</head>
<body>
  <h2>Регистрация</h2>
  <form action="reg.php" method="post">
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



