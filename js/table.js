var oTiketi = [];
var nTrenutnaStranica = 0;
var nRowsPerPage = 10;
var idTicketa;
var oTable;
var map;
var marker;
var infowindow;
var trenutniFilter = 'Ne';


$( document ).ready(function() {
   var d = new Date();
    switch(true)
    {
        case(d.getHours() >= 0 && d.getHours() < 12):
            $('#greeting').text('Dobro jutro');
        break;

        case(d.getHours() >= 12 && d.getHours() < 18):
            $('#greeting').text('Dobar dan');
        break;

        case(d.getHours() >= 18 && d.getHours() <= 23):
            $('#greeting').text('Dobra večer');
        break;
    }

    $('#name').text(localStorage.getItem('name'));

    $('#firstPage').attr('disabled', 'true');
    $('#previousPage').attr('disabled', 'true');

    if(localStorage.getItem('administrator') == 0)
    {
        $('.adminOnly').css('display', 'none');
    }
});

function splitToPages(array, num)
{
    var splitArray = [];

    while(array.length)
    {
        splitArray.push(array.splice(0, num));
    }

    return splitArray;
}

function GetModal(sHref) {
    $('#myModal').removeData('bs.modal');
    $('#myModal').modal
        ({
            remote:sHref,
            show: true
        });
}

function DateTimePickerFunkcija(inputId)
{
	$(inputId).datetimepicker({
		format: "DD.MM.YYYY",
		locale: "hr",
        useCurrent: false,
		widgetPositioning: {
			horizontal: 'auto',
			vertical: 'bottom'
		}
	});
}

