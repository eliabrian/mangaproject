$(document).ready(function () {
    let page = $('#admin-manga-index')
    let table = {}

    let user = {
        table: () => {
            table = page.find('#manga-datatable')
            table.DataTable({
                'processing': true,
                'serverSide': true,
                'ajax': {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/admin/mangas/ajax',
                },
                'columns': [
                    {data: 'name', name: 'name'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'action', name: 'action'},
                ],
                "columnDefs": [
                    { "searchable": true, "targets": 0 }
                  ]
            })
        } 
    }
    user.table();
});