function navigate(event) {

  // Prevent default click action
  event.preventDefault();

  navigateTo($(this).attr('href'));
  return false;
}

function navigateTo(url, params = { }, pushState = true)
{
  if(pushState)
    history.pushState(params, null, url);
  var mainblock = $('html');
  $.post(url, params)
  .done(function(data) {
    mainblock.html(data);
  });
}