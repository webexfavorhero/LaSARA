
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
      id = document.getElementById('id' + num).value;
      scope = document.getElementById('scope').value;
      category = document.getElementById('category').value;
      return location.href = '/' + scope + '/' + category + '/' + id + '/edit';
    });

    /*
     * Delete function
     */
    return $('.td-remove-cell').click(function() {
      var category, id, num, scope;
      if (confirm('あなたが本当にこれを削除しますか？')) {
        num = $(this).attr('data-num');
        id = document.getElementById('id' + num).value;
        scope = document.getElementById('scope').value;
        category = document.getElementById('category').value;
        return location.href = '/' + scope + '/' + category + '/' + id + '/delete';
      }
    });
  });

}).call(this);

//# sourceMappingURL=module.js.map
