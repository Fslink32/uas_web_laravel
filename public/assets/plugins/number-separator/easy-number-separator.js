$(document).ready(function() {
  $(document).on("input", ".number-separator", function(e) {
    let num = $(this).val();
    if (/^[0-9.-]+$/.test(num)) {
      var num1 = num;
      if (num.charAt(0) == "-") {
        console.log(num.slice(1));
        num1 = num.substring(1);
      }
      var oldval = num1.replace(/\./g, "");
      if (oldval != "") {
        if (num.charAt(0) == "-") {
          var newval = parseFloat(oldval.replace(/\,/g, ""))
            .toLocaleString("en")
            .replace(/,/g, ".");
          $(this).val("-" + newval.toString());
        } else {
          var newval = parseFloat(oldval.replace(/\,/g, ""))
            .toLocaleString("en")
            .replace(/,/g, ".");
          $(this).val(newval.toString());
        }
      }
    } else {
      $(this).val($(this).val().substring(0, $(this).val().length - 1));
    }
  });
  $(document).on("input", ".percentage", function(e) {
    var max = $(this).data("max") ? parseInt($(this).data("max")) : 100;
    if (/^[0-9.]+$/.test($(this).val())) {
      var value = $(this).val().replace(/^(?!.*\..)[0](?=[A-Za-z][^\.])/, "");

      // console.log($(this).val());
      var separate_str = value.split(".");
      if (separate_str[0] >= max) {
        $(this).val(max);
      } else {
        if (separate_str[1]) {
          $(this).val(
            parseInt(separate_str[0]) + "." + separate_str[1].substring(0, 2)
          );
        } else if (!value.includes(".")) {
          $(this).val(parseInt(separate_str[0]));
        }
      }
    } else {
      if ($(this).val() == "") {
        $(this).val(0);
        return;
      }
      $(this).val($(this).val().substring(0, $(this).val().length - 1));
    }
  });
});
