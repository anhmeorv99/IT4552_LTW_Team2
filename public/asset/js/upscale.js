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
        localStorage.clear();
    }


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
let scaleUp = '';
$('.btn-upload-image').on('click', function () {
    scaleUp = $(this).data('scale')
    $(this).attr('disabled', true)
    dataFile.append('scale', scaleUp);
    $($('#upscaledImg .image')[0]).append(loadingHtml);
    intervalUpload = setInterval(function () { handleUpload(); }, 3000);
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

        for (let i = 0; i < $("#upscaledImg .zoomImage").length; i++){
            let resultImage =  $("#upscaledImg .zoomImage").eq(i).find('img').eq(0)


                let origImage = $('#orgImg').find('img').eq(resultImage.index())
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
    if (document.getElementById('user_id_login') != null){
        dataFile.append('user_id', Number(document.getElementById('user_id_login').value));
    }else{
        dataFile.append('user_id', null);
    }
    $.ajax({
        type: 'POST',
        url: "/store",
        data: dataFile,
        contentType: false,
        processData: false,
        enctype: 'multipart/form-data',
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


$('#imgDownload').on('click', function() {

    var zip = new JSZip();
    let folder = zip.folder("results");
    let upscale_imgs = $('#upscaledImg img')

    for (let i=0; i< upscale_imgs.length; i++){
        let base64 = getBase64Image(upscale_imgs[i]);

        folder.file(`${upscale_imgs[i].src.substring(upscale_imgs[i].src.lastIndexOf('/') +1 )}`, base64, {base64: true})

    }

    zip.generateAsync({type:"blob"})
               .then(function(content) {
                //see FileSaver.js
                saveAs(content, "results.zip");
      });
});

function getBase64Image(img) {
    var canvas = document.createElement("canvas");
    canvas.width = img.naturalWidth;
    canvas.height = img.naturalHeight;
    var ctx = canvas.getContext("2d");
    ctx.drawImage(img, 0, 0);
    var dataURL = canvas.toDataURL("image/png");
    return dataURL.replace(/^data:image\/(png|jpg);base64,/, "");
  }
