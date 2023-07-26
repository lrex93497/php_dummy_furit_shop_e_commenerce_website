var uploadImg = document.getElementById("product-img");

uploadImg.onchange = function() {
    /* 65,535 bytes is 64KB*/
    if(this.files[0].size > 65535){
       alert("Image exist 64KB");
       this.value = "";
    };
};