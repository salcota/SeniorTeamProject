function isdisabled(input){
    if(input.is(":disabled")){
        alert("Please upload a file");
        return false;
    }else{
        return true;
    }

}

function uploadImageFile(input, id, buttonid){
    if (input.files && input.files[0]) {

        if(input.files[0].size >= 1024*1024*5){
            alert("Cannot upload images with size > 5MB");

        }else if(input.files[0].type.match('image')){
            var reader = new FileReader();
            reader.onload = function (e) {
                var image = new Image();
                image.addEventListener("load",function(){
                    $(id).attr('src', e.target.result);
                    $(buttonid).prop('disabled',false);
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
