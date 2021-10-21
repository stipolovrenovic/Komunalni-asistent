function Registracija()
{
	if($.trim($('#inptName').val()) != '' && $.trim($('#inptUser').val()) != '' &&  $.trim($('#inptEmail').val()) != '' && $.trim($('#inptPass').val()) != '' && $.trim($('#inptPassConfirm').val()) != '')
	{
		const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		if(re.test(String($('#inptEmail').val()).toLowerCase()) == true)
		{
			$.ajax({
				type: "GET",
				url: 'json.php',
				data:
				{
					json_id: "daj_email",
					email: $('#inptEmail').val(),
					user: $('#inptUser').val()
				},
				success: function (oData) {
					if(oData[0] == undefined)
					{
						if($('#inptPass').val() == $('#inptPassConfirm').val())
						{
							$.ajax({
								type: "POST",
								url: 'action.php',
								    data:
								    {
									action_id:'registriraj_novog_korisnika',
									ime: $('#inptName').val(),
									user: $('#inptUser').val(),
									email: $('#inptEmail').val(),
									lozinka: $('#inptPass').val()
								    },
								    success: function (oData)
								    {
									localStorage.setItem('message', 'Registracija uspješna! Pričekajte dok Vam se račun potvrdi.');
									localStorage.setItem('alertClass', 'alert-success');

									window.open('index.php', '_self');
								    },
								    error: function (XMLHttpRequest, textStatus, exception) {
									        console.log("Ajax failure\n");
								    },
								    async: true
							});
						}
						else
						{
							$('.alert').css('display', 'block');
							$('.alert').text('Lozinke nisu iste!');
						}
					}
					else
					{
						$('.alert').css('display', 'block');
						$('.alert').text('Već postoji račun s tim korisničkim imenom/e-mail adresom!');
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
			$('.alert').text('E-Mail adresa nije valjana!');
		}
	}
	else
	{
		$('.alert').css('display', 'block');
		$('.alert').text('Popunite potrebna polja!');
	}
}