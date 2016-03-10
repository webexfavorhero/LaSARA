
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
    return $('.color-select').change(function() {
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
  });

}).call(this);

//# sourceMappingURL=module.js.map
