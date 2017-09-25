<?php
$usuario = $_POST["usuario"];
$password = $_POST["password"];

require_once "../dbo/medoo.php";

$dbo = new medoo();

if($dbo->has("usuarios",["AND" => ["usuario" => $usuario, "password" => $password]]))
{
	$datos_usuarios = $dbo->get("usuarios",["id","nombre","apellido","activo","role","foto"],["AND" => ["usuario" => $usuario, "password" => $password]]);
	
	if($datos_usuarios["activo"] == "1")
	{
		require_once "../utils/my_session.php" ;
	
		mySession::setSession("id",$datos_usuarios["id"]);
		mySession::setSession("nombre",$datos_usuarios["nombre"]);
		mySession::setSession("apellido",$datos_usuarios["apellido"]);
		mySession::setSession("foto",$datos_usuarios["foto"]);
		
		$dbo->close();
		
		if($datos_usuarios["role"] == 1)
		{
			mySession::setSession("nombre_role","Señor@");
			mySession::setSession("logged_url","dashboard_administrativos");
			header("Location: ../dashboard_administrativos/");
		}
		if($datos_usuarios["role"] == 2)
		{
			mySession::setSession("nombre_role","Profesor@");
			mySession::setSession("logged_url","dashboard_docentes");
			header("Location: ../dashboard_docentes/");
		}
		if($datos_usuarios["role"] == 3)
		{
			mySession::setSession("nombre_role","Señor@");
			mySession::setSession("logged_url","dashboard_acudientes");
			header("Location: ../dashboard_acudientes/");
		}
		exit;
	}
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BereMI | Error de acceso</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <a href="#"><b>Error</b> accesando</a>
  </div>

  <div class="box-body">
              <div class="callout callout-danger">
                <h4>Hubo un error al accesar!</h4>

                <p>Favor valide el usuario y la contraseña que ingreso y vuelva a intentarlo.</p>
              </div>
  </div>
  <div class="text-center">
    <a href="index.php">Volver</a>
  </div>
  <div class="lockscreen-footer text-center">
    Copyright &copy; <?php echo date('Y'); ?><b> <a href="https://beremi.io" class="text-black">BereMI</a></b><br>
    All rights reserved
  </div>
</div>
<!-- /.center -->

<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
