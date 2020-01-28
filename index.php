<?php 
    error_reporting(0);
    require $_SERVER["DOCUMENT_ROOT"].'/utils/bd.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <link href="/assets/css/argon-dashboard.css?v=1.1.0" rel="stylesheet" />
    <link rel="stylesheet" href="/assets/css/styles.css">
    
    <link href="/assets/favicon.jpg" rel="icon" type="image/jpeg">
    <title>Волонтеры | NIS</title>
    <style>
      .status{
        font-weight: 1000;
      }
      a{
        color: #000000;
        text-decoration: none;
      }
      a:hover{
        color: #000000;
        text-decoration: none;
      }
    </style>
  </head>
  <body>
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      
    </div>
    <div class="container-fluid mt--9">    
      <div class="row">
        <div class="col-xl-12 mb-5 mb-xl-0">
          <div class="card shadow py-5 container-fluid">
            <div class="row text-center">
            <div class="col-md-12 col-sm-12">
            <h1 class="text-center pb-5">Рейтинг волонтеров</h1>
            </div>
            </div>
            <div class="col-12 mx-auto px-5 py-3">
              <div class="table-responsive">
                <table class="table align-items-center">
                  <tbody class="list">
                    <tr>
                        <th class="text-left">Участник</th>
                        <th class="text-right">Волонтерские часы</th>
                    </tr>                       
                    <?php
                      $users = R::findAll("users", "ORDER BY vol_time DESC");
                      if(isset($users)){
                        foreach($users as $user){ ?>
                          <tr class="text-left">
                            <th>
                              <?php echo $user->surname . "   " .  $user->firstname; ?>
                            </th>
                            <td class="status text-right">
                              <?php 
                                echo $user->vol_time;
                              ?>
                            </td>
                          </tr>
                    <?php }
                    }
                  ?>                   
                  </tbody>
                </table>
              </div>
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
              <br>
              <a href="/signin.php">Авторизация</a> <br>
              <a href="/signup.php">Регистрация</a>
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
  
  <!--   Core   -->
  <script src="/assets/js/argon-dashboard.min.js?v=1.1.0"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>