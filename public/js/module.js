(function() {
  $(function() {
    return $('#permissionCheck').click(function() {
      if ($(this).is(":checked")) {
        return $('#permission').val('1');
      } else if ($(this).is(":not(:checked)")) {
        return $('#permission').val('0');
      }
    });
  });

}).call(this);

//# sourceMappingURL=module.js.map
