$(document).ready(function() {
    new Upscale();
});

class Upscale {
    TitlePage = "Upscale image";

    constructor() {
        this.initEvents();
    }

    initEvents() {

        // $('#ratio-x2').click(this.displayResult.bind(this));
        // $('.ratio-btn').click(this.displayResult.bind(this));
        $('.ratio-btn').click(this.storageImage); //bind(this)

        // delete image upscaled
        $('#delImg').click(this.deletePopupShow.bind(this));
        $('#delete-cont').click(this.deleteUpscaledImg);
        // Close popup delete image
        $('.pop-cls').click(this.deletePopupHide);


    }

    // show delete image popup
    deletePopupShow() {
            $('#deletePopup').show();
        }
        // Close delete image popup
    deletePopupHide() {
            $('#deletePopup').hide();
        }
        // delete upscaled image
    deleteUpscaledImg() {
        $('.result-img').children().remove();
        $('#deletePopup').hide();
        $('#upscaleResult').hide();
    }

    storageImage(sender) {
        sender.preventDefault();
        var file_data = $(".gallery img[fieldname = 'inputImage']");
        var ratio_scale;
        var ratio_scale_btn = this.id;
        if (ratio_scale_btn == 'ratio-x2') {
            ratio_scale = 2;
        } else ratio_scale = 2;
        var form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('ratio-scale', ratio_scale);
        $.ajax({
            type: 'POST',
            url: "{{ url('storage/app/uploads')}}",
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                this.reset();
                alert('File has been uploaded successfully');
                console.log(data);
            },
            error: function(data) {
                console.log(data);
            }
        });
    }
}



// preview image
$('#gallery-photo-add').on('change', function() {

    imagesPreview(this, 'div.gallery');
    $('.intro').hide();
    $('#image-contain').addClass('image-preview');
    $('input').val("");
});



// load image from computer
var imagesPreview = function(input, placeToInsertImagePreview) {

    if (input.files) {
        var filesAmount = input.files.length;

        for (i = 0; i < filesAmount; i++) {
            var reader = new FileReader();

            reader.onload = function(event) {
                $($.parseHTML('<img>')).attr('src', event.target.result).attr('fieldname', 'inputImage').appendTo(placeToInsertImagePreview);
            }
            reader.readAsDataURL(input.files[i]);

        }
    }

};