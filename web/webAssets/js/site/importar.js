


$(document).ready(function(){

    var drEvent = $('.dropify').dropify();
    var isValid = true;

    drEvent.on('dropify.errors', function(event, element){
        
        isValid = false;
    });
    

    $(".js-input-file").on('click', function(e){
        e.preventDefault();        
        var formulario = $(this).parents("form");
        var formData = new FormData(formulario.get(0));
        
        if($(".dropify-wrapper.has-error").length == 0){
            isValid = true;
        }

        //var input = $(this);

        

        if(isValid){

            $(".js-loader").show();
            
            $.ajax({
                url: baseUrl + '/site/importar-data-test',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(resp){
                    if(resp.status == "success"){
                        swal("Correcto", "Los datos se guardaron correctamente", "success");
                    }else{
                        swal("Espera", "Hubo un error, intentelo de nuevo. Error:"+resp.message, "warning");
                    }
                    //input.val('');
                    $(".js-loader").hide();
                },
                error: function(){
                    //swal("Espera", "Hubo un error, intentelo de nuevo", "warning");                
                    input.val('');
                }
            });
        }
    });
});