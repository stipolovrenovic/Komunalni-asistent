<?php
$sModalID = $_GET['modal_id'];

switch($sModalID)
{
	case 'napravi_izvjesce':
		echo 
		'<div class="modal-header">
	        <h5 class="modal-title">Napravi izvješće</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	     </div>
	     <div class="modal-body">
	        <form>
	        	<div class="form-group">
					<label class="control-label col-xs">Početni datum</label>        	
  					<input id="inptStartDatum" type="text" class="form-control date col-md-3 col-sm-3" placeholder = "Odaberite početni datum...">
				</div>
				<div class="form-group">
					<label class="control-label col-xs">Završni datum</label>        	
  					<input id="inptEndDatum" type="text" class="form-control date col-md-3 col-sm-3" placeholder = "Odaberite završni datum...">
				</div>
			</form>
	     </div>
	     <div class="modal-footer">
	        <button type="button" onclick="NovoIzvjesce()" class="btn btn-primary">Spremi</button>
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Odustani</button>
         </div>';
	break;

	case 'azuriraj_status':
		$id_ticketa = $_GET['id_ticketa'];
		echo 
		'<div class="modal-header">
	        <h5 class="modal-title">Ažuriraj status</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	     </div>
	     <div class="modal-body">
	        <form>
	        	<div class="form-group">
					<label for="selectStatus">Status ticketa</label>
					<select id="selectStatus" class="form-select">
						<option value="1">Riješen</option>
						<option value="2">Otvoren</option>
						<option value="3">Odbačen</option>
					</select>
				</div>
			</form>
	     </div>
	     <div class="modal-footer">
	        <button type="button" onclick="AzurirajStatus(\''.$id_ticketa.'\')" class="btn btn-primary">Spremi</button>
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Odustani</button>
         </div>';
	break;

	case 'azuriraj_komentar':
		$id_ticketa = $_GET['id_ticketa'];
		$komentar = $_GET['komentar'];

		$komentar = str_replace("\'", "'", $komentar);
		$komentar = str_replace('_', ' ', $komentar);

		echo 
		'<div class="modal-header">
	        <h5 class="modal-title">Ažuriraj komentar</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	     </div>
	     <div class="modal-body">
	        <form>
				<div class="form-group">
					<label for="inputPromet">Komentar</label>
					<input type="text" class="form-control" id="inputKomentar"  value="'.$komentar.'">
				</div>
	     </div>
	     <div class="modal-footer">
	        <button type="button" onclick="AzurirajKomentar(\''.$id_ticketa.'\')" class="btn btn-primary">Spremi</button>
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Odustani</button>
         </div>';
	break;

	case 'obrisi_ticket':
		$id_ticketa = $_GET['id_ticketa'];
		echo
			'<div class="modal-header" style="background-color:#00acac">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" style="color:white"> Obriši ticket</h4>
			</div>			
			<div class="modal-body">
				<p class = "col-md-12">Jeste li sigurni o brisanju ovog ticketa?</p>			
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" onclick="ObrisiTicket(\''.$id_ticketa.'\')">Potvrdi</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Odustani</button>
			</div>'
		;
	break;

	case 'odjava':
		echo
			'<div class="modal-header" style="background-color:#00acac">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" style="color:white"> Odjava</h4>
			</div>			
			<div class="modal-body">
				<p class = "col-md-12">Jeste li sigurni o odjavljivanju iz aplikacije?</p>			
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" onclick="Odjava()">Potvrdi</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Odustani</button>
			</div>'
		;
	break;

	case 'prikazi_sliku':
		$sSlika = $_GET['slika'];
		echo
			'<div class="modal-header" style="background-color:#00acac">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" style="color:white"> Prikazi sliku</h4>
			</div>			
			<div class="modal-body">
				<img src="'.$sSlika.'" />		
			</div>'
		;
	break;

}
?>