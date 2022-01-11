@extends('master')

@section('content')
@extends('layout.header')

    <div class="content-contain">
        <div class="content-left intro">
            <div class="function">
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{asset('asset/logo-big.png')}}" class="d-block carousel-image" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <button class="carousel-ratio">x1</button>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{asset('asset/logo-big.png')}}" class="d-block carousel-image" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <button class="carousel-ratio">x2</button> </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{asset('asset/logo-big.png')}}" class="d-block carousel-image" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <button class="carousel-ratio">x4</button> </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{asset('asset/logo-big.png')}}" class="d-block carousel-image" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <button class="carousel-ratio">x8</button> </div>
                        </div>
                    </div>
                </div>
                <!-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button> -->
            </div>
        </div>
        <h1 class="aims">AI upscale <br>Enhance image</h1>
    </div>
    <div id="image-contain" class="content-right-contain">
        <div class="content-inside">
            <div class="image-sample intro intro-next "></div>
            <div class="header3 intro intro-next">Drop image here</div>
            <div class="instruction intro intro-next">JPG, PNG, Max size ...</div>
            <!-- <input id="loadImage" class="upload-image" type='file' /> -->

            <label class="d-btn custom-file-upload intro intro-next">
                <input type="file" multiple id="gallery-photo-add">
                Custom Upload
            </label>
            <div class="gallery"></div>
            <input type="hidden" value="{{ route('store-file') }}" id="url-upload">
            <div class="ratio-contain">
                <button id="ratio-x2" class="d-btn ratio-btn btn-upload-image" data-scale="2">x2</button>
                <button id="ratio-x4" class="d-btn ratio-btn btn-upload-image" data-scale="4">x4</button>
            </div>
        </div>
    </div>
    <div class="result" id="upscaleResult">
        <div class="result-header">
            {{-- <div class="result-time">Some thing here</div> --}}
            <button id="delImg" class="d-btn delete-result">Delete</button>
        </div>
        <div class="result-content" id="upscaleImage">
            <div class="result-img origin-image" id="orgImg">
                <!-- <img src="./asset/icon/Screenshot from 2021-12-19 01-45-58.png" alt="Origin-image"> -->
            </div>
            <div class="result-img upscaled-image" id="upscaledImg">
                <!-- <img src="./asset/icon/Screenshot from 2021-12-19 01-45-58.png" alt="Upscaled-image"> -->
            </div>
        </div>
        <div class="result-img upscaled-image" id="upscaledImg" style="width: 500px; height:300px;">
        </div>
    </div>
    <div class="result-download">
        <button id="imgDownload" class="d-btn">Download</button>
    </div>
</div>

<div id="deletePopup" class="d-popup-contain">
    <div class="d-popup">
        <div class="popup-close pop-cls"></div>
        <div class="popup-content">
            <p><b>Are you sure</b>
                <br> You are about to delete this upload. This action is irreversible.
            </p>
            <div class="popup-btn">
                <button class="d-btn pop-cls delete-cancel">Cancel</button>
                <button id="delete-cont" class="d-btn delete-continue ">Yes</button>
            </div>
        </div>
    </div>
</div>

@endsection
