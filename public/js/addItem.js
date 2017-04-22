function readImageFile(input, id){
        if (input.files && input.files[0]) {

            if(input.files[0].size >= 1024*1024*5){
                alert("Cannot upload images with size > 5MB");
            }else if(input.files[0].type.match('image')){
                var reader = new FileReader();
                reader.onload = function (e) {
                    var image = new Image();
                    image.addEventListener("load",function(){
                        alert(e.target.result);
                        $(id).attr('src', e.target.result);
                    });
                    image.addEventListener("error",function(){
                        alert("Please upload image with .png|.jpg|.jpeg extension");
                    });
                    image.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }else{
                alert("Please upload image with .png|.jpg|.jpeg extension");
            }
        }else{
            console.log("Invalid input");
        }
    }