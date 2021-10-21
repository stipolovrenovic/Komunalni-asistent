<?php
include_once("connection.php");

$sActionID="";

if(isset($_POST['action_id']))
{
	$sActionID=$_POST['action_id'];
}


switch ($sActionID) 
{
	case 'dodaj_novi_ticket':
		if($_POST['slika'] != '')
		{
			$sQuery = "INSERT INTO sLovrenovic_tiketi (datum_prijave, lokacija, opis, slika, status_id) VALUES (:datum_prijave, :lokacija, :opis, :slika, :status)";
			$oData = array(
			 'datum_prijave' => $_POST['datum'],
			 'lokacija' => $_POST['lokacija'],
			 'opis' => $_POST['opis'],
			 'slika' => $_POST['slika'],
			 'status' => 2
			);
		}
		else
		{
			$sQuery = "INSERT INTO sLovrenovic_tiketi (datum_prijave, lokacija, opis, status_id) VALUES (:datum_prijave, :lokacija, :opis, :status)";
			$oData = array(
			 'datum_prijave' => $_POST['datum'],
			 'lokacija' => $_POST['lokacija'],
			 'opis' => $_POST['opis'],
			 'status' => 2
			);
		}
		try
		{
			$oStatement=$oDbConnector->prepare($sQuery);
			$oStatement->execute($oData);
		}
		catch(PDOException $error)
		{
			echo $error;
			echo 0;
		}		
	break;

	case 'registriraj_novog_korisnika':
		$sQuery = "INSERT INTO sLovrenovic_korisnici (ime, korime, email, lozinka, potvrden_racun, administrator) VALUES (:ime, :user, :email, :lozinka, :potvrden_racun, :administrator)";
		$oData = array(
		 'ime' => $_POST['ime'],
		 'user' => $_POST['user'],
		 'email' => $_POST['email'],
		 'lozinka' => $_POST['lozinka'],
		 'potvrden_racun' => FALSE,
		 'administrator' => FALSE
		);
		try
		{
			$oStatement=$oDbConnector->prepare($sQuery);
			$oStatement->execute($oData);
		}
		catch(PDOException $error)
		{
			echo $error;
			echo 0;
		}		
	break;

	case 'azuriraj_status':
		$sQuery = "UPDATE sLovrenovic_tiketi SET status_id = :status, datum_zavrsetka = :datum WHERE id = :id";
		$oData = array(
			'id' => $_POST['id'],
			'status' => $_POST['status'],
			'datum' => $_POST['datum']	 
		);
		try
		{
			$oStatement=$oDbConnector->prepare($sQuery);
			$oStatement->execute($oData);
		}
		catch(PDOException $error)
		{
			echo $error;
			echo 0;
		}		
	break;

	case 'obrisi_ticket':
		$sQuery = "DELETE FROM sLovrenovic_tiketi WHERE id = :id";
		$oData = array(
		 'id' => $_POST['id_ticketa']
		);
		try
		{
			$oStatement=$oDbConnector->prepare($sQuery);
			$oStatement->execute($oData);
		}
		catch(PDOException $error)
		{
			echo $error;
			echo 0;
		}		
	break;

	case 'azuriraj_komentar':
		$sQuery = "UPDATE sLovrenovic_tiketi SET komentar = :komentar WHERE id = :id";
		$oData = array(
		 'id' => $_POST['id'],
		 'komentar' => $_POST['komentar']
		);
		try
		{
			$oStatement=$oDbConnector->prepare($sQuery);
			$oStatement->execute($oData);
		}
		catch(PDOException $error)
		{
			echo $error;
			echo 0;
		}		
	break;
}
?>