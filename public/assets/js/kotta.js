$(document).ready(function(){
        $('#uimage').on('change', function(e){
            $('#simage').attr('src', URL.createObjectURL(e.target.files[0]));
        });
});




