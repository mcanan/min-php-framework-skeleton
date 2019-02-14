<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : "" ?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <?= isset($header) ? $header : "" ?>
  </head>
  <body>
    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav navbar-right">
            <li><a href='#'><i class="fa fa-user"></i>&nbsp;<?= $usuario ?></a>
              <li><a href="/home/logout"><i class="fa fa-sign-out"></i> &nbsp;Salir</a></div></li>
          </ul>
      </div>
    </div>
    </div>

    <div style='margin-top:80px;'>
      <div class="section">
        <div class="container">
          <div class="row">
            <div class="col-md-2 list-group" style='height:200px;'>
              <h4 class="list-group-item list-group-item-heading" style='background-color: #f8f8f8;'>Menu</h4>
              <a href='/users/' class="list-group-item"><i class="fa fa-user"></i> &nbsp;Users</a>
            </div>
            <div class="col-md-10">
              <?= isset($contenido) ? $contenido : "" ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="footer" class="container" style='margin-bottom: 50px'>
      <nav class="navbar navbar-default navbar-fixed-bottom">
        <div class="navbar-inner navbar-content-center" style='padding-left:20px; padding-top:10px;'>
        </div>
      </nav>
    </div>
    <?= isset($javascript) ? $javascript : "" ?>
  </body>
</html>
