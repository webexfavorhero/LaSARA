
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
    return $('#business-calendar').delegate("*", "focus blue", function() {
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
        } else if (elem_address.css("background-color") !== "#ff99cc") {
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
  });

}).call(this);

//# sourceMappingURL=module.js.map
