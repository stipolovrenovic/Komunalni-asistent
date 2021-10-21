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
	<title>Komunalni asistent: Izvješće</title>
</head>
<body>
  <div class="alert" role="alert" style="display:none;">
    Alert
  </div>
  <div id= "reportBody" class="container-fluid">
    <h1 style="font-weight: bold;" id="dateSpan">Izvješće u razdoblju od ... do ...</h1>
    <div>
      <h3>Broj ticketa:</h3>
      <p id="ticketNum"></p>
    </div>
     <div id="openTicketsDiv">
      <h3>Broj otvorenih ticketa:</h3>
      <p id="openTickets"></p>
    </div>
     <div id="solvedTicketsDiv">
      <h3>Broj riješenih ticketa:</h3>
      <p id="solvedTickets"></p>
    </div>
    <div id="rejectedTicketsDiv">
      <h3>Broj odbačenih ticketa:</h3>
      <p id="rejectedTickets"></p>
    </div>
    <div id="averageTimeDiv">
      <h3>Prosječno vrijeme rješavanja problema:</h3>
      <p id="averageTime"></p>
    </div>
     <div>
      <h3>Karta ticketa:</h3>
      <div id="reportMap"></div>
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
<script src="js/report.js"></script>
</body>
</html>