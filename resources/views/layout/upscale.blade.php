<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('asset/css/style.css')}}">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Image's revolution</title>
</head>

<body>
    <div class="header">
        <div class="header-logo-contain">
            <div class="header-logo"></div>
            <span class="header-brand">Kwarovski</span>
        </div>
        <div class="header-signIn">
            <button class="d-btn" id="signIn">Sign in</button>
        </div>
    </div>
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
                            <img src="./asset/logo-big.png" class="d-block carousel-image" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <button class="carousel-ratio">x1</button>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="./asset/logo-big.png" class="d-block carousel-image" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <button class="carousel-ratio">x2</button> </div>
                        </div>
                        <div class="carousel-item">
                            <img src="./asset/logo-big.png" class="d-block carousel-image" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <button class="carousel-ratio">x4</button> </div>
                        </div>
                        <div class="carousel-item">
                            <img src="./asset/logo-big.png" class="d-block carousel-image" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <button class="carousel-ratio">x8</button> </div>
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
                    <input class="" type="file" multiple id="gallery-photo-add">
                    Custom Upload
                </label>
                <div class="gallery"></div>
                <div class="ratio-contain">
                    <button id="ratio-x2" class="d-btn ratio-btn">x2</button>
                    <button id="ratio-x4" class="d-btn ratio-btn">x4</button>
                </div>
            </div>
        </div>
    </div>
    <div class="result" id="upscaleResult">
        <div class="result-header">
            <div class="result-time">Some thing here</div>
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
        <div class="result-download">
            <button id="imgDownload" class="d-btn">Download</button>
        </div>
    </div>
    <div class="footer">
        <div class="footer-up">
            <div class="footer-about">
                <p><b style="color: #fff;">About</b>
                    <br> We store the uploaded images securely to allow you to view your history and re-download the enlarged photos without using costly GPU power (and not charge you again). We don't use your pictures for machine learning or anything
                    like that, and we don't share or showcase them either.
                </p>
            </div>
            <div class="footer-contact">
                <p> <b style="color: #fff;">Get in touch</b> <br> Contact us <br> Become an Affiliate <br> Careers
                </p>
            </div>
            <div class="footer-tech">
                <p>
                    <b style="color: #fff;">Technology</b> <br> Wordpress <br> Jetpack <br> Local <br>
                </p>
            </div>
        </div>
        <div class="footer-down">
            <div class="copyright">Copy &#174; All Rights Reserved by Kwarovski</div>
            <div class="footer-icon-contain">
                <div class="footer-icon icon-1"></div>
                <div class="footer-icon icon-2"></div>
                <div class="footer-icon icon-3"></div>
                <div class="footer-icon icon-4"></div>
                <div class="footer-icon icon-5"></div>
            </div>
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

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="{{asset('asset/js/upscale.js')}}"></script>
</body>


</html>
