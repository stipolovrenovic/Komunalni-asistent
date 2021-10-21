<?php
include_once("connection.php");
header('Content-type: text/json');             
header('Content-type: application/json; charset=utf-8');

$oJson = array();
 
$sJsonID = '';
$sEmail = '';
$sUser = '';
$sIme = '';
$sLozinka = '';
$status = 0;
$sDatum = '';
$sDatumi = '';

if(isset($_GET['json_id']))
{
	$sJsonID=$_GET['json_id'];
}

if(isset($_GET['user']))
{
	$sUser = $_GET["user"]; 
}


if(isset($_GET['email']))
{
	$sEmail = $_GET["email"]; 
}

if(isset($_GET['ime']))
{
	$sIme = $_GET["ime"]; 
}

if(isset($_GET['lozinka']))
{
	$sLozinka = $_GET["lozinka"]; 
}

if(isset($_GET['datum']))
{
	$sDatum = $_GET["datum"]; 
}

if(isset($_GET['status']))
{
	$status = $_GET["status"]; 
}

if(isset($_GET['datumi']))
{
	$sDatumi = $_GET["datumi"];
}

switch($sJsonID)
{
	case('daj_email'):
		$sQuery = "select korime, email FROM sLovrenovic_korisnici where korime = '".$sUser."' or email = '".$sEmail."'";
		$oRecord = $oDbConnector ->query($sQuery);
		$oQueryData = $oRecord->fetchAll(PDO::FETCH_ASSOC);

		foreach ($oQueryData as $oRow)
		{
			$oTmp['email'] = $oRow['email'];
			$oTmp['korime'] = $oRow['korime'];

		    array_push($oJson, $oTmp);
		}
	break;

	case('daj_korisnika'):
		$sQuery = "select id, ime, potvrden_racun, administrator FROM sLovrenovic_korisnici where (korime = '".$sUser."' or email = '".$sUser."') and lozinka = '".$sLozinka."'";
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
		$sQuery = "select sLovrenovic_tiketi.id, datum_prijave, datum_zavrsetka, lokacija, opis, slika, komentar, status_id, sLovrenovic_statusi.naziv FROM sLovrenovic_tiketi inner join sLovrenovic_statusi on sLovrenovic_tiketi.status_id = sLovrenovic_statusi.id"; 
		$oRecord = $oDbConnector ->query($sQuery);
		$oQueryData = $oRecord->fetchAll(PDO::FETCH_ASSOC);

		foreach ($oQueryData as $oRow)
		{
			$dArray1 = array_reverse(explode('-', $oRow['datum_prijave']));
			$dArray2 = array_reverse(explode('-', $oRow['datum_zavrsetka']));

			$dStringHr1 = implode('.', $dArray1);
			$dStringHr2 = implode('.', $dArray2);

			$oTmp['id'] = $oRow['id'];
		    $oTmp['opis'] = $oRow['opis'];
		    $oTmp['lokacija'] =  $oRow['lokacija'];
		    $oTmp['slika'] = $oRow['slika'];
		    $oTmp['status'] = $oRow['status_id'];
		    $oTmp['statusNaziv'] = $oRow['naziv'];
		    $oTmp['komentar'] = $oRow['komentar'];
		    $oTmp['datum_start'] = $dStringHr1;
		    $oTmp['datum_end'] = $dStringHr2;

		    array_push($oJson, $oTmp);
		}
	break;

	case('filtriraj_po_datumu'):
		$sQuery = "select sLovrenovic_tiketi.id, opis, lokacija, slika, status_id, sLovrenovic_statusi.naziv, komentar, datum_prijave, datum_zavrsetka FROM sLovrenovic_tiketi inner join sLovrenovic_statusi on sLovrenovic_tiketi.status_id = sLovrenovic_statusi.id where datum_prijave = '".$sDatum."'";
		$oRecord = $oDbConnector ->query($sQuery);
		$oQueryData = $oRecord->fetchAll(PDO::FETCH_ASSOC);

		foreach ($oQueryData as $oRow)
		{
			$dArray1 = array_reverse(explode('-', $oRow['datum_prijave']));
			$dArray2 = array_reverse(explode('-', $oRow['datum_zavrsetka']));

			$dStringHr1 = implode('.', $dArray1);
			$dStringHr2 = implode('.', $dArray2);

			$oTmp['id'] = $oRow['id'];
		    $oTmp['opis'] = $oRow['opis'];
		    $oTmp['lokacija'] =  $oRow['lokacija'];
		    $oTmp['slika'] = $oRow['slika'];
		    $oTmp['status'] = $oRow['status_id'];
		    $oTmp['statusNaziv'] = $oRow['naziv'];
		    $oTmp['komentar'] = $oRow['komentar'];
		    $oTmp['datum_start'] = $dStringHr1;
		    $oTmp['datum_end'] = $dStringHr2;

		    array_push($oJson, $oTmp);
		}
	break;

	case('filtriraj_po_statusu'):
		$sQuery = "select sLovrenovic_tiketi.id, opis, lokacija, slika, status_id, sLovrenovic_statusi.naziv, komentar, datum_prijave, datum_zavrsetka FROM sLovrenovic_tiketi inner join sLovrenovic_statusi on sLovrenovic_tiketi.status_id = sLovrenovic_statusi.id where status_id = ".$status;
		$oRecord = $oDbConnector ->query($sQuery);
		$oQueryData = $oRecord->fetchAll(PDO::FETCH_ASSOC);

		foreach ($oQueryData as $oRow)
		{
			$dArray1 = array_reverse(explode('-', $oRow['datum_prijave']));
			$dArray2 = array_reverse(explode('-', $oRow['datum_zavrsetka']));

			$dStringHr1 = implode('.', $dArray1);
			$dStringHr2 = implode('.', $dArray2);

			$oTmp['id'] = $oRow['id'];
		    $oTmp['opis'] = $oRow['opis'];
		    $oTmp['lokacija'] =  $oRow['lokacija'];
		    $oTmp['slika'] = $oRow['slika'];
		    $oTmp['status'] = $oRow['status_id'];
		    $oTmp['statusNaziv'] = $oRow['naziv'];
		    $oTmp['komentar'] = $oRow['komentar'];
		    $oTmp['datum_start'] = $dStringHr1;
		    $oTmp['datum_end'] = $dStringHr2;

		    array_push($oJson, $oTmp);
		}
	break;

	case('filtriraj_po_datumima'):
		$sQuery = "select sLovrenovic_tiketi.id, opis, lokacija, slika, status_id, sLovrenovic_statusi.naziv, komentar, datum_prijave, datum_zavrsetka FROM sLovrenovic_tiketi inner join sLovrenovic_statusi on sLovrenovic_tiketi.status_id = sLovrenovic_statusi.id where datum_prijave in (".$sDatumi.")";
		$oRecord = $oDbConnector ->query($sQuery);
		$oQueryData = $oRecord->fetchAll(PDO::FETCH_ASSOC);

		foreach ($oQueryData as $oRow)
		{

			$oTmp['id'] = $oRow['id'];
		    $oTmp['opis'] = $oRow['opis'];
		    $oTmp['lokacija'] =  $oRow['lokacija'];
		    $oTmp['slika'] = $oRow['slika'];
		    $oTmp['status'] = $oRow['status_id'];
		    $oTmp['statusNaziv'] = $oRow['naziv'];
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