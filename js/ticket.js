var oTiket = JSON.parse(localStorage.getItem('tiket'));
var marker;
var slikeArray;
var nTrenutnaSlika = 0;

$( document ).ready(function() {
    if(localStorage.getItem('administrator') == 0)
    {
        $('.adminOnly').css('display', 'none');
    }

    $('#id').text('Ticket broj ' + oTiket.id);
    $('#startDate').text(oTiket.datum_start);

    if(oTiket.datum_end != null && oTiket.datum_end != "")
    {
        $('#endDate').text(oTiket.datum_end);
    }
    else
    {
        $('#endDateDiv').css('display', 'none');
    }

    if(oTiket.slika == null)
    {
        $('#imageDiv').css('display', 'none');
    }

    $('#description').text(oTiket.opis);
    $('#status').text(oTiket.statusNaziv);
    
    if($.trim(oTiket.komentar) != '' && oTiket.komentar != null)
    {
        $('#comment').text(oTiket.komentar);
    }
    else
    {
        $('#comment').text('Nema.');
    }
});

function GetModal(sHref) {
    $('#myModal').removeData('bs.modal');
    $('#myModal').modal
        ({
            remote:sHref,
            show: true
        });
}

function DajDatum()
{
    var d = new Date();
    var datestring = "";

    switch(true)
    {
        case(((d.getMonth()+1) < 10) && (d.getDate() < 10)):
            datestring = d.getFullYear() + '-0' + (d.getMonth() + 1) + '-0' + d.getDate();
        break;

        case(((d.getMonth()+1) < 10) && (d.getDate() >= 10)):
            datestring = d.getFullYear() + '-0' + (d.getMonth() + 1) + '-' + d.getDate();
        break;

        case(((d.getMonth()+1) >= 10) && (d.getDate() < 10)):
            datestring = d.getFullYear() + '-' + (d.getMonth() + 1) + '-0' + d.getDate();
        break;

        default:
            datestring = d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + d.getDate();
        break;
    }

    return datestring;
}

function initMap(){
  map = new google.maps.Map(document.getElementById("map"), {
    center: JSON.parse(oTiket.lokacija),
    zoom: 7,
  });

  var sUrl = '';

  switch(oTiket.statusNaziv)
  {
    case 'Riješen':
        sUrl = "http://maps.google.com/mapfiles/ms/icons/green-dot.png"
    break;

    case 'Otvoren':
        sUrl = "http://maps.google.com/mapfiles/ms/icons/red-dot.png"
    break;

    case 'Odbačen':
        sUrl = "http://maps.google.com/mapfiles/ms/icons/blue-dot.png"
    break;
  }

  marker = new google.maps.Marker({
    map: map,
    position: JSON.parse(oTiket.lokacija),
    icon:
    {
        url: sUrl
    }
  });
}

function changeStatusModal()
{
    GetModal('modals.php?modal_id=azuriraj_status&id_ticketa='+ oTiket.id +'');
}

function editCommentModal()
{
    if(localStorage.getItem('administrator') != 0)
    {
        var sKomentar = 'N/A';

        if(oTiket.komentar != null)
        {
            sKomentar = oTiket.komentar.replaceAll("'", "\'");
            sKomentar = sKomentar.replaceAll(' ', '_')
        }

        GetModal('modals.php?modal_id=azuriraj_komentar&id_ticketa='+ oTiket.id +'&komentar='+ sKomentar +'');
    }
    else
    {
        $('.alert').css('display', 'block');
        $('.alert').attr('class', 'alert alert-danger');
        $('.alert').text('Nemate administratorske ovlasti!');
    }
}

