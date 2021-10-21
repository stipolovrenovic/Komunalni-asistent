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
	<title>Komunalni asistent: Novi ticket</title>
</head>
<body>
  <img id = "logo" src = 'img/logo.png'>
  <h1 class= "loginGreeting">Novi ticket</h1>
  <p class= "loginGreeting">Unesite podatke o komunalnom problemu:</p>
  <div class="alert alert-danger" role="alert" style="display:none;">
    Alert
  </div>
  <a id="backButton" class="btn btn-danger" href="index.php" role="button">Povratak na početnu stranicu</a>
  <form id= "newTicketForm" class="container-fluid">
    <div id="formLocation" class="form-group">
        <label class="control-label col-md-3 col-sm-3">Lokacija*</label>
        <div id="inptMap"></div>
        <div id="formAddress">
          <input class="form-control" id="inptAddress" type="text" placeholder="Pritisnite na karti mjesto na kojem ste naišli na problem, ili unesite adresu ovdje...">
          <button id='btnUpdateLocation' type="button" class="btn btn-success" onclick="AžurirajLokaciju()">Postavi lokaciju</button>
        </div>      
    </div> 
    <div id="formDescription" class="form-group">
        <label class="control-label col-md-3 col-sm-3">Opis*</label>
        <div class="col-md-8">
            <textarea class="form-control" id="inptDescription" rows="4" placholder="Opišite problem..."></textarea>
        </div>
    </div>
    <div id= "formImage" class="form-group">
        <label class="control-label col-md-3 col-sm-3">Fotografija/e</label>
        <div class="col-md-8">
            <input type="file" class="form-control-file" id="inptImage" accept="image/png, image/gif, image/jpeg" multiple>
        </div>
    </div>
    <button id='btnSubmit' type="button" class="btn btn-success" onclick="PošaljiTicket()">Pošaljite ticket</button>   
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
<script src="js/newTicket.js"></script>
<script async
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsTWEVwc0jMwmh3-Ppwv6oIHwMQusuQO4&callback=initMap">
</script>
</body>
</html>