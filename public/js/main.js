/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************!*\
  !*** ./resources/js/main.js ***!
  \******************************/
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
}); // code for all data tables

$(document).ready(function () {
  "use strict";

  $("#all-datatable").DataTable({
    ordering: false,
    language: {
      paginate: {
        previous: "<i class='mdi mdi-chevron-left'>",
        next: "<i class='mdi mdi-chevron-right'>"
      },
      info: "Showing _START_ to _END_ of _TOTAL_",
      lengthMenu: 'Display <select class=\'form-select form-select-sm ms-1 me-1\'><option value="10">10</option><option value="20">20</option><option value="-1">All</option></select>'
    },
    pageLength: 10,
    drawCallback: function drawCallback() {
      $(".dataTables_paginate > .pagination").addClass("pagination-rounded"), $("#products-datatable_length label").addClass("form-label");
    }
  }); // preview image before upload
  // $("#img-upload-preview").change(function(){
  //     var file = $("#img-upload-preview").get(0).files[0];
  //     if(file){
  //         var reader = new FileReader();
  //         reader.onload = function(){
  //             $("#preview-up-image").attr("src", reader.result);
  //         }
  //         reader.readAsDataURL(file);
  //     }
  // });

  setTimeout(function () {
    $('.alert-success').slideUp(1000);
  }, 5000); //soft delete, restore & permanently delete Data

  $("body").on("click", "#all-datatable tbody tr .dtbl-icon", function (e) {
    e.preventDefault();
    var deleteDta = "dtbl-icon action-icon del-dta";
    var restoreDta = "dtbl-icon action-icon restore-dta";
    var perDelDta = "dtbl-icon action-icon permanent-delete-dta";
    var cls = $(this).attr("class");

    switch (cls) {
      case deleteDta:
        var el = $("#all-datatable tbody tr .del-dta");
        var url = el.attr('data-url');
        var cform = "#delete-form";
        var title = "Send this " + el.attr('data-name') + " to trash!";
        var text = el.attr('data-name') + " : \"" + el.attr('data-title') + "\" will be moved to trash!";
        var confText = el.attr('data-name') + " :\"" + el.attr('data-title') + "\" Moved to Trash Successfully!";
        var confTitle = "Visit trash to restore";
        break;

      case restoreDta:
        var el = $("#all-datatable tbody tr .restore-dta");
        var url = el.attr("data-url");
        var cform = "#restore-form";
        var title = "Restore " + el.attr('data-name') + " : \"" + el.attr('data-title') + "\"?";
        var text = el.attr('data-name') + " : \"" + el.attr('data-title') + "\" will be restoted";
        var confText = el.attr('data-name') + " : \"" + el.attr('data-title') + "\" Restored Successfully!";
        var confTitle = "Visit All " + el.attr('data-name') + "s to View";
        break;

      case perDelDta:
        var el = $("#all-datatable tbody tr .permanent-delete-dta");
        var url = el.attr("data-url");
        var cform = "#permanent-delete-form";
        var title = "Permanently delete " + el.attr('data-name') + " : \"" + el.attr('data-title') + "\"?";
        var text = "You will not be able to restore this anymore!";
        var confText = "Permanently Deleted Successfully!";
        var confTitle = el.attr('data-name') + " no longer exists";
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
  }); //image change

  $(".product-images").on('click', function () {
    $("#preview-img").attr('src', $(this).attr('src'));
  });
}); // Dropzone.autoDiscover = false;
// $(document).ready(function(){
//     //dropzone
//     $("div#product-images").dropzone({
//         url: "/shop/product/create",
//         paramName: "images",
//         autoProcessQueue: false,
//         uploadMultiple: true,
//         parallelUploads: 100,
//         maxFiles: 100,
//         addRemoveLinks: true,
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         init: function(){
//             var dz = this;
//             $("#submit-product").on('click', function(event){
//                 event.preventDefault();
//                 event.stopPropagation();
//                 dz.processQueue();
//             })
//             dz.on("sending", function(file, xhr, formData) { 
//                 formData.append("title", $('input[name="title"]').val());  
//                 formData.append("price", $('input[name="price"]').val()); 
//                 formData.append("discount", $('input[name="discount"]').val()); 
//                 formData.append("stock", $('input[name="stock"]').val()); 
//                 formData.append("category_id", $('input[name="category_id"]').val()); 
//                 formData.append("draft", $('input[name="draft"]').val()); 
//                 formData.append("description", $('textarea[name="description"]').val()); 
//                });
//         }
//     });
// });
/******/ })()
;