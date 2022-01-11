$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

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

    // delete upscaled imageQ
    deleteUpscaledImg() {
        $('.result-img').children().remove();
        $('#deletePopup').hide();
        $('#upscaleResult').hide();
    }


    // load result
    // displayResult() {
    //     let images = $(".gallery img[fieldname = 'inputImage']");
    //     for (const image of images) {
    //         let src = $(image).attr('src')
    //         let imageAndLoading = `<div class="image">
    //             <img src="${src}" fieldname="inputImage">
    //             <div class="loading lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    //         </div>`
    //         let imageHtml = `<div class="image">
    //             <img src="${src}" fieldname="inputImage">
    //         </div>`
    //         $('.result-img').prepend(imageHtml);
    //         // $('.origin-image').prepend(imageHtml);
    //         // $('#upscaledImg').prepend(imageAndLoading)
    //     }

    //     $('.intro-next').show();
    //     $('#upscaleResult').show();
    // }
}

let dataFile = new FormData();
// preview image
$('#gallery-photo-add').on('change', function(e) {
    imagesPreview(this, 'div.gallery');
    $('.ratio-contain').find('button').attr('disabled', false)
    $('.intro').hide();
    $('#image-contain').addClass('image-preview');
    if (e.target.files.length > 0) {
        for (i = 0; i < e.target.files.length; i++) {
            // dataFile.append('files[]', e.target.files[i]);
            dataFile.append('file', e.target.files[i]);
        }
    }
    displayResult(e);
});

const loadingHtml = '<div class="loading lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>';

function displayResult(e) {
    let src = URL.createObjectURL(e.target.files[0])
    let imageHtml = `<div class="image">
        <img src="${src}" fieldname="inputImage">
    </div>`
    $('.result-img').prepend(imageHtml);
    $('.intro-next').show();
    $('#upscaleResult').show();
}


let intervalUpload = '';
$('.btn-upload-image').on('click', function() {
    let scaleUp = $(this).data('scale')
    $('.ratio-contain').find('button').attr('disabled', true)
    dataFile.append('scale', scaleUp);
    $($('#upscaledImg .image')[0]).append(loadingHtml);
    intervalUpload = setInterval(function() { handleUpload(); }, 3000);
})

function handleUpload() {
    $.ajax({
        type: 'POST',
        url: "/store",
        data: dataFile,
        contentType: false,
        processData: false,
        enctype: 'multipart/form-data',
        beforeSend: function() {
            $($('#upscaledImg .image')[0]).append(loadingHtml)
        },
        success: (data) => {
            if (data.status_code == 1) {
                let html = '';
                html += `<img src='/results/${data.file_name}' data-id='${data.file_name}'>`
                $('#upscaledImg .image img[fieldname = "inputImage"]').attr('src', `results/${data.file_name}`);
                $('#upscaledImg .image img').attr('fieldname', '');
                $('.loading').remove();
                clearInterval(intervalUpload);
                console.log('what is going on here');
                var options = {
                    fillContainer: true,
                    offset: {
                        vertical: 10,
                        horizontal: 10,
                        scale: 3
                    }
                };
                let container = document.getElementsByName("image");
                new ImageZoom(container, options);
            }
        },
        error: function(data) {
            console.log(data);
        }
    });
}

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