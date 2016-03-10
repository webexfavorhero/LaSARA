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
  ###
  # Select Color Change
  ###
  $('.color-select').change ->
    current = $(this).val()
    if current == '1'
      $('.custom-color-label').css({color: '#000000', background: '#000000', border: '1px solid #000000'})
    else if current == '2'
      $('.custom-color-label').css({color: '#ff0000', background: '#ff0000', border: '1px solid #ff0000'})
    else if current == '3'
      $('.custom-color-label').css({color: '#0000ff', background: '#0000ff', border: '1px solid #0000ff'})
)
