/* datatables */
$.extend( true, $.fn.dataTable.defaults, {
    "processing": true,
    "serverSide": true,
    "pageLength": 10,
    "language": {
        "loadingRecords": "Carregando...",
        "processing": "Processando...",
        "search": "Pesquisar",
        "lengthMenu": "Mostrar _MENU_ registro por página.",
        "zeroRecords": "Nenhum registro encontrado.",
        "info": "Mostrando página _PAGE_ de um total de  _PAGES_",
        "infoEmpty": "Nenhum registro encontrado.",
        "infoFiltered": "(filtrado do total _MAX_ registros)",
        "paginate": {
            "previous": "Anterior",
            "next": "Próxima"
        }
    }
});