function ConvertToISO(d)
{
    var datestring = '';

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

function ConvertFromHRtoISO(d)
{
    var dArr = d.split('.');
    dArr = dArr.reverse();

    var dateString = dArr.join('-');

    return dateString;
}

function DajDatum()
{
	var d = new Date();
    var datestring = ConvertToISO(d);

    return datestring;
}

function DajTickete()
{
    var oTicketi = []
    $.ajax({
            type: "GET",
            url: 'json.php',
            data:
            {
                json_id: "prikazi_podatke"
            },
            success: function (oData) {
                oTicketi = splitToPages(oData, nRowsPerPage);

                if(oTicketi.length == 1)
                {
                    $('.page-btn').attr('disabled', 'true');
                }
                else
                {
                    $('#firstPage').attr('disabled', 'true');
                    $('#previousPage').attr('disabled', 'true');
                }
            },
            error: function (XMLHttpRequest, textStatus, exception) {
                console.log(textStatus);
            },
            async: false
    });

    return oTicketi;
}

var oModul = angular.module('tiketiModul', []);

oModul.controller('tiketiKontroler', function ($scope) {
    oTiketi = DajTickete();
    $scope.oTiketi = oTiketi[0];

    $scope.filterTickets = function(filterType)
    {
        switch(filterType)
        {

            case('ukloni_filter'):
                nTrenutnaStranica = 0;
                oTiketi = DajTickete();

                $('#firstPage').attr('disabled', 'true');
                $('#previousPage').attr('disabled', 'true');

                if(oTiketi.length == 1)
                {
                   $('.page-btn').attr('disabled', 'true');
                }
                else
                {
                   $('#nextPage').removeAttr('disabled');
                   $('#lastPage').removeAttr('disabled');
                } 
                    
                $scope.oTiketi = oTiketi[0];
            break;

            case('filtriraj_po_datumu'):
                if($.trim($('#inptDatum').val()) != '')
                {
                    var sDatum = $('#inptDatum').data("DateTimePicker").date().format('YYYY-MM-DD');
                    $.ajax({
                          type: "GET",
                          url: 'json.php',
                          data:
                          {
                            json_id: "filtriraj_po_datumu",
                            datum: sDatum
                          },
                          success: function (oData) {
                            var oTicketi = splitToPages(oData, nRowsPerPage);             
                            nTrenutnaStranica = 0;                           

                            oTiketi = oTicketi;

                            if(oTicketi.length == 1)
                            {
                                $('.page-btn').attr('disabled', 'true');
                            }
                            else
                            {
                                $('#firstPage').attr('disabled', 'true');
                                $('#previousPage').attr('disabled', 'true');
                            }                           
                          },
                          error: function (XMLHttpRequest, textStatus, exception) {
                            console.log(textStatus);
                          },
                          async: false
                    });

                    $scope.oTiketi = oTiketi[0];
                }
                else
                {
                   $('.alert').css('display', 'block');
                   $('.alert').text('Niste unijeli datum!');
                }
            break;

            case('filtriraj_po_statusu'):
                var idStatusa = $('#selectFilterStatus').val();
                $.ajax({
                        type: "GET",
                        url: 'json.php',
                        data:
                        {
                            json_id: "filtriraj_po_statusu",
                            status: idStatusa
                        },
                        success: function (oData) {
                            var oTicketi = splitToPages(oData, nRowsPerPage);
                            nTrenutnaStranica = 0;                           

                            oTiketi = oTicketi;

                            if(oTicketi.length == 1)
                            {
                                $('.page-btn').attr('disabled', 'true');
                            }
                            else
                            {
                                $('#firstPage').attr('disabled', 'true');
                                $('#previousPage').attr('disabled', 'true');
                            }
                        },
                        error: function (XMLHttpRequest, textStatus, exception) {
                            console.log(textStatus);
                        },
                        async: false
                });

                $scope.oTiketi = oTiketi[0];
            break;
        }
    }

    $scope.openTicket = function(tiket)
    {
        localStorage.setItem("tiket", JSON.stringify(tiket)); 

        window.open('ticket.php');
    }

    $scope.deleteTicketModal = function(tiketId)
    {
        if(localStorage.getItem('administrator') == 1)
        {
            GetModal('modals.php?modal_id=obrisi_ticket&id_ticketa='+ tiketId +'');
        }
        else
        {
            $('.alert').css('display', 'block');
            $('.alert').text('Nemate administratorske ovlasti!');
        }
    }

    $scope.changePage = function(movement)
    {
        switch(movement)
        {
            case 'firstPage':
                $scope.oTiketi = oTiketi[0];
                nTrenutnaStranica = 0;

                $('#firstPage').attr('disabled', 'true');
                $('#previousPage').attr('disabled', 'true');
                $('#nextPage').removeAttr('disabled');
                $('#lastPage').removeAttr('disabled');
            break;

            case 'previousPage':
                nTrenutnaStranica--;
                $scope.oTiketi = oTiketi[nTrenutnaStranica];

                $('#nextPage').removeAttr('disabled');
                $('#lastPage').removeAttr('disabled');

                if(nTrenutnaStranica == 0)
                {
                    $('#firstPage').attr('disabled', 'true');
                    $('#previousPage').attr('disabled', 'true');
                }
            break;

            case 'nextPage':
                nTrenutnaStranica++;
                $scope.oTiketi = oTiketi[nTrenutnaStranica];

                $('#firstPage').removeAttr('disabled');
                $('#previousPage').removeAttr('disabled');

                if((nTrenutnaStranica + 1) == oTiketi.length)
                {
                    $('#nextPage').attr('disabled', 'true');
                    $('#lastPage').attr('disabled', 'true');
                }
            break;

            case 'lastPage':
                nTrenutnaStranica = oTiketi.length - 1;
                $scope.oTiketi = oTiketi[nTrenutnaStranica];

                $('#firstPage').removeAttr('disabled');
                $('#previousPage').removeAttr('disabled');
                $('#nextPage').attr('disabled', 'true');
                $('#lastPage').attr('disabled', 'true');
            break;
        }
    }

    $scope.solved = function(id)
    {
        sDatum = DajDatum();

        $.ajax({
            type: "POST",
            url: 'action.php',
            data:
            {
                action_id:'azuriraj_status',
                id: id,
                status: 1,
                datum: sDatum 
               
            },
            success: function (oData)
            {
                var updatedRow = false;

                for(var i = 0; i < oTiketi.length; i++)
                {
                    for(var j = 0; j < oTiketi[i].length; j++)
                    {
                        if(oTiketi[i][j].id == id)
                        {
                            oTiketi[i][j].status = 1;
                            oTiketi[i][j].statusNaziv = 'Riješen';
                            oTiketi[i][j].datum_end = sDatum;

                            updatedRow = true;
                            break;
                        }
                    }

                    if(updatedRow == true)
                    {
                        break;
                    }
                }

              
                $('.alert').css('display', 'block');
                $('.alert').text('Tiket uspješno zatvoren!');
            },
            error: function (XMLHttpRequest, textStatus, exception) {
                console.log("Ajax failure\n");
            },
            async: false
        });

        $scope.oTiketi = oTiketi[nTrenutnaStranica];
    }

    $scope.sortByDate = function()
    {
        var order = $('#selectSorter').val();
        console.log(order);

        switch(order)
        {
            case 'descending':
                var MergedArray = oTiketi[0];

                for(var i = 1; i < oTiketi.length; i++)
                {
                    MergedArray = MergedArray.concat(oTiketi[i]);
                }

                MergedArray.sort(function(a, b)
                {
                    return new Date(ConvertFromHRtoISO(b.datum_start)) - new Date(ConvertFromHRtoISO(a.datum_start));
                });

                oTiketi = splitToPages(MergedArray, nRowsPerPage);             

                var nTrenutnaStranica = 0;

                $scope.oTiketi = oTiketi[nTrenutnaStranica];
            break;

            case 'ascending':
                var MergedArray = oTiketi[0];

                for(var i = 1; i < oTiketi.length; i++)
                {
                    MergedArray = MergedArray.concat(oTiketi[i]);
                }
                
                MergedArray.sort(function(a, b)
                {
                    return new Date(ConvertFromHRtoISO(a.datum_start)) - new Date(ConvertFromHRtoISO(b.datum_start));
                });

                oTiketi = splitToPages(MergedArray, nRowsPerPage);

                var nTrenutnaStranica = 0;
              
                $scope.oTiketi = oTiketi[nTrenutnaStranica];
            break;
        }
    }
});


function ObrisiTicket(item)
{
    $.ajax({
        type: "POST",
        url: 'action.php',
        data:
        {
            action_id:'obrisi_ticket',           
            id_ticketa: item
        },
        success: function (oData)
        {
            $("#myModal").modal('hide');

            oTiketi = DajTickete();
            var scope = angular.element(document.getElementById('body')).scope();

            nTrenutnaStranica = 0;

            scope.oTiketi = oTiketi[nTrenutnaStranica];
            scope.$apply();
            
            $('.alert').css('display', 'block');
            $('.alert').text('Tiket uspješno izbrisan.');
        },
        error: function (XMLHttpRequest, textStatus, exception) {
            console.log("Ajax failure\n");
        },
        async: true
    });
}

function Odjava()
{
	localStorage.setItem('loggedIn', 'false');
	window.open('login.php', '_self');
}


function PrikaziFiltere()
{
    switch($('#filterContent').css('display'))
    {
        case 'none':
            $('#filterContent').css('display', 'block');
        break;

        case 'block':
            $('#filterContent').css('display', 'none');
        break;
    }
}

function createReportModal()
{
    setTimeout(function () {
            DateTimePickerFunkcija('#inptStartDatum');
            DateTimePickerFunkcija('#inptEndDatum');
        }, 200);

    GetModal('modals.php?modal_id=napravi_izvjesce');
}

function NovoIzvjesce()
{
    if($.trim($('#inptStartDatum').val()) && $.trim($('#inptEndDatum').val()))
    {
        var sStartDatum = $('#inptStartDatum').data("DateTimePicker").date().format('YYYY-MM-DD');
        var sEndDatum = $('#inptEndDatum').data("DateTimePicker").date().format('YYYY-MM-DD');

        var startDate = new Date(sStartDatum);
        var endDate = new Date(sEndDatum);

        if(startDate.getTime() < endDate.getTime())
        {
            var sDatumi = [];
            sDatumi.push('\''+ sStartDatum + '\'');

            var sTrenutniDatum = sStartDatum;

            while(sTrenutniDatum != sEndDatum)
            {
                var date = new Date(sTrenutniDatum);
                date.setDate(date.getDate() + 1);

                sTrenutniDatum = ConvertToISO(date);

                sDatumi.push('\'' + sTrenutniDatum + '\'');
            }

            var sDatumiString = sDatumi.join(', ');

            $.ajax({
                    type: "GET",
                    url: 'json.php',
                    data:
                    {
                        json_id: "filtriraj_po_datumima",
                        datumi: sDatumiString
                    },
                    success: function (oData) {
                        if(oData[0] != undefined)
                        {
                            localStorage.setItem('startDatum', sStartDatum);
                            localStorage.setItem('endDatum', sEndDatum);
                            localStorage.setItem('tiketi', JSON.stringify(oData));              

                            $("#myModal").modal('hide');
                            window.open('report.php');
                        }
                        else
                        {
                            alert('Nema tiketa u ovom vremenskom razdoblju!');
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
            alert('Početni datum mora biti prije završnog!');
        }
    }
    else
    {
        alert('Niste unijeli oba datuma!');
    }
}

function paginate()
{
    nRowsPerPage = $('#selectPagination').val();

    var MergedArray = oTiketi[0];

    for(var i = 1; i < oTiketi.length; i++)
    {
        MergedArray = MergedArray.concat(oTiketi[i]);
    }
            
    oTiketi = splitToPages(MergedArray, nRowsPerPage);    
    var nTrenutnaStranica = 0;  
    var scope = angular.element(document.getElementById('body')).scope(); 

    scope.oTiketi = oTiketi[nTrenutnaStranica];

    scope.$apply();
}

