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
	<title>Komunalni asistent: Tiket</title>
</head>
<body>
  <div class="alert" role="alert" style="display:none;">
    Alert
  </div>
  <div id= "ticketBody" class="container-fluid">
    <h1 id="id" style="font-weight: bold;">Ticket broj...</h1>
    <div>
      <h3>Datum prijave</h3>
      <p id="startDate"></p>
    </div>
     <div id="endDateDiv">
      <h3>Datum završetka</h3>
      <p id="endDate"></p>
    </div>
     <div>
      <h3>Opis problema</h3>
      <p id="description"></p>
    </div>
     <div>
      <h3>Lokacija</h3>
      <div id="map"></div>
    </div>
     <div id="imageDiv">
      <h3>Slika/e</h3>
      <button class="btn btn-success" onclick="PrikaziSliku()"><span class="glyphicon glyphicon-eye-open"></span> Otvori</button>
    </div>
     <div>
      <h3>Status</h3>
      <p id="status"></p>
      <button class="glyphicon glyphicon-cog btn btn-success adminOnly" onclick="changeStatusModal()"></button>
    </div>
     <div>
      <h3>Komentar</h3>
       <p id="comment"></p>
      <button class="glyphicon glyphicon-pencil btn btn-success adminOnly" onclick="editCommentModal()"></button>
    </div>
  </div>

  <div id="imgModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="img01">
    <div id="imageButtons">
      <button class="btn btn-success imageSwitch" onclick="PrevImage()"><span class = "glyphicon glyphicon-arrow-left"></span></button>
      <button class="btn btn-success imageSwitch" onclick="NextImage()"><span class = "glyphicon glyphicon-arrow-right"></span></button>
    </div>
  </div>

  <div class="modal" tabindex="-1" role="dialog" id="myModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        
      </div>
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
<script async
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsTWEVwc0jMwmh3-Ppwv6oIHwMQusuQO4&callback=initMap">
</script>
<script src="js/ticket.js"></script>
</body>
</html>