"use strict";

document.addEventListener("DOMContentLoaded", init);

function init()
{
    document.querySelector("#files").addEventListener("change", readUploadedFile);
}

function readUploadedFile(e)
{
    console.log(e);
    console.log('works');
    console.log(e.isTrusted);
    console.log(e.srcElement.files[0]);
    if(e.isTrusted && (e.srcElement.files[0].type == "image/png" || e.srcElement.files[0].type == "image/jpeg"))
    {
        console.log("IMAGE");
        const reader = new FileReader();
        reader.addEventListener("load", () => 
        {
            const uploaded_image = reader.result;
            document.querySelector("#avatar").src = `(${uploaded_image})`;
        });
        reader.readAsDataURL(this.files[0]);
    }

    
}