$(document).ready(function(){
    $(".js-input-file").on('change', function(){
        var url = $(this).data("url");
        var formulario = $(this).parents("form");
        var formData = new FormData(formulario.get(0));
        
        // alert(file_data); 
        // console.log(url);

        $.ajax({
            url: url + '/site/importar-data',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(resp){
                if(resp.status == "success"){
                    alert("Success");
                }
            },
            error: function(){
                alert('error');
            }
        });
    });
});