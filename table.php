<?php
include_once("connection.php");
?>

<!DOCTYPE html>
<html ng-app="tiketiModul">

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<script src="assets/plugins/angularjs/angular.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,100italic,300,300italic,400,400italic,500,500italic,700,700italic,900,900italic" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/plugins/font-awesome/5.0/css/fontawesome-all.min.css" rel="stylesheet" />
    <link href="assets/plugins/bootstrap-eonasdan-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
	<link href="css/style.css" rel="stylesheet" media="screen and (min-device-width: 768px)"/>
	<link href="css/styleMobile.css" rel="stylesheet" media="screen and (max-device-width: 767px)"/>
<head>
	<title>Komunalni Asistent: Tablica Ticketa</title>
</head>
<body id="body" ng-controller="tiketiKontroler">
	<img id = "logo" src = 'img/logo.png'>
	<h3 class = "loginGreeting"><span id = "greeting">Pozdrav</span>, <span id = "name">Ime i Prezime</span>!</h3>
	<div class="alert alert-danger" role="alert" style="display:none;">
	    Alert
	</div>
	<br>
	<button id="logOut" onclick = "GetModal('modals.php?modal_id=odjava')" class="btn btn-success"><span class = "glyphicon glyphicon-log-out"></span> ODJAVI SE</button>
	<div id = "filters" class="container">
		<h3 id = "filterTitle">FILTERI</h3>
		 <div class="row">
		 	<button onclick="PrikaziFiltere()" class="button btn btn-success btn-lg center-block" id="showHideBtn">Prikaži/Sakrij filtere</button>
		 </div>
		 <br>
	     <div id = "filterContent" class="row">
	     	<div id= "resetFilters" class='col-sm-3'>
				<button ng-click="filterTickets('ukloni_filter')" class="button btn btn-success btn-lg center-block" id="removeBtn">Ukloni filter</button>
	        </div>
	        <div id= "sorter" class='col-md-3'>	   
	        	<label class="control-label col-xs">Sortiraj</label>     	
  				<select id="selectSorter" class="form-select">
					<option value="ascending">Od najstarijeg</option>
					<option value="descending">Od najnovijeg</option>
				</select>
				<button  ng-click= "sortByDate()" class="button btn btn-success btn-lg center-block" id="statusBtn">Sortiraj po datumu</button>
	        </div>	     
	     	<div id= "datumFilter" class='col-sm-3'>
	     		<label class="control-label col-xs">Po datumu</label>        	
  				<input id="inptDatum" type="text" class="form-control date col-md-3 col-sm-3" placeholder = "Odaberite datum...">
  				<br>
				<button ng-click= "filterTickets('filtriraj_po_datumu')" class="button btn btn-success btn-lg center-block" id="submitBtn">Filtriraj po datumu</button>
	        </div>
	        <div id= "statusFilter" class='col-md-3'>	   
	        	<label class="control-label col-xs">Po statusu</label>     	
  				<select id="selectFilterStatus" class="form-select">
					<option value="1">Riješen</option>
					<option value="2">Otvoren</option>
					<option value="3">Odbačen</option>
				</select>
				<button  ng-click= "filterTickets('filtriraj_po_statusu')" class="button btn btn-success btn-lg center-block" id="statusBtn">Filtriraj po statusu</button>
	        </div>	      
	    </div>	    	    
	</div>
	<br>
	<br>
	<div class="container">
		<input id= "searchFilter" type="text" ng-model="inputTekst" placeholder = "Pretražite tablicu...">
		<button id="newReportButton" onclick = "createReportModal()" class="btn btn-success">Napravi izvješće</button>
		<table class="table table-hover" id="sTableId">
		    <thead>
		      <tr>
		        <th>Datum</th>
		        <th>Status</th>
		        <th>Detaljno...</th>
		        <th class="adminOnly">Obriši ticket</th>
		      </tr>
		    </thead>
		    <tbody>	
		      <tr ng-repeat="tiket in oTiketi | filter: inputTekst" ng-class="{'open': tiket.status == 2, 'solved': tiket.status == 1, 'rejected': tiket.status == 3}">
		      	<td>{{tiket.datum_start}}</td>
		      	<td>{{tiket.statusNaziv}} <button class="adminOnly glyphicon glyphicon-ok btn btn-success" ng-class="{'unsolved': tiket.status == 1}" ng-click="solved(tiket.id)"></button></td>
		      	<td><button class="glyphicon glyphicon-info-sign btn btn-success" ng-click= "openTicket(tiket)" aria-hidden="true"></td>
		      	<td class="adminOnly"><button class="glyphicon glyphicon-trash btn btn-danger" ng-click= "deleteTicketModal(tiket.id)" aria-hidden="true"></td>
		      </tr>	    	
		    </tbody>
	    </table>
	    <button class="page-btn btn btn-success" id="firstPage" ng-click="changePage('firstPage')">Prva stranica</button>
	    <button class="page-btn btn btn-success" id="previousPage" ng-click="changePage('previousPage')"><span class = "glyphicon glyphicon-arrow-left"></span></button>
	    <button class="page-btn btn btn-success" id="nextPage" ng-click="changePage('nextPage')"><span class = "glyphicon glyphicon-arrow-right"></span></button>
	    <button class="page-btn btn btn-success" id="lastPage" ng-click="changePage('lastPage')">Zadnja stranica</button>
	    <label id="pageNumLabel" class="control-label col-xs">Broj ticketa na stranici</label>
	    <select id="selectPagination" class="form-select" onchange="paginate()">
	   			<option value="5">5</option>
				<option value="10" selected>10</option>
				<option value="15">15</option>
		</select>
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
    <script src="js/table.js"></script>
	<script type="text/javascript">
            $(function () {
                DateTimePickerFunkcija('#inptDatum');
            });
    </script>
</body>
</html>