function AzurirajStatus(id)
{
    if(localStorage.getItem('administrator') != 0)
    {
        var idStatusa = $('#selectStatus').val();
        var nazivStatusa = $('#selectStatus option:selected').text();
        var sDatum = null;

        if(idStatusa == 1)
        {
            sDatum = DajDatum();
        }

        $.ajax({
            type: "POST",
            url: 'action.php',
            data:
            {
                action_id:'azuriraj_status',
                id: id,
                status: idStatusa,
                datum: sDatum
            },
            success: function (oData)
            {
                $("#myModal").modal('hide');

                oTiket.statusNaziv = nazivStatusa;

                oTiket.status = idStatusa;
                oTiket.datum_end = sDatum;

                $('#status').text(oTiket.statusNaziv);

                if(sDatum != null)
                {
                    $('#endDateDiv').css('display', 'block');
                    $('#endDate').text(sDatum);
                }
                else
                {
                    $('#endDateDiv').css('display', 'none');
                }

                localStorage.setItem('tiket', JSON.stringify(oTiket));

                var sUrl = '';

                switch(oTiket.statusNaziv)
                {
                    case 'Riješen':
                        sUrl = "http://maps.google.com/mapfiles/ms/icons/green-dot.png"
                    break;

                    case 'Otvoren':
                        sUrl = "http://maps.google.com/mapfiles/ms/icons/red-dot.png"
                    break;

                    case 'Odbačen':
                        sUrl = "http://maps.google.com/mapfiles/ms/icons/blue-dot.png"
                    break;
                }

                marker.setIcon( 
                {
                    url: sUrl
                });

                $('.alert').css('display', 'block');
                $('.alert').attr('class', 'alert alert-success');
                $('.alert').text('Status uspješno ažuriran!'); 
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
        $('.alert').attr('class', 'alert alert-danger');
        $('.alert').text('Nemate administratorske ovlasti!');
    }
}

function AzurirajKomentar(id)
{
    if(localStorage.getItem('administrator') != 0)
    {
         
        var sKomentar = $('#inputKomentar').val();

        if($.trim(sKomentar) == '')
        {
            sKomentar = null;
        }

        $.ajax({
            type: "POST",
            url: 'action.php',
            data:
            {
                action_id:'azuriraj_komentar',
                id: id,
                komentar: sKomentar
            },
            success: function (oData)
            {
                $("#myModal").modal('hide');
                oTiket.komentar = sKomentar;

                if(sKomentar != null)
                {
                    $('#comment').text(sKomentar);
                }
                else
                {
                    $('#comment').text('Nema.');
                }

                localStorage.setItem('tiket', JSON.stringify(oTiket));

                $('.alert').css('display', 'block');
                $('.alert').attr('class', 'alert alert-success');
                $('.alert').text('Komentar uspješno ažuriran!');
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
        $('.alert').attr('class', 'alert alert-danger');
        $('.alert').text('Nemate administratorske ovlasti!');
    }
}

function Odjava()
{
    localStorage.setItem('loggedIn', 'false');
    window.open('login.php', '_self');
}


function PrikaziSliku()
{
    slikeArray = oTiket.slika.split('|');

    if(slikeArray.length > 1)
    {
        $('#img01').attr('src', slikeArray[0]);
        $('#imgModal').css('display', 'block');
    }
    else
    {
        $('#img01').attr('src', slikeArray[0]);
        $('#imgModal').css('display', 'block');
        $('.imageSwitch').css('display', 'none');
    }
}

var spanImg = document.getElementsByClassName("close")[0];

spanImg.onclick = function() { 
  $('#imgModal').css('display', 'none');
}

function PrevImage()
{
    if(nTrenutnaSlika != 0)
    {
        nTrenutnaSlika--;
        $('#img01').attr('src', slikeArray[nTrenutnaSlika]);
    }
    else
    {
        nTrenutnaSlika = slikeArray.length - 1;
        $('#img01').attr('src', slikeArray[nTrenutnaSlika]);
    }
}

function NextImage()
{
    if(nTrenutnaSlika != (slikeArray.length-1))
    {
        nTrenutnaSlika++;
        $('#img01').attr('src', slikeArray[nTrenutnaSlika]);
    }
    else
    {
        nTrenutnaSlika = 0;
        $('#img01').attr('src', slikeArray[nTrenutnaSlika]);
    }
}
