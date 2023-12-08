define(
  [
    "jQuery",
    "toastr",
    "metismenu",
    "blockui",
    "scrollbar",
    "architect",
    "bootstrap"
  ],
  function($, toastr, metismenu, blockUI, scrollbar, architect) {
    return {
      clickEvent: "click",
      baseUrl: $("#base_url").val(),
      initFunc: function() {
        console.log("INIT FUNCTION");
        $.blockUI.defaults = {
          timeout: 1000,
          fadeIn: 200,
          fadeOut: 400
        };
        $.blockUI({ message: $(".body-block-example-1") });

        setTimeout(function() {
          if ($(".scrollbar-container")[0]) {
            $(".scrollbar-container").each(function() {
              const ps = new scrollbar($(this)[0], {
                wheelSpeed: 2,
                wheelPropagation: false,
                minScrollbarLength: 20
              });
            });

            const ps = new scrollbar(".scrollbar-sidebar", {
              wheelSpeed: 2,
              wheelPropagation: true,
              minScrollbarLength: 20
            });
          }
        }, 1000);

        App.initToast();
        App.initValidationForm();
      },
      initToast: function() {
        toastr.options.preventDuplicates = true;
        toastr.options.timeOut = 1000;
        toastr.options.positionClass = "toast-top-right";

        if ($("#display_alert_message").val() != undefined) {
          toastr.options.timeOut = 3000;
          toastr.success($("#display_alert_message").val());
        }
        if ($("#display_alert_message_error").val() != undefined) {
          toastr.options.timeOut = 3000;
          toastr.error($("#display_alert_message_error").val());
        }
        if ($("#display_alert_validation_errors").val() != undefined) {
          toastr.options.timeOut = 3000;
          toastr.error($("#display_alert_validation_errors").val());
        }
        if ($("#display_alert_message_get_true").val() != undefined) {
          toastr.options.timeOut = 3000;
          toastr.success($("#display_alert_message_get_true").val());
        }
        if ($("#display_alert_message_get_false").val() != undefined) {
          toastr.options.timeOut = 3000;
          toastr.error($("#display_alert_message_get_false").val());
        }
      },
      initValidationForm: function() {
        $(".number").keydown(function(e) {
          // Allow: backspace, delete, tab, escape, enter and .
          if (
            $.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)
          ) {
            // let it happen, don't do anything
            return;
          }
          // Ensure that it is a number and stop the keypress
          if (
            (e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) &&
            (e.keyCode < 96 || e.keyCode > 105)
          ) {
            e.preventDefault();
          }
        });
      },
      alert: function(msg, callback) {
        $("#alert_modal .modal-title").text("");
        // if (title != undefined && title != false && title != "") {
        //     $("#alert_modal .modal-title").text(title);
        // }
        $(".alert-msg").text(msg);
        $(".alert-cancel").hide();
        $(".alert-ok").show();

        $("#alert_modal").modal("show");

        $("#alert_modal .alert-ok").bind(App.clickEvent, function(e) {
          if (callback != undefined && callback != null && callback != false) {
            callback();
          }

          setTimeout(function() {
            $("#alert_modal").modal("hide");
          }, 200);

          e.preventDefault();
          $(this).unbind();
        });
      },
      confirm: function(msg, callbackOk, callbackCancel) {
        $("#alert_modal .modal-title").text("");
        // if (title != undefined && title != false && title != "") {
        //     $("#alert_modal .modal-title").text(title);
        // }

        $(".alert-msg").text(msg);
        $(".alert-cancel").show();
        $(".alert-ok").show();

        $("#alert_modal").modal("show");

        $("#alert_modal .alert-ok").bind(App.clickEvent, function(e) {
          if (
            callbackOk != undefined &&
            callbackOk != null &&
            callbackOk != false
          ) {
            callbackOk();
          }
          setTimeout(function() {
            $("#alert_modal").modal("hide");
          }, 200);

          e.preventDefault();
          $(this).unbind();
          $("#alert_modal .alert-cancel").unbind();
        });

        $("#alert_modal .alert-cancel").bind(App.clickEvent, function(e) {
          if (
            callbackCancel != undefined &&
            callbackCancel != null &&
            callbackCancel != false
          ) {
            callbackCancel();
          }
          setTimeout(function() {
            $("#alert_modal").modal("hide");
          }, 200);

          e.preventDefault();
          $(this).unbind();
          $("#alert_modal .alert-ok").unbind();
        });
      },
      approval: function(msg, callbackOk, callbackCancel) {
        $("#alert_approval .modal-title").text("");

        $(".alert-msg").text(msg);
        $(".alert-cancel").show();
        $(".alert-reject").show();
        $(".alert-approve").show();

        $("#alert_approval").modal("show");
        $("#alert_approval .alert-cancel").bind(App.clickEvent, function(e) {
          setTimeout(function() {
            $("#alert_approval").modal("hide");
          }, 200);

          e.preventDefault();
          $(this).unbind();
          $("#alert_approval .alert-approve").unbind();
        });
        $("#alert_approval .alert-approve").bind(App.clickEvent, function(e) {
          if (
            callbackOk != undefined &&
            callbackOk != null &&
            callbackOk != false
          ) {
            callbackOk();
          }
          setTimeout(function() {
            $("#alert_approval").modal("hide");
          }, 200);

          e.preventDefault();
          $(this).unbind();
          $("#alert_approval .alert-cancel").unbind();
        });

        $("#alert_approval .alert-reject").bind(App.clickEvent, function(e) {
          if (
            callbackCancel != undefined &&
            callbackCancel != null &&
            callbackCancel != false
          ) {
            callbackCancel();
          }
          setTimeout(function() {
            $("#alert_approval").modal("hide");
          }, 200);

          e.preventDefault();
          $(this).unbind();
          $("#alert_approval .alert-ok").unbind();
        });
      },
      format: function(obj) {
        var restoreMoneyValueFloat = function(obj) {
          var r = obj.value.replace(/\./g, "");
          r = r.replace(/,/, "#");
          r = r.replace(/,/g, "");
          r = r.replace(/#/, ".");
          return r;
        };

        var getDecimalSeparator = function() {
          var f = parseFloat(1 / 4);
          var n = new Number(f);
          var r = new RegExp(",");
          if (r.test(n.toLocaleString())) return ",";
          else return ".";
        };

        if (obj.value == "-") return;

        var val = restoreMoneyValueFloat(obj);

        var myreg = /\.([0-9]*)$/;
        var adakoma = myreg.test(val);
        var lastkoma = adakoma ? RegExp.$1 == "" : false;

        myreg = /\.(0+)$/;
        var lastnol = adakoma && myreg.test(val);

        myreg = /(0+)$/;
        var tailnol = adakoma && myreg.test(val);
        var adanol = tailnol ? RegExp.$1 : "";

        var n = parseFloat(val);

        n = isNaN(n) ? 0 : n;
        //if (entryFormatMoney.arguments[1] && n > entryFormatMoney.arguments[1]) n = entryFormatMoney.arguments[1];
        var n = new Number(n);
        var r = n.toLocaleString();

        if (getDecimalSeparator() == ".") {
          r = r.replace(/\./g, "#");
          r = r.replace(/,/g, ".");
          r = r.replace(/#/g, ",");
        }

        myreg = /([0-9\.]*)(,?[0-9]{0,4})/;
        if (myreg.test(r)) {
          r = RegExp.$1 + RegExp.$2;
        }

        obj.value =
          r + (lastkoma || lastnol ? "," : "") + (tailnol ? adanol : "");
      },
      // fungsi untuk mengembalikan nilai 122.311.312 tanpa tanda titik sebelum submit form.
      noFormattedNumber: function(element) {
        if (Array.isArray(element)) {
          $.each(element, function(index, value) {
            this.noFormattedNumber(value);
          });
        }

        var val;
        function restoreMoneyValueFloatFromStr(str) {
          // fungsi ini utk mengembalikan string dari format money standar ke nilai float
          // nilai float dengan saparator decimal titik biar php/javascript bisa parsing
          var rr = new String(str);
          var r = rr.replace(/ /g, "");
          r = r.replace(/\./g, "");
          r = r.replace(/,/, "#");
          r = r.replace(/,/g, "");
          r = r.replace(/#/, ".");
          return r;
        }
        val = restoreMoneyValueFloatFromStr($(element).val());
        $(element).val(val);
      }
    };
  }
);
