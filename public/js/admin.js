/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************!*\
  !*** ./resources/js/admin/manga.js ***!
  \*************************************/
$(document).ready(function () {
  var page = $('#admin-manga-index');
  var _table = {};
  var user = {
    table: function table() {
      _table = page.find('#manga-datatable');

      _table.DataTable({
        'processing': true,
        'serverSide': true,
        'ajax': {
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: '/admin/mangas/ajax'
        },
        'columns': [{
          data: 'name',
          name: 'name'
        }, {
          data: 'created_at',
          name: 'created_at'
        }, {
          data: 'updated_at',
          name: 'updated_at'
        }],
        "columnDefs": [{
          "searchable": true,
          "targets": 0
        }]
      });
    }
  };
  user.table();
});
/******/ })()
;