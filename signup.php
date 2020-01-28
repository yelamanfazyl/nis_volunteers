<?php 
    require $_SERVER["DOCUMENT_ROOT"].'/utils/bd.php';
    $data = $_POST;
    $errors = array();
    if(isset($data['do_signup'])){
        if(empty($data['email'])){
            $errors[] = "Введите e-mail";
        }
        if(empty($data['firstname'])){
            $errors[] = "Введите имя";
        }
        if(empty($data['surname'])){
            $errors[] = "Введите фамилию";
        }
        if(empty($data['password1'])){
            $errors[] = "Введите пароль";
        }
        if(empty($data['password2'])){
            $errors[] = "Введите повтор пароля";
        }
        if($data['password1'] != $data['password2']){
            $errors[] = "Пароли не совпадают";
        }
        $another = R::findOne("users","email = ?",array($data['email']));
        if($another){
            $errors[] = "Пользователь с таким e-mail зарегистрирован";
        }
        if(empty($errors)){
            $user = R::dispense("users");
            $user->email = $data['email'];
            $user->firstname = $data['firstname'];
            $user->surname = $data['surname'];
            $user->password = password_hash($data['password1'],PASSWORD_DEFAULT);
            $user->moderator = false;
            $user->vol_time = 0;
            R::store($user);
            $_SESSION['user_info'] = $user;
            if($_SESSION['user_info']->moderator){   
                header('Location: /dashboards/admin/add_task.php');   
                die(); 
            } else {
                header('Location: /dashboards/user/aims.php');   
                die(); 
            }
        }
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/signup.css">
    
    <link href="/assets/favicon.jpg" rel="icon" type="image/jpeg">
    <title>Регистрация</title>
      <style>
        body{
            background-image: url("/assets/img/bg.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            overflow-x: hidden;
        }
        @media screen and (min-width: 1000px){
            body{
                overflow: hidden;
            }
        }
        .form-group{
            margin: 10px;
        }
      </style>
  </head>
  <body class="vh-100">
    <div class="row h-100 justify-content-center align-items-center signup">
        <form class="col-10 col-md-6 col-lg-4 bg-white py-6" method="post">
            <?php if(!empty($errors)) { ?>
                <div style="color: red; font-size:24px;" class="col-12 text-center">
                    <?php echo array_shift($errors); ?>
                </div>
            <?php 
            }
            ?>
            <div class="form-group">
                <h2 class="text-center text-dark py-3">Регистрация</h2> 
            </div>
            <div class="form-group w-75 mx-auto">
                <label for="formGroupExampleInput">E-mail</label>
                <input name="email" type="email" class="form-control" placeholder="Ваш E-mail" required>
            </div>
            <div class="form-group w-75 mx-auto">
            <label for="formGroupExampleInput">Имя</label>
                <input name="firstname" type="text" class="form-control" placeholder="Ваше имя" required>
            </div>
            <div class="form-group w-75 mx-auto">
            <label for="formGroupExampleInput">Фамилия</label>
                <input name="surname" type="text" class="form-control" placeholder="Ваша фамилия" required>
            </div>
            <div class="form-group w-75 mx-auto">
            <label for="formGroupExampleInput">Пароль</label>
                <input name="password1" type="password" class="form-control" placeholder="Ваш пароль" required>
            </div>
            <div class="form-group w-75 mx-auto">
            <label for="formGroupExampleInput">Повторите пароль</label>
                <input name="password2" type="password" class="form-control" placeholder="Повторите пароль" required>
            </div>
            <div class="form-group pt-4">
                <button class="btn btn-lg btn-block w-50 btn-success mx-auto" type="submit" name="do_signup">Регистрация</button>
            </div>
        </form> 
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>