var sLokacija = '';
var marker;
var map;

/*$( document ).ready(function() {
  var check = false;
  (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
  
  if(check == true)
  {
    navigator.geolocation.getCurrentPosition(success, error, [options]);

    function success(pos) {
      var sLokacija = JSON.stringify(pos.coords);
    }

    function error(err) {
    }
  }
});*/

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

function initMap() {
  map = new google.maps.Map(document.getElementById("inptMap"), {
    center: { lat: 45.831509, lng: 17.386709 },
    zoom: 7,
    });

  /*if(sLokacija != '')
  {
    if(marker != null)
    {
        marker.setPosition(JSON.stringify(sLokacija));
    }
    else
    {
        marker = new google.maps.Marker({
            map: map,
            position: JSON.stringify(sLokacija),
        });
    }
  }*/

  map.addListener("click", (mapsMouseEvent) => {
    map.setCenter(mapsMouseEvent.latLng);
    if(marker != null)
    {
        marker.setPosition(mapsMouseEvent.latLng)
    }
    else
    {
        marker = new google.maps.Marker({
            map: map,
            position: mapsMouseEvent.latLng,
        });
    }
    sLokacija = JSON.stringify(mapsMouseEvent.latLng);
  });
}

function AžurirajLokaciju()
{
    var address = $('#inptAddress').val();

    $.ajax({
        type: "GET",
        url: 'https://api.opencagedata.com/geocode/v1/json?key=8c9e7fb2bed34c63bb075c9c2bd6ce99&q=' + address,
        success: function (oData) {
            if(oData.results.length > 0)
            {
                sLokacija = JSON.stringify(oData.results[0].geometry);

                if(marker != null)
                {
                    marker.setPosition(oData.results[0].geometry)
                }     
                else
                {
                    marker = new google.maps.Marker({
                        map: map,
                        position: oData.results[0].geometry,
                    });
                }
            }
            else
            {
                $('.alert').css('display', 'block');
                $('.alert').text('Nevaljana adresa!');
            }
        },
        error: function (XMLHttpRequest, textStatus, exception) {
            console.log(textStatus);
        },
        async: true
    });
}

async function PošaljiTicket()
{
    if($.trim($('#inptDescription').val()) != '' && sLokacija != '')
    {
        sDatum = DajDatum();

        slika = document.getElementById('inptImage');

        var sSlike = '';

        if(slika.files.length != 0)
        {
            for(var i = 0; i < slika.files.length; i++)
            {
                var sSlika = await toBase64(slika.files[i]);

                if(sSlika.includes('image'))
                {
                    if(sSlike != '')
                    {
                        sSlike = sSlike + '|' + sSlika;
                    }
                    else
                    {
                        sSlike = sSlika;
                    }
                }
                else
                {
                    $('.alert').css('display', 'block');
                    $('.alert').text('Jedna od datoteka koju ste odabrali nije slika!');

                    return;
                }
            }
        }

        $.ajax({
            type: "POST",
            url: 'action.php',
            data:
            {
                action_id:'dodaj_novi_ticket',
                datum: sDatum,
                opis: $('#inptDescription').val(),
                lokacija: sLokacija,
                slika: sSlike
            },
            success: function (oData)
            {
                localStorage.setItem('message', 'Ticket uspješno poslan!');
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
        $('.alert').text('Popunite potrebna polja!');
    }
}

const toBase64 = file => new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = error => reject(error);
});