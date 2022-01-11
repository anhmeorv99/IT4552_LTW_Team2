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
$('.ratio-contain').find('button').attr('disabled', true)
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
        <img src="${src}" fieldname="inputImage" data-zoom="${src}" class="zoomImage1">
    </div>`
    $('.result-img').prepend(imageHtml);
    $('.intro-next').show();
    $('#upscaleResult').show();
}


let intervalUpload = '';
<<<<<<< HEAD
$('.btn-upload-image').on('click', function() {
    let scaleUp = $(this).data('scale')
    $('.ratio-contain').find('button').attr('disabled', true)
=======
let scaleUp = '';
$('.btn-upload-image').on('click', function () {
    scaleUp = $(this).data('scale')
    console.log(scaleUp)
    $(this).attr('disabled', true)
>>>>>>> fda8f57b8191873b9227b4019f90e1dce0a0d614
    dataFile.append('scale', scaleUp);
    $($('#upscaledImg .image')[0]).append(loadingHtml);
    intervalUpload = setInterval(function() { handleUpload(); }, 3000);
})

function containsObject(list, obj) {
    var i;
    for (i = 0; i < list.length; i++) {
        if (list[i].result === obj.result) {
            return true;
        }
    }

    return false;
}

loadOldData();

function loadOldData () {
    let oldImages = localStorage.getItem('oldImages') ? JSON.parse(localStorage.getItem('oldImages')) : []
    if (oldImages.length > 0) {
        oldImages = oldImages.reverse()
        let gallery = '';
        let originImage = '';
        let resultImage = '';
        oldImages.map(item => {
            // gallery += `
            //     <img src="${item.origin}">
            // `;

            originImage += `
                <div class="zoomImage">
                    <img src="${item.origin}"  class="zoomImage1" data-zoom="${item.origin}">
                </div>
            `;

            resultImage += `
                <div class="zoomImage">
                    <img src="/results/${item.result}" class="zoomImage1" data-zoom="/results/${item.result}">
                </div>
            `;
        })
        $('.content-left').css('display', 'none');
        $('.content-right-contain').addClass('image-preview')
        $('.gallery').html(gallery);

        $('#upscaleResult').css('display', 'block');
        // origin image
        $('.origin-image').html(originImage);

        // result image
        $('#upscaledImg').html(resultImage);

        // $(".zoomImage").elevateZoom({
        //     zoomType: 'lens',
        //     lensShape: 'round',
        //     lensSize: 300
        // });

        // $(".zoomImage").loupe()

        for (let i = 0; i < $("#upscaledImg .zoomImage").length; i++){
            let resultImage =  $("#upscaledImg .zoomImage").eq(i).find('img').eq(0)


                let origImage = $('#orgImg').find('img').eq(resultImage.index())
                console.log(resultImage, origImage)

                new Drift(resultImage[0], {
                    inlinePane: true,
                containInline: true,
            // inlinePane: 10 5,
                sourceAttribute: 'data-zoom',

                paneContainer: document.querySelector('#orgImg'),
                zoomFactor:2
            });



        }

        for (let i = 0; i < $("#orgImg .zoomImage").length; i++){
            new Drift($("#orgImg .zoomImage img")[i], {
                inlinePane: true,
                containInline: true,
                // inlinePane: 10 5,
                sourceAttribute: 'data-zoom',

                paneContainer: document.querySelector('#orgImg'),
                zoomFactor: 2
              });

        }
    }
}

let lastItem = '';
let lastInputImageName = ''

function handleUpload() {
    $.ajax({
        type: 'POST',
        url: "/store",
        data: dataFile,
        contentType: false,
        processData: false,
        enctype: 'multipart/form-data',
<<<<<<< HEAD
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
=======
        success: (data) => {
            let oldImages = localStorage.getItem('oldImages') ? JSON.parse(localStorage.getItem('oldImages')) : []

            if (data.result.status_code != 2) {
                if (data.result.status_code == 1){
                    let html = '';
                    html += `<img src='/results/${data.result.file_name}'>`
                    $('#upscaledImg .image img[fieldname = "inputImage"]').attr('src', `results/${data.result.file_name}`);
                    $('#upscaledImg .image img[fieldname = "inputImage"]').attr('data-zoom', `results/${data.result.file_name}`);
                    $('#upscaledImg .image img[fieldname = "inputImage"]').attr('data-id', `${data.result.file_name}`);

                    // $(`.image img[src="results/${lastItem}"]`).attr('src', `results/${data.result.file_name}`)
console.log(data.custom_file_name)
if (lastInputImageName !=
    '') {
        lastInputImageName = data.custom_file_name
    }

                     if(lastInputImageName != data.custom_file_name) {
                        lastInputImageName = data.custom_file_name
                        lastItem = ''
                    } else {
                        $(`.image img[data-id="${lastItem}"]`).attr('src', `results/${data.result.file_name}`)

                    }

                    lastItem = data.result.file_name;
                    // $(`.image img[data-id="${lastItem}"]`).attr('data-id', `${lastItem}`);

                    // zoom
                    $('#upscaledImg .image img').addClass('zoomImage1');

                    $('#upscaledImg .image img').attr('fieldname', '');
                    $('.loading').remove();

                    let newItem = {
                        'origin': data.image_origin,
                        'result': data.result.file_name,
                    }

                    if (!containsObject(oldImages, newItem)) {
                        oldImages.push(newItem);
                    }

                    // $(".zoomImage").elevateZoom({
                    //     zoomType: 'lens',
                    //     lensShape: 'round',
                    //     lensSize: 200
                    // });

                    // $(".zoomImage").loupe()

                    localStorage.setItem('oldImages', JSON.stringify(oldImages));


                    for (let i = 0; i < $(".zoomImage1").length; i++){
                        new Drift($(".zoomImage1")[i], {
                            inlinePane: true,
                            containInline: true,
                            // inlinePane: 10 5,
                            sourceAttribute: 'data-zoom',

                            paneContainer: document.querySelector('#orgImg'),
                            zoomFactor: 2
                          });

                    }
                }
                clearInterval(intervalUpload)
>>>>>>> fda8f57b8191873b9227b4019f90e1dce0a0d614
            }
        },
        error: function(data) {
            console.log(data);
        }
    });
}

function zoom(e){
    var zoomer = e.currentTarget;
    e.offsetX ? offsetX = e.offsetX : offsetX = e.touches[0].pageX
    e.offsetY ? offsetY = e.offsetY : offsetX = e.touches[0].pageX
    x = offsetX/zoomer.offsetWidth*100
    y = offsetY/zoomer.offsetHeight*100
    zoomer.style.backgroundPosition = x + '% ' + y + '%';
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