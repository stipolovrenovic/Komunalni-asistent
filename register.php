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
<link href="css/style.css" rel="stylesheet" media="screen and (min-device-width: 768px)"/>
<link href="css/styleMobile.css" rel="stylesheet" media="screen and (max-device-width: 767px)"/>
<head>
	<title>Komunalni asistent: Registracija</title>
</head>
<body>
  <img id = "logo" src = 'img/logo.png'>
  <h1 class= "loginGreeting">Novi račun</h1>
  <p class= "loginGreeting">Unesite podatke:</p>
  <div class="alert alert-danger" role="alert" style="display:none;">
    Alert
  </div>
  <a id="backButton" class="btn btn-danger" href="index.php" role="button">Povratak na početnu stranicu</a>
  <form id= "registerForm">
    <div id="formUser" class="form-group">
        <label class="control-label col-md-3 col-sm-3">Ime</label>
        <div class="col-md-8">
            <input id="inptName" data-parsley-required="true" type="text" placeholder="Unesite ime..." class="form-control">        
        </div>
    </div>
    <div id="formUser" class="form-group">
        <label class="control-label col-md-3 col-sm-3">Korisničko Ime</label>
        <div class="col-md-8">
            <input id="inptUser" data-parsley-required="true" type="text" placeholder="Unesite korisničko ime..." class="form-control">        
        </div>
    </div>
    <div id="formEmail" class="form-group">
        <label class="control-label col-md-3 col-sm-3">E-Mail Adresa</label>
        <div class="col-md-8">
            <input id="inptEmail" data-parsley-required="true" type="text" placeholder="Unesite e-mail adresu..." class="form-control">        
        </div>
    </div>
    <div id= "formPass" class="form-group">
        <label class="control-label col-md-3 col-sm-3">Lozinka</label>
        <div class="col-md-8">
            <input id="inptPass" data-parsley-required="true" type="password" placeholder="Unesite lozinku..." class="form-control">
        </div>
    </div>
    <div id= "formPass" class="form-group">
        <label class="control-label col-md-3 col-sm-3">Potvrdite lozinku</label>
        <div class="col-md-8">
            <input id="inptPassConfirm" data-parsley-required="true" type="password" placeholder="Unesite ponovno lozinku..." class="form-control">
        </div>
    </div>
    <button id = 'btnLogin' type="button" class="btn btn-success" onclick = "Registracija()">Registrirajte se</button>
</form>

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
<script src="js/register.js"></script>
</body>
</html>