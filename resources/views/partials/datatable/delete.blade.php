function deleteAll() {
    Swal.fire({
        title: '{{ __('Are you sure?') }}',
        html: '{!! __('Please type <b>delete</b> to confirm') !!}',
        icon: 'warning',
        input: 'text',
        showCancelButton: true,
        confirmButtonText: '{{ __('Sure') }}',
        cancelButtonText: '{{ __('Cancel') }}',
        showLoaderOnConfirm: true,
        preConfirm: (data) => {
            if (data !== 'delete') {
                Swal.showValidationMessage(
                    `{{ __('Please enter as instructed.') }}`
                )
            }
        },
        allowOutsideClick: false
    }).then(function(data) {
        if(data.isConfirmed) {
            var pilihan = $("input[name='pilihan[]']:checked").map(function() { 
                return $(this).val();
            }).get();
            $.ajax({
                type: 'DELETE',
                url: '{{ $url }}' + '/bulk-delete',
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "pilihan": pilihan
                },
                success: function(data){
                    @isset($refresh)
                        history.go(0)
                    @else
                        if(data == "success") {
                            $('.delete-button').hide();
                            $.pjax.reload('#pjax-container');
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Galat!',
                                html: '{{ __('An error occurred while deleting data. Try again.') }}'
                            });
                        }
                    @endisset
                }
            });
        }
    })
}

function deleteOne(i) {
    Swal.fire({
        title: '{{ __('Are you sure?') }}',
        html: '{!! __('Please type <b>delete</b> to confirm') !!}',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yakin',
        cancelButtonText: 'Batalkan',
    }).then(function(data) {
        if (data.isConfirmed) {
            $.ajax({
                type: 'DELETE',
                url: '{{ $url }}' + '/' + i,
                data: {
                    "id": i,
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(data){
                    @isset($refresh)
                        history.go(0)
                    @else
                        if(data == "success") {
                            $.pjax.reload('#pjax-container');
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Galat!',
                                html: 'Terjadi kesalahan saat menghapus data. Coba sekali lagi.'
                            });
                        }
                    @endisset
                }
            });
        } else if(data.isDenied) {
            Swal.fire('Changes are not saved', '', 'info')
        }
    })
}