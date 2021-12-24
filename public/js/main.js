/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************!*\
  !*** ./resources/js/main.js ***!
  \******************************/
// code for all data tables
$(document).ready(function () {
  "use strict";

  $("#all-datatable").DataTable({
    language: {
      paginate: {
        previous: "<i class='mdi mdi-chevron-left'>",
        next: "<i class='mdi mdi-chevron-right'>"
      },
      info: "Showing _START_ to _END_ of _TOTAL_",
      lengthMenu: 'Display <select class=\'form-select form-select-sm ms-1 me-1\'><option value="10">10</option><option value="20">20</option><option value="-1">All</option></select> customers'
    },
    pageLength: 10,
    columns: [{
      orderable: !1,
      render: function render(e, l, a, o) {
        return "display" === l && (e = '<div class="form-check"><input type="checkbox" class="form-check-input dt-checkboxes"><label class="form-check-label">&nbsp;</label></div>'), e;
      },
      checkboxes: {
        selectRow: !0,
        selectAllRender: '<div class="form-check"><input type="checkbox" class="form-check-input dt-checkboxes"><label class="form-check-label">&nbsp;</label></div>'
      }
    }, {
      orderable: !0
    }, {
      orderable: !0
    }, {
      orderable: !0
    }, {
      orderable: !0
    }, {
      orderable: !0
    }, {
      orderable: !0
    }, {
      orderable: !1
    }],
    select: {
      style: "multi"
    },
    order: [[5, "asc"]],
    drawCallback: function drawCallback() {
      $(".dataTables_paginate > .pagination").addClass("pagination-rounded"), $("#products-datatable_length label").addClass("form-label");
    }
  }); // preview image before upload

  $("#img-upload-preview").change(function () {
    var file = $("#img-upload-preview").get(0).files[0];

    if (file) {
      var reader = new FileReader();

      reader.onload = function () {
        $("#preview-up-image").attr("src", reader.result);
      };

      reader.readAsDataURL(file);
    }
  });
  setTimeout(function () {
    $('.alert-success').slideUp(1000);
  }, 5000); //soft delete, restore & permanently delete user

  $("body").on("click", "#all-datatable tbody tr .action-icon", function (e) {
    e.preventDefault();
    var deleteUser = "action-icon del-user";
    var restoreUser = "action-icon restore-user";
    var perDelUser = "action-icon permanent-delete-user";
    var cls = $(this).attr("class");

    switch (cls) {
      case deleteUser:
        var url = $("#all-datatable tbody tr .del-user").attr("data-url");
        var cform = "#delete-form";
        var title = "Delete this user!";
        var text = "You can find this user under trashed users!";
        var confText = "Deleted Successfully!";
        var confTitle = "Go in trashed users to restore";
        break;

      case restoreUser:
        var url = $("#all-datatable tbody tr .restore-user").attr("data-url");
        var cform = "#restore-form";
        var title = "Restore this user!";
        var text = "You can find this user under all users!";
        var confText = "Restore Successfully!";
        var confTitle = "Go in all users to view";
        break;

      case perDelUser:
        var url = $("#all-datatable tbody tr .permanent-delete-user").attr("data-url");
        var cform = "#permanent-delete-form";
        var title = "Permanently delete this user!";
        var text = "You will not be able to restore this user!";
        var confText = "Permanently Deleted Successfully!";
        var confTitle = "User no longer exists";
        break;

      default:
        console.log('not clicled');
    }

    ;
    swal({
      title: title,
      text: text,
      icon: "warning",
      buttons: {
        cancel: {
          text: "No",
          className: "sa-btn-cancle",
          visible: true
        },
        confirm: {
          text: "Yes",
          visible: true,
          value: 'confirm'
        }
      }
    }).then(function (value) {
      if (value == 'confirm') {
        $(cform).attr("action", url).submit();
        swal(confTitle, confText, 'success');
      }
    });
  });
});
/******/ })()
;