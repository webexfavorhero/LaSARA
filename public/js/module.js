
/*
 * jQuery functions
 */

(function() {
  $(function() {

    /*
     * permission checking
     */
    $('#permissionCheck').click(function() {
      if ($(this).is(":checked")) {
        return $('#permission').val('1');
      } else if ($(this).is(":not(:checked)")) {
        return $('#permission').val('0');
      }
    });

    /*
     * Update function
     */
    $('.td-edit-cell').click(function() {
      var category, id, num, scope;
      num = $(this).attr('data-num');
      id = $('#id' + num).val();
      scope = $('#scope').val();
      category = $('#category').val();
      return location.href = '/' + scope + '/' + category + '/' + id + '/edit';
    });

    /*
     * Delete function
     */
    $('.td-remove-cell').click(function() {
      var category, id, num, scope;
      num = $(this).attr('data-num');
      id = $('#id' + num).val();
      scope = $('#scope').val();
      category = $('#category').val();
      if (confirm('あなたが本当にこれを削除しますか？')) {
        return location.href = '/' + scope + '/' + category + '/' + id + '/delete';
      }
    });

    /*
     * Select Color Change
     */
    $('.color-select').change(function() {
      var current;
      current = $(this).val();
      if (current === '1') {
        return $('.custom-color-label').css({
          color: '#000000',
          background: '#000000',
          border: '1px solid #000000'
        });
      } else if (current === '2') {
        return $('.custom-color-label').css({
          color: '#ff0000',
          background: '#ff0000',
          border: '1px solid #ff0000'
        });
      } else if (current === '3') {
        return $('.custom-color-label').css({
          color: '#0000ff',
          background: '#0000ff',
          border: '1px solid #0000ff'
        });
      }
    });

    /*
     * Select Office Change
     */
    $('.office_select').change(function() {
      var current, route;
      current = $(this).val();
      route = $('#url').val();
      return $.get(route, {
        office_id: current
      }, function(data) {
        $('.company_select').empty();
        return $.each(JSON.parse(data), function(index, companyObj) {
          return $('.company_select').append('<option value="' + companyObj.id + '">' + companyObj.company_name + '</option>');
        });
      });
    });

    /*
     * Business Calendar Enter Value (update database leaving focus triggered)
     */
    $('#business-calendar').delegate("*", "focus blue", function() {
      var elem;
      elem = $(this);
      return elem.blur(function() {
        var elem_address, elem_address_val, elem_field_name_val, elem_time, elem_trans_item_id_val, id, name, url, val;
        url = $('#url').val();
        name = elem.attr('name');
        id = elem.attr('id');
        val = elem.val();
        elem_address = $("input[id=" + id + "][name='address']");
        if (val === "" || val === '0') {
          elem_address_val = elem_address.val();
          elem_field_name_val = $("input[id=" + id + "][name='field_name']").val();
          elem_trans_item_id_val = $("select[id=" + id + "][name='trans_item_id']").val();
          elem_time = $("input[id=" + id + "][name='time']").val();
          if (elem_address_val === "" && elem_field_name_val === "" && elem_trans_item_id_val === "0" && elem_time === "") {
            elem_address.css({
              background: "#ffffff"
            });
          }
        } else if (elem_address.css("background-color") !== "rgb(255, 153, 204)") {
          elem_address.css({
            background: "#ccffcc"
          });
        }
        return $.get(url, {
          name: name,
          id: id,
          val: val
        }, function(response) {
          return console.log(response);
        });
      });
    });

    /*
     * Business Calendar Order Check (Change Order Status - status of order/estimate. 0: empty(color-white), 1: estimate(color-green: #ccffcc), 2: order(color-pink: #ff99cc))
     */
    $("input[name='address']").mousedown(function(event) {
      var background_color, constant_business_calendar_margin, constant_business_calendar_padding, constant_date_width, constant_header_margin_top_height, constant_height, constant_item_width, constant_thead_height, constant_width, day, display, each_height, each_width, elem_business_calendar, element, element_other, height, height_cell, id, man_num, width, width_cell;
      if (event.which === 3) {
        background_color = $(this).css("background-color");
        if (background_color !== "rgb(255, 255, 255)") {
          event.preventDefault();
          id = $(this).attr('id');
          day = $(this).attr('day');
          man_num = $(this).attr('man_num');
          width_cell = $(this).attr('width_cell');
          height_cell = $(this).attr('height_cell');
          element = $("div[class='order_grid'][id=" + id + "]");
          element_other = $("div[class='order_grid'][id!=" + id + "]");
          display = element.css('display');
          each_width = $(this).outerWidth();
          each_height = $(this).outerHeight();
          elem_business_calendar = $("#business-calendar");
          constant_business_calendar_margin = elem_business_calendar.css("margin");
          constant_business_calendar_padding = elem_business_calendar.css("padding");
          constant_date_width = $("td[constant_width='date']").outerWidth();
          constant_item_width = $("td[constant_width='item']").outerWidth();
          constant_width = constant_business_calendar_margin + constant_business_calendar_padding + constant_date_width + constant_item_width;
          constant_header_margin_top_height = $(".header").outerHeight();
          constant_thead_height = $("thead").outerHeight();
          constant_height = constant_business_calendar_margin + constant_business_calendar_padding + constant_header_margin_top_height + constant_thead_height;
          width = constant_width + parseInt(man_num) * each_width * 2 + parseInt(width_cell) * each_width;
          height = constant_height + parseInt(day) * 4 * 4 * each_height + parseInt(height_cell) * each_height * 4;
          if (display === 'none') {
            element_other.fadeOut();
            element.fadeIn();
            return element.css({
              'display': 'inline',
              'left': width,
              'top': height
            });
          } else {
            return element.fadeOut();
          }
        }
      }
    });

    /*
     * When click green span
     */
    $("div.up").click(function() {
      var id, url;
      url = $("#updateOrderStateUrl").val();
      id = $(this).attr('id');
      $("input[name='address'][id=" + id + "]").css("background-color", "#ccffcc");
      return $.get(url, {
        id: id,
        state: "1"
      }, function(data) {
        return console.log(data);
      });
    });

    /*
     * When click pink span
     */
    $("div.down").click(function() {
      var id, url;
      url = $("#updateOrderStateUrl").val();
      id = $(this).attr('id');
      $("input[name='address'][id=" + id + "]").css("background-color", "#ff99cc");
      return $.get(url, {
        id: id,
        state: "2"
      }, function(data) {
        return console.log(data);
      });
    });

    /*
     * Disabling order_div when clicking mouse button in other elements
     */
    return $("#business-calendar").click(function(event) {
      if (event.which !== 3) {
        return $("div.order_grid").fadeOut();
      }
    });
  });

}).call(this);

//# sourceMappingURL=module.js.map
