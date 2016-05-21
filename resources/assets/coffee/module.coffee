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
      else if elem_address.css("background-color") != "rgb(255, 153, 204)"
        elem_address.css({background: "#ccffcc"})
      $.get url, {name: name, id: id, val: val}, (response) ->
        console.log(response)
  ###
  # Business Calendar Order Check (Change Order Status - status of order/estimate. 0: empty(color-white), 1: estimate(color-green: #ccffcc), 2: order(color-pink: #ff99cc))
  ###
  $("input[name='address']").mousedown (event) ->
    if event.which == 3
      background_color = $(this).css("background-color")
      if background_color != "rgb(255, 255, 255)"
        event.preventDefault()
        id = $(this).attr('id')

        day = $(this).attr('day')
        man_num = $(this).attr('man_num')
        width_cell = $(this).attr('width_cell')
        height_cell = $(this).attr('height_cell')

        element = $("div[class='order_grid'][id=" + id + "]")
        element_other = $("div[class='order_grid'][id!=" + id + "]")

        display = element.css('display')
        each_width = $(this).outerWidth()
        each_height = $(this).outerHeight()

        elem_business_calendar = $("#business-calendar")
        constant_business_calendar_margin = elem_business_calendar.css("margin")
        constant_business_calendar_padding = elem_business_calendar.css("padding")

        constant_date_width = $("td[constant_width='date']").outerWidth()
        constant_item_width = $("td[constant_width='item']").outerWidth()
        constant_width = constant_business_calendar_margin + constant_business_calendar_padding + constant_date_width + constant_item_width

        constant_header_margin_top_height = $(".header").outerHeight()
        constant_thead_height = $("thead").outerHeight()
        constant_height = constant_business_calendar_margin + constant_business_calendar_padding + constant_header_margin_top_height + constant_thead_height

        width = constant_width + parseInt(man_num) * each_width * 2 + parseInt(width_cell) * each_width
        height = constant_height + parseInt(day) * 4 * 4 * each_height + parseInt(height_cell) * each_height * 4

        if display == 'none'
          element_other.fadeOut()
          element.fadeIn()
          element.css
            'display': 'inline'
            'left': width
            'top': height
        else
          element.fadeOut()
  ###
  # When click green span
  ###
  $("div.up").click () ->
    url = $("#updateOrderStateUrl").val()
    id = $(this).attr('id')
    $("input[name='address'][id="+id+"]").css("background-color", "#ccffcc")
    $.get url, {id: id, state: "1"}, (data) ->
      console.log(data)
  ###
  # When click pink span
  ###
  $("div.down").click () ->
    url = $("#updateOrderStateUrl").val()
    id = $(this).attr('id')
    $("input[name='address'][id="+id+"]").css("background-color", "#ff99cc")
    $.get url, {id: id, state: "2"}, (data) ->
      console.log(data)
  ###
  # Disabling order_div when clicking mouse button in other elements
  ###
  $("#business-calendar").click (event) ->
    if event.which != 3
      $("div.order_grid").fadeOut()

  ###
  # Preventing edit for input tag
  ###
  $('input.data').mousedown (event) ->
    elem = $(this)

    preMainDate    = $('#preMainDate').val()
    preOfficeManId = $('#preOfficeManId').val()

    busi_cal_id    = elem.attr('id')

    main_date     = $('#main_date' + busi_cal_id).val()
    office_man_id = $('#office_man_id' + busi_cal_id).val()
    editStatusUrl = $('#editStatusUrl').val()

    user = $('#user').val()

    $('#preMainDate').val(main_date)
    $('#preOfficeManId').val(office_man_id)

    $.get editStatusUrl, {
      busi_cal_id: busi_cal_id,
      user: user,
      preMainDate: preMainDate,
      preOfficeManId: preOfficeManId,
      main_date: main_date,
      office_man_id: office_man_id
    }, (data) ->
      if data == "refuse"
        elem.prop('readonly', true)
        alert('これは、別のユーザーが今編集されています。')
    return

  ###
  # Preventing edit for select tag
  ###
  $('select.data').mousedown (event) ->
    elem = $(this)

    preMainDate    = $('#preMainDate').val()
    preOfficeManId = $('#preOfficeManId').val()

    busi_cal_id    = elem.attr('id')

    main_date     = $('#main_date' + busi_cal_id).val()
    office_man_id = $('#office_man_id' + busi_cal_id).val()
    editStatusUrl = $('#editStatusUrl').val()

    user = $('#user').val()

    $('#preMainDate').val(main_date)
    $('#preOfficeManId').val(office_man_id)

    $.get editStatusUrl, {
      busi_cal_id: busi_cal_id,
      user: user,
      preMainDate: preMainDate,
      preOfficeManId: preOfficeManId,
      main_date: main_date,
      office_man_id: office_man_id
    }, (data) ->
      if data == "refuse"
        elem.prop('disabled', true)
        alert('これは、別のユーザーが今編集されています。')
    return


  ###
  # Construction Calendar
  ###

)
