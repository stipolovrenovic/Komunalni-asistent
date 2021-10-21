$( document ).ready(function() {
  if(localStorage.getItem('message') && localStorage.getItem('alertClass'))
  {
    $('.alert').css('display', 'block');
    $('.alert').attr(
    {
      'class': 'alert ' + localStorage.getItem('alertClass')
    })
    $('.alert').text(localStorage.getItem('message'));

    localStorage.removeItem('message');
    localStorage.removeItem('alertClass');
  }
});