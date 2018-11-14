$(document).ready(function(){
    // toastr.success("Datos guardados correctamente.");
    // toastr.warning("No se pudieron guardar los datos");
    var $grid = $('.js-grid').isotope();

    $(".js-delete-imagen").on('click', function(){
        var id = $(this).data('id');
        var url = $(this).data('url');

        $.ajax({
            url: url+'/imagenes/delete/'+id,
            success: function(resp){
                if(resp.status == 'success'){
                    toastr.success("Imagen eliminada correctamente.");
                    $('.js-imagen-'+id).remove();
                    $grid.isotope('updateSortData').isotope();
                }else{
                    toastr.warning("No se pudo eliminar la imagen");
                }
            },
            error:function(){
                toastr.warning("No se pudo eliminar la imagen");
            }
        });
    });
});

function configToastr(){
    toastr.options = {
        "closeButton": true,
        
        "positionClass": "toast-top-full-width",
        "preventDuplicates": true,
        
        "showDuration": "3000",
        "hideDuration": "10000",
        "timeOut": "5000",
        "extendedTimeOut": "10000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
}