$(document).ready(function(){
    $('.js-publicar-imagen').on('click', function(){
        var id = $(this).data('id');
        var url = $(this).data('url');

        $.ajax({
            url: url + '/imagenes/publicar-imagen?id='+id,
            success: function(resp){
                if(resp.status == 'success'){
                    alert("success");
                }
            }
        });
    });
});