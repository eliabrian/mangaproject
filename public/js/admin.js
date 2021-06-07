/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!*************************************!*\
  !*** ./resources/js/admin/manga.js ***!
  \*************************************/
$(document).ready(function () {
  var page = $('#admin-manga-index');
  var _table = {};
  var manga = {
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
        }, {
          data: 'action',
          name: 'action'
        }],
        "columnDefs": [{
          "searchable": true,
          "targets": 0
        }]
      });
    }
  };
  manga.table();
});
})();

// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!***************************************!*\
  !*** ./resources/js/admin/chapter.js ***!
  \***************************************/
$(document).ready(function () {
  var page = $('#admin-chapter-index');
  var _table = {};
  var chapter = {
    table: function table() {
      _table = page.find('#chapter-datatable');

      _table.DataTable({
        'processing': true,
        'serverSide': true,
        'ajax': {
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: '/admin/chapters/ajax',
          data: function data(d) {
            d.manga_id = $('#manga-id').val();
          }
        },
        'columns': [{
          data: 'chapter_number',
          name: 'chapter_number'
        }, {
          data: 'name',
          name: 'name'
        }, {
          data: 'action',
          name: 'action'
        }],
        "columnDefs": [{
          "searchable": true,
          "targets": 0
        }]
      });
    }
  };
  chapter.table();
});
})();

/******/ })()
;