function readImageFile(input, id){
        if (input.files && input.files[0]) {

            if(input.files[0].size >= 1024*1024*5){
                alert("Cannot upload images with size > 5MB");
            }else{
                // var image = new Image();
                // image.onload = function(){
                //alert('image loaded');
                //var url = window.URL || window.webkitURL;
                // $(id).attr('src', url.createObjectURL(input.files[0]));
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(id).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
                //}
                //image.onerror = function(){
                //alert("Must be an image");
                //}
            }
        }else{
            console.log("Invalid input");
        }
    }