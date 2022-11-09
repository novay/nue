iDisplayLength: 25, 
select: {
    style: 'multi',
    selector: 'td:first-child input[type="checkbox"]',
    classMap: {
        checkAll: '#datatable-checkbox-check',
        counter: '#datatable-checkbox',
        counterInfo: '#datatable-checkbox-info'
    }
}, 
info: {
    totalQty: "#datatable-total"
},
processing: true,
serverSide: true,
search: "#datatabe-search",
entries: "#datatable-entries",
pagination: "datatable-pagination", 
isResponsive: true,
isShowPaging: false,
bInfo : false, 
bProcessing: false, 
bLengthChange: false, 
fnDrawCallback: function( oSettings ) {
    $('[data-bs-toggle="tooltip"]').tooltip();
}