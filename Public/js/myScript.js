function popupCenter(url, title, w, h) {
    var left = (screen.width/2)-(w/2);
    var top = (screen.height/2)-(h/2);
    return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}

function previewImage(elt,id_affiche_image){
    var picture=elt.files[0];
    if(picture){
        var image=document.getElementById(id_affiche_image);
        image.src=URL.createObjectURL(picture);
    }
}
