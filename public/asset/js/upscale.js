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
        $('.ratio-btn').click(this.displayResult.bind(this));

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


    // load result
    displayResult() {
        let images = $(".gallery img[fieldname = 'inputImage']");
        for (const image of images) {
            $('.result-img').prepend(image);
        }
        $('.intro-next').show();
        // for (const image of images) {
        //     $('#upscaledImg').append(image);
        // }
        $('#upscaleResult').show();
    }
}



// preview image
$('#gallery-photo-add').on('change', function() {

    imagesPreview(this, 'div.gallery');
    $('.intro').hide();
    $('#image-contain').addClass('image-preview');
    $('input').val("");
    // let startButton = $(` <div class="ratio-contain">
    //                         <button id="ratio-x2" class="d-btn ratio-btn">x2</button>
    //                      <button id="ratio-x4" class="d-btn ratio-btn">x4</button>
    //                     </div>`);
    // $('.content-inside').append(startButton)

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