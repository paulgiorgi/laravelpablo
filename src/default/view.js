jQuery(document).ready(function() {

    DtTable = $('#dt_items').DataTable({
        "processing": false,
        "serverSide": true,
        "searching": true,
        "stateSave": true,
        "paging" : true,
        "ajax": {
                "url": baseUrl + "/"+slug+"/ajaxLoadList",
                "type": "POST",
                "data": function (d) {
                    $(".form-filter").each(function () {
                        d[$(this).attr('name')] = $(this).val();
                    });
                },
                complete: function () {
                    $('[data-bs-toggle="tooltip"]').tooltip();
                }
            }
        });

        // FILTRO INVIO NON PIU' RICERCA AD OGNI LETTERA DIGITATA.
           $('#dt_items_filter input').unbind();
           $('#dt_items_filter input').bind('keyup', function(e) {
                if (e.keyCode == 13) {
                    DtTable.search($(this).val()).draw();
               }
           });

         // FILTER SUBMIT
         $('#filter-submit').on('click', function (ev) {
             $('#dt_items').DataTable().ajax.reload();
         });

         // FILTER RESET
         $('#filter-reset').on('click', function (ev) {
             $(".form-filter").each(function (index) {
                 $(this).val('');
             });
             $('#dt_items').DataTable().ajax.reload();
         });

    $('#dt_items').on('click', '.itemDelete', function (event) {
        let _handler = $(this);

        Swal.fire({
            title: 'Sei sicuro?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#aaa',
            cancelButtonText: 'Annulla',
            confirmButtonText: 'Si'
        }).then((result) => {
            if (result.value) {
                let request = $.ajax({
                    url: baseUrl + "/"+slug+"/ajaxDelete",
                    type: "post",
                    data: {id: _handler.attr('data-id')},
                    dataType: "json"
                });
                request.done(function (data) {
                    if (data.success === true) {
                        $('#dt_items').DataTable().ajax.reload();
                        Swal.fire("Successo!", data.message, "success");
                    } else {
                        Swal.fire("Errore!", data.message, "error");
                    }
                });
                request.fail(function (jqXHR, textStatus) {
                    swal("Errore!", "Error while processing request!", "error");
                    });
                }
            });
        });

});
