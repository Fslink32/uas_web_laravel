define(
  [
    "jQuery",
    "bootstrapDatePicker",
    "bootstrap",
    "datatablesBootstrap",
    "datatablesResponsive",
    "toastr",
    "jValidate",
    "select2",
    "tinymce"
  ],
  function(
    $,
    bootstrapDatePicker,
    bootstrap,
    datatablesBootstrap,
    datatablesResponsive,
    toastr,
    jValidate,
    select2,
    tinymce
  ) {
    return {
      table: null,
      selected_unit_id: null,
      init: function() {
        App.initFunc();
        App.initDatePicker();
        App.initSelect2();
        App.initTable();
        App.initTableClick();
        App.initVerifikasi();
        App.imagePreview();
        // App.initForm();
      },
      initDatePicker: function() {
        $(".datepicker").datepicker({
          format: "yyyy-mm-dd",
          viewMode: "days",
          minViewMode: "days",
          autoclose: true
        });
      },
      initSelect2: function() {
        $('*select[data-selectjs="true"]').select2({ width: "100%" });
        $("#console").on("click", function() {
          console.log(tinymce.get("description").getContent());
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
            info: "Menampilkan _START_ s/d _END_ dari total _TOTAL_ data",
            infoEmpty: "Tidak ada data di dalam tabel",
            infoFiltered: "(cari dari _MAX_ total data)",
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
            url: App.baseUrl + "admin/harga/dataList",
            dataType: "json",
            type: "POST"
          },
          columns: [
            { data: "no" },
            { data: "nama_barang" },
            { data: "satuan" },
            { data: "harga" },
            { data: "action", orderable: false }
          ]
        });
      },
      initTableClick: function() {
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
                App.table.draw();
              }
            });
          });
        });
      },
      initForm: function() {
        if ($("#form-create").length > 0) {
          $("#form-create").validate({
            rules: {
              first_name: {
                required: true
              },
              nik: {
                required: true,
                number: true
              },
              email: {
                required: true,
                email: true
              },
              role_id: {
                required: true
              },
              username: {
                required: true,
                remote: {
                  url: App.baseUrl + "/user/checkUsername",
                  type: "post",
                  data: {
                    username: function() {
                      return $("#username").val();
                    }
                  }
                }
              },
              password: {
                required: true,
                minlength: 8
              },
              password_confirm: {
                required: true,
                minlength: 8,
                equalTo: "#password"
              }
            },
            messages: {
              first_name: {
                required: function() {
                  toastr.error(
                    $("#first_name").attr("placeholder") + " Harus Diisi"
                  );
                }
              },
              nik: {
                required: function() {
                  toastr.error($("#nik").attr("placeholder") + " Harus Diisi");
                },
                number: function() {
                  toastr.error($("#nik").attr("placeholder") + " Harus Angka");
                }
              },
              email: {
                required: function() {
                  toastr.error(
                    $("#email").attr("placeholder") + " Harus Diisi"
                  );
                },
                email: function() {
                  toastr.error(
                    $("#email").attr("placeholder") + " Tidak Benar"
                  );
                }
              },
              phone: {
                number: function() {
                  toastr.error(
                    $("#phone").attr("placeholder") + " Harus Angka"
                  );
                }
              },
              role_id: {
                required: function() {
                  toastr.error(
                    $("#role_id").attr("placeholder") + " Harus Dipilih"
                  );
                }
              },
              username: {
                required: function() {
                  toastr.error(
                    $("#username").attr("placeholder") + " Harus Diisi"
                  );
                },
                remote: function() {
                  toastr.error(
                    $("#username").attr("placeholder") + " Sudah Digunakan"
                  );
                }
              },
              password: {
                required: function() {
                  toastr.error(
                    $("#password").attr("placeholder") + " Harus Diisi"
                  );
                },
                minlength: function() {
                  toastr.error(
                    $("#password").attr("placeholder") + " Minimal 8 Karakter"
                  );
                }
              },
              password_confirm: {
                required: function() {
                  toastr.error(
                    $("#password_confirm").attr("placeholder") + " Harus Diisi"
                  );
                },
                minlength: function() {
                  toastr.error(
                    $("#password_confirm").attr("placeholder") +
                      " Minimal 8 Karakter"
                  );
                },
                equalTo: function() {
                  toastr.error(
                    $("#password").attr("placeholder") +
                      " dan " +
                      $("#password_confirm").attr("placeholder") +
                      " Tidak Sama"
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

        if ($("#form-edit").length > 0) {
          $("#form-edit").validate({
            rules: {
              first_name_edit: {
                required: true
              },
              nik_edit: {
                required: true,
                number: true
              },
              email_edit: {
                required: true,
                email: true
              },
              phone_edit: {
                number: true
              },
              address_edit: {
                required: true
              }
            },
            messages: {
              first_name_edit: {
                required: function() {
                  toastr.error(
                    $("#first_name_edit").attr("placeholder") + " Harus Diisi"
                  );
                }
              },
              nik_edit: {
                required: function() {
                  toastr.error(
                    $("#nik_edit").attr("placeholder") + " Harus Diisi"
                  );
                },
                number: function() {
                  toastr.error(
                    $("#nik_edit").attr("placeholder") + " Harus Angka"
                  );
                }
              },
              email_edit: {
                required: function() {
                  toastr.error(
                    $("#email_edit").attr("placeholder") + " Harus Diisi"
                  );
                },
                email: function() {
                  toastr.error(
                    $("#email_edit").attr("placeholder") + " Tidak Benar"
                  );
                }
              },
              phone_edit: {
                number: function() {
                  toastr.error(
                    $("#phone_edit").attr("placeholder") + " Harus Angka"
                  );
                }
              },
              address_edit: {
                required: function() {
                  toastr.error(
                    $("#address_edit").attr("placeholder") + " Harus Diisi"
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
      },
      initVerifikasi: function() {
        $(".verifikasi").on("click", function() {
          var id = $(this).data("id");
          $.ajax({
            headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            type: "PUT", // or 'GET' depending on your server-side handling
            url: App.baseUrl + "admin/projects/" + id + "/verifikasi", // replace with your server-side script URL
            data: { status: $(this).data("status") },
            success: function(response) {
              window.location.href = App.baseUrl + "admin/projects";
            },
            error: function(error) {
              alert(error.responseText);
            }
          });
        });
      },
      imagePreview: function() {
        $("#banner").change(function() {
          // Get the selected file
          var file = this.files[0];

          // Check if the file is an image
          if (file && file.type.startsWith("image/")) {
            // Read the file as a Data URL
            var reader = new FileReader();
            reader.onload = function(e) {
              // Update the thumbnail preview with the Data URL
              $("#tumbnail-container").html(
                '<img class="w-50" src="' +
                  e.target.result +
                  '" alt="Thumbnail">'
              );
            };
            reader.readAsDataURL(file);
          } else {
            // If the selected file is not an image, clear the preview
            $("#tumbnail-container").html("");
          }
        });
      }
    };
  }
);
