<?php 
    error_reporting(0);
    $members = array();
    $errors = array();
    require $_SERVER["DOCUMENT_ROOT"].'/utils/bd.php';
    if($_SESSION['user_info']->moderator){
      $data = $_POST;
      if(isset($data['add_task'])){
        if(empty($data['title'])){
          $errors[] = "Введите название";
        }
        if(empty($data['desc'])){
          $errors[] = "Введите описание";
        }
        if(empty($data['quantity'])){
          $errors[] = "Введите количество участников";
        }
        if(empty($data['time'])){
          $errors[] = "Введите время";
        }
        if(empty($errors)){
          $task = R::dispense("tasks");
          $task->title = $data['title'];
          $task->desc = $data['desc'];
          $task->quantity = $data['quantity'];
          $task->time = $data['time'];
          $task->vol_time = $data['vol_time'];
          $task->created_by = $_SESSION['user_info']->id;
          $task->completed = false;
          R::store($task);
          $success[] = "Успешно добавлено";
        }
      }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
  <title>
    Панель управления | Волонтеры
  </title>

  <!-- Favicon -->
  <link href="/assets/favicon.jpg" rel="icon" type="image/jpeg">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <!-- CSS Files -->
  <link href="/assets/css/argon-dashboard.css?v=1.1.0" rel="stylesheet" />

  <link rel="stylesheet" href="/assets/css/styles.css">

</head>
<body>
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Brand -->
      <a class="navbar-brand pt-0" href="/dashboards/admin/add_task.php">
        <div class="d-flex flex-row justify-content-center align-items-center">
            <img src="/assets/favicon.jpg" class="img-fluid nis-brand" alt="">
            <h1 class="">Volunteers</h1>
        </div>
      </a>

      <!-- User -->
      <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo (!isset($_SESSION['user_info']))? 'user' : $_SESSION['user_info']->firstname; ?>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class="dropdown-divider"></div>
            <a href="/logout.php" class="dropdown-item">
              <i class="ni ni-user-run"></i>
              <span>Выйти</span>
            </a>
          </div>
        </li>
      </ul>
      
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
                <div class="row justify-content-center align-items-center">
                    <img src="/assets/favicon.jpg" class="img-fluid ">
                    <h1 class="ml-2">Volunteers</h1>
                </div>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>

        <!-- Navigation -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="add_task.php">
              <i class="fas fa-plus text-success"></i> Добавить задание
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="see_tasks.php">
              <i class="fas fa-list-ul text-success"></i> Просмотреть активные задания
            </a>
          </li> 
          <li class="nav-item">
            <a class="nav-link" href="history.php">
              <i class="fas fa-list-ul text-warning"></i> История заданий
            </a>
          </li> 
          <li class="nav-item">
            <a class="nav-link" href="../user/aims.php">
              <i class="fas fa-list-ul text-info"></i> Мои задания
            </a>
          </li> 
          <li class="nav-item">
            <a class="nav-link" href="../user/get_tasks.php">
              <i class="fas fa-plus text-success"></i> Получить задание
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/index.php">
              <i class="fas fa-home text-info"></i> Вернуться на главную
            </a>
          </li>         
        </ul>

      </div>

    </div>
  </nav>

  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="/dashboards/admin/add_task.php">Панель управления </a>
        
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold"><?php echo (!isset($_SESSION['user_info']))? 'user' : $_SESSION['user_info']->firstname . " " . $_SESSION['user_info']->surname; ?></span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class="dropdown-divider"></div>
              <a href="/logout.php" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Выйти</span>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <!-- End Navbar -->

    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      
    </div>
    <div class="container-fluid mt--9">   
        
      <div class="row">
        <div class="col-xl-12 mb-5 mb-xl-0">
          <div class="card shadow py-5">
            <!-- Display errors -->
            <?php 
                if(!empty($errors)){ ?>
                    <div class="col-12 bg-white py-1 mb-5">
                        <h2 class="text-center text-danger">
                            <?php  
                              echo array_shift($errors);
                            ?>
                        </h2>
                    </div>
                <?php }
            ?>
            <h1 class="text-center">Панель управления</h1>
            <div class="col-12 mx-auto py-5 mt-3">
              <?php if(!empty($success)) { ?>
                <div style="color: green; font-size:24px; background-color: white;" class="col-12 text-center">
                    <?php echo array_shift($success); ?>
                </div>
              <?php 
                }
              ?>
              <form class="col-12" style="padding-top:0.21em" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                  <div class="form-group">
                    <h2 class="text-center">Добавить задание</h2> 
                  </div>
                  <div class="form-group w-75 mx-auto">
                    <label for="formGroupExampleInput">Название</label>
                    <input name="title" type="text" class="form-control" placeholder="Тема">
                  </div>
                  <div class="form-group w-75 mx-auto">
                    <label for="formGroupExampleInput">Описание</label>
                    <textarea name="desc" id="desc" cols="30" rows="5" class="form-control"></textarea>
                  </div>
                  <div class="form-group w-75 mx-auto">
                    <label for="formGroupExampleInput">Количество участников</label>
                    <input name="quantity" type="number" class="form-control">
                  </div>
                  <div class="form-group w-75 mx-auto">
                    <label for="formGroupExampleInput">Время</label>
                    <input name="time" type="text" class="form-control">
                  </div>
                  <div class="form-group w-75 mx-auto">
                    <label for="formGroupExampleInput">Часы волонтерства</label>
                    <input name="vol_time" type="text" class="form-control">
                  </div>
                  <div class="form-group pt-4">
                    <button class="btn btn-lg btn-block w-50 btn-success mx-auto" type="submit" name="add_task">Добавить задание</button>
                  </div>
              </form> 
            </div>
          </div>
        </div>
      </div>
      
      <!-- Footer -->
      <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-dark">
              &copy; <?php echo date('Y'); ?>
            </div>
          </div>
          <div class="col-xl-6">
            <ul class="nav nav-footer justify-content-center justify-content-xl-end">
              <li class="nav-item">
                <a href="https://github.com/ElamanGOD" class="nav-link text-dark" target="_blank">zackdon</a>
              </li>
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://kit.fontawesome.com/1c246a7390.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
<?php } else {
  echo "Please, <a href=\"/signin.php\">log in</a>";
} ?>