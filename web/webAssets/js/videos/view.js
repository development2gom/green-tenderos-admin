$(document).ready(function(){
    $('.js-publicar-video').on('click', function(){
        var id = $(this).data('id');
        var url = $(this).data('url');

        $.ajax({
            url: url + '/videos/publicar-video?id='+id,
            success: function(resp){
                if(resp.status == 'success'){
                    alert("success");
                }
            }
        });
    });
});