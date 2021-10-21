<?php
include_once("connection.php");
?>

<!DOCTYPE html>
<html>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="https://fonts.googleapis.com/css?family=Roboto:100,100italic,300,300italic,400,400italic,500,500italic,700,700italic,900,900italic" rel="stylesheet" type="text/css" />
<link href="assets/plugins/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
<link href="assets/plugins/font-awesome/5.0/css/fontawesome-all.min.css" rel="stylesheet" />
<link href="assets/plugins/bootstrap-eonasdan-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet"/ media="screen and (min-device-width: 787px)">
<link href="css/styleMobile.css" rel="stylesheet" media="screen and (max-device-width: 767px)"/>
<head>
	<title>Komunalni asistent: Početna stranica</title>
</head>
<body>
  <img id = "logo" src = 'img/logo.png'>
  <h1 class= "loginGreeting">Dobrodošli u sustav!</h1>
  <p class= "loginGreeting">Odaberite jednu od opcija:</p>
  <div class="alert" role="alert" style="display:none;">
    Alert
  </div>
  <div class="container-fluid" id= "indexBody">
    <div class="indexLink">
      <a class="btn btn-success" href="newTicket.php" type="button">Prijavite komunalni problem</a>
    </div>
    <div class="indexLink">
      <a class="btn btn-success" href="login.php" type="button">Prijavite se u sustav</a>
    </div>
    <div class="indexLink">
       <a class="btn btn-success" href="register.php" type="button">Registrirajte se</a>
    </div>
</div>

<script src="assets/plugins/jquery/jquery-3.2.1.min.js"></script>
<script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="assets/plugins/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="assets/plugins/bootstrap-daterangepicker/moment.js"></script>
<script src="assets/plugins/moment/moment-with-locales.min.js"></script>
<script src="assets/plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
<script src="assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
<script src="assets/plugins/DataTables/media/js/dataTables.buttons.min.js"></script>
<script src="assets/plugins/DataTables/media/js/buttons.colVis.min.js"></script>
<script src="js/home.js"></script>
</body>
</html>