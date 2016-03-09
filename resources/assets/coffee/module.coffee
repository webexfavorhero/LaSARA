###
# jQuery functions
###
$( ->
  ###
  # permission checking
  ###
  $('#permissionCheck').click ->
    if $(this).is(":checked")
      $('#permission').val('1')
    else if $(this).is(":not(:checked)")
      $('#permission').val('0')
  ###
  # Update function
  ###
  $('.td-edit-cell').click ->
    num = $(this).attr('data-num')
    id = document.getElementById('id' + num).value
    scope = document.getElementById('scope').value
    category = document.getElementById('category').value
    location.href = '/' + scope + '/' + category + '/' + id + '/edit'
  ###
  # Delete function
  ###
  $('.td-remove-cell').click ->
    if (confirm('あなたが本当にこれを削除しますか？'))
      num = $(this).attr('data-num')
      id = document.getElementById('id' + num).value
      scope = document.getElementById('scope').value
      category = document.getElementById('category').value
      location.href = '/' + scope + '/' + category + '/' + id + '/delete'
)
