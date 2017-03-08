$(function(){ 
    var $uploadCrop; 
 
        function readFile(input) { 
            
            if (input.files && input.files[0]) { 
                var reader = new FileReader(); 
                 
                reader.onload = function (e) { 
                    $uploadCrop.croppie('bind', { 
                        url: e.target.result 
                    }); 
                } 
                 
                reader.readAsDataURL(input.files[0]); 
            } 
            else { 
                alert("Désolé - votre navigateur ne prend pas en charge l'API FileReader"); 
            } 
        } 
 
        $uploadCrop = $('#upload-demo').croppie({ 
            viewport: { 
                width: 180, 
                height: 180,
            }, 
            boundary: { 
                width: 200, 
                height: 200 
            },
        }); 
 
        $('#upload').on('change', function () {  
            
            $(".file-btn").hide();
            $(".crop").show();
            readFile(this);  
        }); 
        $('.upload-result').on('click', function (event) { 
            
            event.preventDefault();
            event.stopPropagation();

            $uploadCrop.croppie('result', {type: 'canvas', size: 'viewport', format: 'jpeg', quality: 0.7}).then(function (resp) { 
                popupResult({ 
                    src: resp 
                }); 
            }); 
        }); 

        $('.upload-cancel').on('click', function (event) {
            event.preventDefault();
            event.stopPropagation();

            $('#upload').val('');
            $(".crop").hide();
            $(".file-btn").show();

        });
         
    function popupResult(result) { 
        var html; 
        if (result.html) { 
            html = result.html; 
        } 
        if (result.src) { 
            html = '<img src="' + result.src + '" />'; 
        } 
        $("#base64_picture").val(result.src); 
        $("#picture").attr("src", result.src);
        
        $('#upload').val('');
        $(".crop").hide();
        $(".file-btn").show();

    } 
});