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
    $('#delete-selected').on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: '{{ __('Are you sure?') }}',
            html: '{!! __('Type Delete') !!}',
            icon: 'warning',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Sure',
            showLoaderOnConfirm: true,
            preConfirm: (data) => {
                if (data !== 'delete') {
                    Swal.showValidationMessage(
                        `{!! __('Please enter according to the command.') !!}`
                    )
                }
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if(result.value) {
                $("#submit-all").submit();
            }
        })
    });
}