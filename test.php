<?php
include_once("connection.php");
header('Content-type: text/json');             
header('Content-type: application/json; charset=utf-8');

$oJson = array();

$sDatumi = '\'2021-07-28\', \'2021-07-29\', \'2021-07-30\'';
$sQuery = "";
$sJsonID = "prikazi_podatke";
$sIme = 'test';
$sLozinka = 'test';
$status = 0;
$sDatum = '2021-07-28';


switch($sJsonID)
{
	case('daj_korisnika'):
		$sQuery = "select id, ime, potvrden_racun, administrator FROM sLovrenovic_korisnici where ime = '".$sIme."' and lozinka = '".$sLozinka."'";
		$oRecord = $oDbConnector ->query($sQuery);
		$oQueryData = $oRecord->fetchAll(PDO::FETCH_ASSOC);

		foreach ($oQueryData as $oRow)
		{
			$oTmp['id'] = $oRow['id'];
			$oTmp['ime'] = $oRow['ime'];
			$oTmp['potvrda'] = $oRow['potvrden_racun'];
			$oTmp['administrator'] = $oRow['administrator'];

		    array_push($oJson, $oTmp);
		}
	break;



	case('prikazi_podatke'):
		$sQuery = "select id, datum_prijave, datum_zavrsetka, lokacija, opis, slika, komentar, status_id, sLovrenovic_statusi.naziv FROM sLovrenovic_tiketi inner join sLovrenovic_statusi on sLovrenovic_tiketi.status_id = sLovrenovic_statusi.id"; 
		$oRecord = $oDbConnector ->query($sQuery);
		$oQueryData = $oRecord->fetchAll(PDO::FETCH_ASSOC);

		foreach ($oQueryData as $oRow)
		{
			$oTmp['id'] = $oRow['id'];
			$oTmp['datum_start'] = $oRow['datum_prijave'];
		    $oTmp['datum_end'] = $oRow['datum_zavrsetka'];
		    $oTmp['lokacija'] = $oRow['lokacija'];
		    $oTmp['opis'] = $oRow['opis'];
		    $oTmp['slika'] = $oRow['slika'];
		    $oTmp['komentar'] = $oRow['komentar'];
		    $oTmp['status'] = $oRow['status_id'];
		    $oTmp['statusNaziv'] = $oRow['naziv'];
		    
		    array_push($oJson, $oTmp);
		}
	break;

	case('filtriraj_po_datumu'):
		$sQuery = "select id, opis, lokacija, slika, status_id, kasistent_statusi.st_naziv, komentar, datum_prijave, datum_zavrsetka FROM sLovrenovic_tiketi inner join kasistent_statusi on sLovrenovic_tiketi.status_id = kasistent_statusi.st_id where datum_prijave = '".$sDatum."'";
		$oRecord = $oDbConnector ->query($sQuery);
		$oQueryData = $oRecord->fetchAll(PDO::FETCH_ASSOC);

		foreach ($oQueryData as $oRow)
		{
			$oTmp['id'] = $oRow['id'];
		    $oTmp['opis'] = $oRow['opis'];
		    $oTmp['lokacija'] = $oRow['lokacija'];
		    $oTmp['slika'] = $oRow['slika'];
		    $oTmp['status'] = $oRow['status_id'];
		    $oTmp['statusNaziv'] = $oRow['st_naziv'];
		    $oTmp['komentar'] = $oRow['komentar'];
		    $oTmp['datum_start'] = $oRow['datum_prijave'];
		    $oTmp['datum_end'] = $oRow['datum_zavrsetka'];

		    array_push($oJson, $oTmp);
		}
	break;

	case('filtriraj_po_statusu'):
		$sQuery = "select ti_id, ti_opis, ti_lat, ti_lng, ti_slika, status_st_id, kasistent_statusi.st_naziv, ti_komentar, ti_datum FROM kasistent_tiketi inner join kasistent_statusi on kasistent_tiketi.status_st_id = kasistent_statusi.st_id where status_st_id = ".$status;
		$oRecord = $oDbConnector ->query($sQuery);
		$oQueryData = $oRecord->fetchAll(PDO::FETCH_ASSOC);

		foreach ($oQueryData as $oRow)
		{
			$oTmp['id'] = $oRow['ti_id'];
		    $oTmp['opis'] = $oRow['ti_opis'];
		    $oTmp['lokacija'] = $oRow['ti_lat'] + ', ' + $oRow['ti_lng'];
		    $oTmp['slika'] = $oRow['ti_slika'];
		    $oTmp['status'] = $oRow['status_st_id'];
		    $oTmp['statusNaziv'] = $oRow['st_naziv'];
		    $oTmp['komentar'] = $oRow['ti_komentar'];
		    $oTmp['datum'] = $oRow['ti_datum'];

		    array_push($oJson, $oTmp);
		}
	break;


	case('daj_tikete'):
		$sQuery = "select ti_id, ti_opis, ti_lat, ti_lng, ti_putanja, status_st_id, sLovrenovic_statusi_naziv, ti_komentar, ti_datum FROM kasistent_tiketi inner join sLovrenovic_statusi on kasistent_tiketi.status_st_id = sLovrenovic_statusi.id";
		$oRecord = $oDbConnector ->query($sQuery);
		$oQueryData = $oRecord->fetchAll(PDO::FETCH_ASSOC);

		foreach ($oQueryData as $oRow)
		{
			$oTmp['id'] = $oRow['ti_id'];
		    $oTmp['opis'] = $oRow['ti_opis'];
		    $oTmp['lokacija'] = sprintf('%f, %f', $oRow['ti_lat'], $oRow['ti_lng']);
		    $oTmp['slika'] = $oRow['ti_putanja'];
		    $oTmp['status'] = $oRow['status_st_id'];
		    $oTmp['statusNaziv'] = $oRow['naziv'];
		    $oTmp['komentar'] = $oRow['ti_komentar'];
		    $oTmp['datum'] = $oRow['ti_datum'];

		    array_push($oJson, $oTmp);
		}

	break;

	case('filtriraj_po_datumima'):
		$sQuery = "select id, opis, lokacija, slika, status_id, kasistent_statusi.st_naziv, komentar, datum_prijave, datum_zavrsetka FROM sLovrenovic_tiketi inner join kasistent_statusi on sLovrenovic_tiketi.status_id = kasistent_statusi.st_id where datum_prijave in (".$sDatumi.")";
		echo($sQuery);
		$oRecord = $oDbConnector ->query($sQuery);
		$oQueryData = $oRecord->fetchAll(PDO::FETCH_ASSOC);

		foreach ($oQueryData as $oRow)
		{
			$oTmp['id'] = $oRow['id'];
		    $oTmp['opis'] = $oRow['opis'];
		    $oTmp['lokacija'] =  $oRow['lokacija'];
		    $oTmp['slika'] = $oRow['slika'];
		    $oTmp['status'] = $oRow['status_id'];
		    $oTmp['statusNaziv'] = $oRow['st_naziv'];
		    $oTmp['komentar'] = $oRow['komentar'];
		    $oTmp['datum_start'] = $oRow['datum_prijave'];
		    $oTmp['datum_end'] = $oRow['datum_zavrsetka'];

		    array_push($oJson, $oTmp);
		}
	break;
}

$oJson = json_encode($oJson); 
echo($oJson);
?>