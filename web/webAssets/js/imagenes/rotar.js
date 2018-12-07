$(document).ready(function(){
    $(".js-rotar-imagen").on('click', function(e){
       // var id = $(this).data('id');
       e.preventDefault();
        var id = $(this).data('id');

        $.ajax({
            url: baseUrl+'imagenes/rotar?id='+id,
            success: function(resp){
              
               // var url =  $('.js-imagen-rotate-'+id).attr('src');
                // $('.js-imagen-rotate-'+id).attr('src','');
                // $('.js-imagen-rotate-'+id).attr('src',url);
                $('.js-imagen-rotate-'+id).css('transform','rotate(90deg)');
                // if(resp.status == 'success'){
                //     toastr.success("Imagen eliminada correctamente.");
                //     $('.js-imagen-'+id).remove();
                //     $grid.isotope('updateSortData').isotope();
                // }else{
                //     toastr.warning("No se pudo eliminar la imagen");
                // }
            },
            error:function(){
                // toastr.warning("No se pudo eliminar la imagen");
            }
        });
    });
});