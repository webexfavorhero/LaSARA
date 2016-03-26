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
  ###
  # Select Office Change
  ###
  $('.office_select').change ->
    current = $(this).val()
    route = $('#url').val()
    $.get route, {office_id: current}, (data) ->
      $('.company_select').empty()
      $.each JSON.parse(data), (index, companyObj) ->
        $('.company_select').append('<option value="'+companyObj.id+'">'+companyObj.company_name+'</option>')
  ###
  # Business Calendar Enter Value (update database leaving focus triggered)
  ###
  $('#business-calendar').delegate "*", "focus blue", ->
    elem = $(this)
    elem.blur () ->
      url = $('#url').val()
      name = elem.attr('name')
      id = elem.attr('id')
      val = elem.val()
      elem_address = $("input[id=" + id + "][name='address']")
      if val == "" || val == '0'
        elem_address_val = elem_address.val();
        elem_field_name_val = $("input[id=" + id + "][name='field_name']").val();
        elem_trans_item_id_val = $("select[id=" + id + "][name='trans_item_id']").val();
        elem_time = $("input[id=" + id + "][name='time']").val();
        if elem_address_val == "" && elem_field_name_val == "" && elem_trans_item_id_val == "0" && elem_time == ""
          elem_address.css({background: "#ffffff"})
      else if elem_address.css("background-color") != "#ff99cc"
        elem_address.css({background: "#ccffcc"})
      $.get url, {name: name, id: id, val: val}, (response) ->
        console.log(response)
)
