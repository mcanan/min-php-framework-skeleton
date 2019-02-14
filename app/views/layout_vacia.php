<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= isset($titulo) ? $titulo : "" ?></title>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>	
	<?= isset($header) ? $header : "" ?>
</head>
<body>

<div class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
		</div>
	</div>
</div>

<div style='margin-top:80px;'>
<div class="section">
	<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?= isset($contenido) ? $contenido : "" ?>
		</div>
	</div>
	</div>
</div>
</div>

<div id="footer" class="container">
    <nav class="navbar navbar-default navbar-fixed-bottom">
        <div class="navbar-inner navbar-content-center" style='padding-left:20px; padding-top:10px;'>
        </div>
    </nav>
</div>
<?= isset($javascript) ? $javascript : "" ?>
</body>
</html>
