$(document).ready(function(){
    // toastr.success("Datos guardados correctamente.");
    // toastr.warning("No se pudieron guardar los datos");
    var $grid = $('.js-grid').isotope();

    $(".js-delete-video").on('click', function(){
        var id = $(this).data('id');
        var url = $(this).data('url');

        $.ajax({
            url: url+'/videos/delete/'+id,
            success: function(resp){
                if(resp.status == 'success'){
                    toastr.success("Video eliminado correctamente.");
                    $('.js-video-'+id).remove();
                    $grid.isotope('updateSortData').isotope();
                }else{
                    toastr.warning("No se pudo eliminar el video");
                }
            },
            error:function(){
                toastr.warning("No se pudo eliminar el video");
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