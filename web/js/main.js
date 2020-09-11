
window.onload = function(){

    var fileInput = document.getElementById('photo_input'),
        fileTextInput = fileInput.previousSibling,
        addPhoto = document.getElementById('add_photo'),
        photoBlock = document.getElementById('photo_block'),
        removePhotoBtn = document.getElementById('remove_photo_btn');


    fileTextInput.setAttribute('value', fileInput.getAttribute('value'));
    fileInput.addEventListener('change', readURL);

    document.onclick = function( event ){

        if ( event.target.parentNode.id === 'remove_photo_btn') {
            fileInput.removeAttribute('value');
            fileTextInput.removeAttribute('value');
            fileInput.setAttribute('value', '');
            fileTextInput.setAttribute('value', '');
            photoBlock.innerHTML = '';
        }

    };

    addPhoto.onclick = function (e) {
        e.preventDefault();
        fileInput.click();
    };




    function readURL() {
        if (this.files && this.files[0]) {
            if( trueExt(this.files[0].type) ){
                var reader = new FileReader();
                reader.readAsDataURL(this.files[0]);
                reader.onload = function () {
                    if(photoBlock) photoBlock.innerHTML = document.getElementById('help_photo_block').innerHTML;
                    document.getElementById('photo').setAttribute('src', reader.result);
                };
            } else {
                if(photoBlock) photoBlock.innerHTML = '';
            }

        }
    }


    function trueExt( verExt ){
        verExt = verExt.split('/').pop();
        var ext = 'png, jpg, jpeg';
        return ext.split(', ').includes(verExt);
    }

};

