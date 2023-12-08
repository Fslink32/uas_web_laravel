define(
  [
    "jQuery",
    "jQueryUI",
    "bootstrap",
    "datatablesBootstrap",
    "datatablesResponsive",
    "toastr",
    "jValidate",
    "select2"
  ],
  function(
    $,
    jQueryUI,
    bootstrap,
    datatablesBootstrap,
    datatablesResponsive,
    toastr,
    jValidate,
    select2
  ) {
    return {
      table: null,
      init: function() {
        App.initFunc();
        App.initSelect2();
        App.initTable();
        App.initTableClick();
        App.clearData();
        App.initForm();
        App.initPrivileges();
      },

      initSelect2: function() {
        $('*select[data-selectjs="true"]').select2({ width: "100%" });
        $('#modal_create *select[data-selectjs="true"]').select2({
          dropdownParent: $("#modal_create"),
          width: "100%"
        });
        $('#modal_edit *select[data-selectjs="true"]').select2({
          dropdownParent: $("#modal_edit"),
          width: "100%"
        });
        $('#modal_privilege *select[data-selectjs="true"]').select2({
          dropdownParent: $("#modal_privilege"),
          width: "100%"
        });
      },
      initTable: function() {
        App.table = $("#table").DataTable({
          bPaginate: true,
          bLengthChange: true,
          bFilter: true,
          bInfo: true,
          searching: true,
          responsive: true,
          language: {
            search: "Cari",
            lengthMenu: "Lihat _MENU_ data",
            zeroRecords: "Tidak ada data yang ditemukan",
            info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ data",
            infoEmpty: "Tidak ada data di dalam tabel",
            infoFiltered: "(cari dari _MAX_ total catatan)",
            loadingRecords: "Loading...",
            processing: "Processing...",
            paginate: {
              first: "Pertama",
              last: "Terakhir",
              next: "Selanjutnya",
              previous: "Sebelumnya"
            }
          },
          order: [[0, "asc"]],
          processing: true,
          serverSide: true,
          ajax: {
            headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: App.baseUrl + "admin/role/dataList",
            dataType: "json",
            type: "POST"
          },
          columns: [
            { data: "name" },
            { data: "is_deleted" },
            { data: "action", orderable: false }
          ]
        });
      },

      initTableClick: function() {
        $("#role").on("change", function() {
          var id = $(this).val();
          $.ajax({
            url: App.baseUrl + "role/getPrivillege",
            type: "GET",
            data: { id: id }
          })
            .done(function(response) {
              var data = JSON.parse(response);

              var warna = [
                "blue",
                "lime",
                "orange",
                "teal",
                "red",
                "purple",
                "pink",
                "azure",
                "green",
                "indigo",
                "yellow",
                "cyan"
              ];
              var multi = "";
              var cloud = "";
              var local = "";
              var result = data.data;
              for (var i = 0; i < result.length; i++) {
                cloud += "<tr>";
                //checkbox
                cloud += "<td>";
                cloud +=
                  '<input class="cb-element-cloud" type="checkbox" name="menus[]"';
                cloud +=
                  'onchange="' +
                  App.onChangeElement() +
                  '" value = "' +
                  data.data[i].id +
                  '" ' +
                  data.data[i].checked +
                  " >";
                cloud += "</td>";

                //name
                cloud += "<td>";
                cloud += data.data[i].description;
                cloud += "</td>";
                cloud += "<td>";
                cloud +=
                  '<button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle btn btn-outline-link">Pilih Fungsi</button>';
                cloud +=
                  '<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu py-1 px-2">';
                for (var y = 0; y < data.data[i].fungsi.length; y++) {
                  var value = data.data[i].fungsi;
                  cloud += "<div>";
                  cloud += '<label class="form-check form-check-inline">';
                  cloud +=
                    '<input type="checkbox" class="cb-element-cloud-child mr-1 function-' +
                    value[y].id +
                    '"';
                  cloud +=
                    'name="functions[' +
                    data.data[i].id +
                    '][]" onchange="' +
                    App.onChangeChild() +
                    '"';
                  cloud +=
                    'value="' + value[y].id + '"  ' + value[y].checked + " >";
                  cloud +=
                    '<span class="form-check-label text-' +
                    warna[parseInt(value[y].id) - 1] +
                    '">' +
                    value[y].name +
                    "</span>";
                  cloud += "</label>";
                  cloud += "</div>";
                }
                cloud += "</div>";
                cloud += "</td>";
                cloud += "<td>";
                for (var y = 0; y < data.data[i].fungsi.length; y++) {
                  var value = data.data[i].fungsi;
                  if (value[y].checked) {
                    cloud +=
                      '<div class="badge badge-info mr-2">' +
                      value[y].name +
                      "</div>";
                  }
                }
                cloud += "</td>";

                cloud += "</tr>";
              }
              $("#tabcloud tbody").html(cloud);
              App.checkAllCheckbox();
            })
            .fail(function() {
              console.log("error");
            });
        });
        $("#role").trigger("change");

        $("#table tbody").on("click", ".delete", function() {
          var url = $(this).attr("url");
          var status = $(this).attr("data-status");
          var pesan = "";
          if (status == 1) {
            pesan = "Apakah anda yakin ingin menonaktifkan data ini?";
          } else if (status == 2) {
            pesan = "Apakah anda yakin ingin mengaktifkan data ini?";
          } else if (status == 3) {
            pesan = "Apakah anda yakin ingin menghapus data ini?";
          }
          App.confirm(pesan, function() {
            $.ajax({
              headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
              },
              method: "POST",
              url: url,
              data: {
                status: status,
                _method: "DELETE"
              }
            }).done(function(msg) {
              var data = JSON.parse(msg);
              if (data.status == false) {
                toastr.error(data.msg);
              } else {
                toastr.success(data.msg);
                App.table.ajax.reload(null, true);
              }
            });
          });
        });
      },

      clearData: function() {
        $("#new_data").on("click", function(event) {
          $("#form-create")[0].reset();
        });
      },

      initForm: function() {
        if ($("#form-create").length > 0) {
          $("#form-create").validate({
            rules: {
              group_id: {
                required: true
              },
              name: {
                required: true
              }
            },
            messages: {
              group_id: {
                required: function() {
                  toastr.error("Grup Harus Dipilih");
                }
              },
              name: {
                required: function() {
                  toastr.error($("#name").attr("placeholder") + " Harus Diisi");
                }
              }
            },
            debug: true,
            submitHandler: function(form) {
              form.simpan[0].disabled = true;
              form.submit();
              return false;
            }
          });
        }

        if ($("#form-edit").length > 0) {
          $("#form-edit").validate({
            rules: {
              group_id_edit: {
                required: true
              },
              name_edit: {
                required: true
              }
            },
            messages: {
              group_id_edit: {
                required: function() {
                  toastr.error("Grup Harus Dipilih");
                }
              },
              name_edit: {
                required: function() {
                  toastr.error(
                    $("#name_edit").attr("placeholder") + " Harus Diisi"
                  );
                }
              }
            },
            debug: true,
            submitHandler: function(form) {
              form.simpan[0].disabled = true;
              form.submit();
              return false;
            }
          });
        }

        if ($("#form-privilege").length > 0) {
          $("#form-privilege").validate({
            debug: true,
            submitHandler: function(form) {
              form.simpan[0].disabled = true;
              form.submit();
              return false;
            }
          });
        }
      },

      checkAllCheckbox: function() {
        _tot_cloud = $(".cb-element-cloud").length;
        _tot_cloud_checked = $(".cb-element-cloud:checked").length;
        if (_tot_cloud != _tot_cloud_checked) {
          $("#checkAllCloud").prop("checked", false);
        } else {
          $("#checkAllCloud").prop("checked", true);
        }
      },

      onChangeChild: function() {
        $(
          "#tabcloud tbody"
        ).on("change", ".cb-element-cloud-child", function() {
          $parent = $(this).closest("tr").find(".cb-element-cloud");
          $child = $(this).closest("tr").find(".cb-element-cloud-child");
          $childChecked = $(this)
            .closest("tr")
            .find(".cb-element-cloud-child:checked");

          _tot = $child.length;
          _tot_checked = $childChecked.length;
          if (_tot != _tot_checked) {
            $parent.prop("checked", false);
          } else {
            $parent.prop("checked", true);
          }
          App.checkAllCheckbox();
        });
      },

      onChangeElement: function() {
        $("#tabcloud tbody").on("change", ".cb-element-cloud", function() {
          App.checkAllCheckbox();
          $parent = $(this).closest("tr").find(".cb-element-cloud-child");
          $parent.prop("checked", $(this).prop("checked"));
        });
        App.checkAllCheckbox();
      },

      initPrivileges: function() {
        $("#checkAllCloud").change(function() {
          $("input:checkbox.cb-element-cloud").prop(
            "checked",
            $(this).prop("checked")
          );
          $("input:checkbox.cb-element-cloud-child").prop(
            "checked",
            $(this).prop("checked")
          );
        });

        $(".cb-element-cloud-child").on("click", function() {
          parent = $(this).closest(".function-parent");
          var checked = $(this).is(":checked") ? true : false;

          if ($(this).val() == 1) {
            parent.find(".function-2").prop("checked", checked);
            parent.find(".function-5").prop("checked", checked);
          } else if ($(this).val() == 2) {
            parent.find(".function-5").prop("checked", checked);
          } else if ($(this).val() == 3) {
            parent.find(".function-2").prop("checked", checked);
            parent.find(".function-5").prop("checked", checked);
          } else if ($(this).val() == 4) {
            parent.find(".function-2").prop("checked", checked);
            parent.find(".function-5").prop("checked", checked);
          } else if ($(this).val() == 5) {
            parent.find(".function-2").prop("checked", checked);
          }
        });
      }
    };
  }
);
