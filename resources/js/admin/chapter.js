$(document).ready(function () {
    let page = $('#admin-chapter-index')
    let table = {}

    let chapter = {
        table: () => {
            table = page.find('#chapter-datatable')
            table.DataTable({
                'processing': true,
                'serverSide': true,
                'ajax': {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/admin/chapters/ajax',
                    data: function (d) {
                        d.manga_id = $('#manga-id').val()
                    }
                },
                'columns': [
                    {data: 'chapter_number', name: 'chapter_number'},
                    {data: 'name', name: 'name'},
                    {data: 'action', name: 'action'},
                ],
                "columnDefs": [
                    { "searchable": true, "targets": 0 }
                  ]
            })
        } 
    }
    chapter.table();
});