var oTiketi= JSON.parse(localStorage.getItem('tiketi'));
var nVremena = [];
var nProsjecnoVrijeme = 0;
var nOtvoreniTiketi = 0;
var nRijeseniTiketi = 0;
var nOdbaceniTiketi = 0;

$( document ).ready(function() {
   for(var i = 0; i < oTiketi.length; i++)
   {
      if(oTiketi[i].statusNaziv == 'Riješen')
      {
        nRijeseniTiketi++;

        nDani = DajDane(oTiketi[i].datum_start, oTiketi[i].datum_end);

        nVremena.push(nDani);
      }
      else
      {
        if(oTiketi[i].statusNaziv == 'Otvoren')
        {
          nOtvoreniTiketi++;
        }
        else
        {
          nOdbaceniTiketi++;
        }
      }
    }

    if(nVremena.length != 0)
    {
      const reducer = (sum, currentValue) => sum + currentValue;

      nProsjecnoVrijeme = Math.round(nVremena.reduce(reducer) / nVremena.length);
    }

    $('#dateSpan').text('Izvješće u razdoblju od '+ PretvoriuHR(localStorage.getItem('startDatum')) + ' do ' + PretvoriuHR(localStorage.getItem('endDatum')));
    $('#ticketNum').text(oTiketi.length);

    if(nOtvoreniTiketi > 0)
    {
      $('#openTickets').text(nOtvoreniTiketi);
    }
    else
    {
      $('#openTicketsDiv').css('display', 'none');
    }

    if(nRijeseniTiketi > 0)
    {
      $('#solvedTickets').text(nRijeseniTiketi);
      
      if(nProsjecnoVrijeme > 0)
      {
        $('#averageTime').text(nProsjecnoVrijeme + ' dan(a)');
      }
      else
      {
        $('#averageTime').text('Manje od 24 sata.');
      }
    }
    else
    {
      $('#solvedTicketsDiv').css('display', 'none');
      $('#averageTime').css('display', 'none');
    }

    if(nOdbaceniTiketi > 0)
    {
      $('#rejectedTickets').text(nOdbaceniTiketi);
    }
    else
    {
      $('#rejectedTicketsDiv').css('display', 'none');
    }
});

function initMap(){
  map = new google.maps.Map(document.getElementById("reportMap"), {
    center: { lat: 45.831509, lng: 17.386709 },
    zoom: 7,
  });

  for(var i = 0; i < oTiketi.length; i++)
  {
    var sUrl = '';

    var sKomentar = '';

    if(oTiketi[i].komentar == null)
    {
      sKomentar = 'Nema';
    }
    else
    {
      sKomentar = oTiketi[i].komentar;
    }


    switch(oTiketi[i].statusNaziv)
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


    var contentString = '<div id="content">' +
      '<div id="siteNotice">' +
      "</div>" +
      '<h1 id="firstHeading" class="firstHeading">Lokacija ticketa</h1>' +
      '<div id="bodyContent">' +
      "<p><b>Datum prijave: </b>" + oTiketi[i].datum_start +
      "<br><br><b>Opis: </b>" + oTiketi[i].opis +
      "<br><br><b>Komentar gradske uprave: </b>" + sKomentar +
      "</p>" +
      "</div>" +
    "</div>";

    var infowindow = new google.maps.InfoWindow();

    var marker = new google.maps.Marker({
      map: map,
      position: JSON.parse(oTiketi[i].lokacija),
      title: 'Lokacija ticketa',
      icon:
      {
          url: sUrl
      }
    });



    google.maps.event.addListener(marker,'click', (function(marker,contentString,infowindow){ 
        return function() {
           infowindow.setContent(contentString);
           infowindow.open(map,marker);
        };
    })(marker,contentString,infowindow)); 
  }
}

function DajDane(sD, eD)
{
	var d1 = new Date(sD);
	var d2 = new Date(eD);

  console.log(sD);
  console.log(eD);

	var nDays = d2.getTime() - d1.getTime();

	nDays = Math.floor(nDays / (24 * 60 * 60 * 1000));

  console.log(nDays);

	return nDays;
}

function PretvoriuHR(datum)
{
  var dArr = datum.split('-');
  dArr = dArr.reverse(); 

  var hrDate = dArr.join('.');

  return hrDate;
}