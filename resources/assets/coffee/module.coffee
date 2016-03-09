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
    id = $('#id' + num).val()
    scope = $('#scope').val()
    category = $('#category').val()
    location.href = '/' + scope + '/' + category + '/' + id + '/edit'
  ###
  # Delete function
  ###
  $('.td-remove-cell').click ->
    num = $(this).attr('data-num')
    id = $('#id' + num).val()
    scope = $('#scope').val()
    category = $('#category').val()
    if (confirm('あなたが本当にこれを削除しますか？'))
      location.href = '/' + scope + '/' + category + '/' + id + '/delete'
)
