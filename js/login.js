function ProvjeriLoginPodatke()
{

	if($.trim($('#inptUser').val()) != "" && $.trim($('#inptPass').val()) != "")
	{
		console.log($('#inptUser').val());

		$.ajax({
			type: "GET",
			url: 'json.php',
			data:
			{
				json_id: "daj_korisnika",
				user: $('#inptUser').val(),
				lozinka: $('#inptPass').val()
			},
			success: function (oData) {
				if(oData[0] != undefined)
				{
					if(oData[0].potvrda == 1)
					{			  
				        localStorage.setItem('id', oData[0].id);
				        localStorage.setItem('name', oData[0].ime);
				        localStorage.setItem('administrator', oData[0].administrator)
				        window.open('table.php', '_self');
					}
					else
					{
					    	$('.alert').css('display', 'block');
					    	$('.alert').text('Vaš račun trenutno nije potvrđen.');
					}
				}
				else
				{
					$('.alert').css('display', 'block');
					$('.alert').text('Podaci nisu ispravni!');
				}
			},
			error: function (XMLHttpRequest, textStatus, exception) {
				console.log(textStatus);
			},
		    async: true
		});
	}   
	else
	{
		$('.alert').css('display', 'block');
		$('.alert').text('Popunite potrebna polja!');
	}
}