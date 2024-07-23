$(document).ready(function(){
        $('#uimage').on('change', function(e){
            $('#simage').attr('src', URL.createObjectURL(e.target.files[0]));
        });
});




// npm package: sweetalert2
// github link: https://github.com/sweetalert2/sweetalert2
    $(function(){
        showSuccessAlert= function(type ,message){
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
              });
              Toast.fire({
                icon: type,
                title: message
              })

        }
    })

