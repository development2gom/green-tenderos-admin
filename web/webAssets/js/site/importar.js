$(document).ready(function(){
    $(".js-input-file").on('change', function(){
        var url = $(this).data("url");
        //var file_data = $(this).prop('files')[0];
        var file_data = $(this).val();
        var form_data = new FormData();
        form_data.append('file-import', file_data);
        
        alert(file_data); 
        // console.log(url);

        $.ajax({
            url: url + '/site/importar-data',
            type: 'POST',
            data: form_data,
            contentType: false,
            processData: false,
            success: function(resp){
                console.log(resp);
            },
            error: function(){
                alert('error');
            }
        });
    });
});