(function(root, factory) {
    if (typeof module !== 'undefined' && module.exports) {
        module.exports = factory();
    } else {
        root.ImageZoom = factory();
    }
}(this, function() {
    /**
     * @param {Object} container DOM element, which contains an image to be zoomed (required)
     * @param {Object} options js-image-zoom options (required)
     * **width** (number) - width of the source image (optional)
     * **height** (number) - height of the source image (optional).
     * **zoomWidth** (number) - width of the zoomed image. Zoomed image height equals source image height (optional)
     * **img** (string) - url of the source image. Provided if container does not contain img element as a tag (optional)
     * **scale** (number) - zoom scale. if not provided, scale is calculated as natural image size / image size, provided in params (optional if zoomWidth param is provided)
     * **offset** (object) - {vertical: number, horizontal: number}. Zoomed image offset (optional)
     * **zoomContainer** (node) - DOM node reference where zoomedImage will be appended to (default to the container element of image)
     * **zoomStyle** (string) - custom style applied to the zoomed image (i.e. 'opacity: 0.1;background-color: white;')
     * **zoomPosition** (string) - position of zoomed image. It can be:  `top`, `left`, `bottom`, `original` or the default `right`.
     * **zoomLensStyle** (string) custom style applied to to zoom lents (i.e. 'opacity: 0.1;background-color: white;')
     */
    return function ImageZoom(container, opts) {
        "use strict";
        var options = opts;
        if (!container) {
            return;
        }
        var data = {
            zoomContainer: container,
            sourceImg: {
                element: null,
                width: 0,
                height: 0,
                naturalWidth: 0,
                naturalHeight: 0
            },
            zoomedImgOffset: {
                vertical: 0,
                horizontal: 0
            },
            zoomedImg: {
                element: null,
                width: 0,
                height: 0
            },
            zoomLens: {
                element: null,
                width: 0,
                height: 0
            }
        };

        var div = document.createElement('div');
        var lensDiv = document.createElement('div');
        var scaleX;
        var scaleY;
        var offset;
        data.zoomedImgOffset = {
            vertical: options.offset && options.offset.vertical ? options.offset.vertical : 0,
            horizontal: options.offset && options.offset.horizontal ? options.offset.horizontal : 0
        };

        function getOffset(el) {
            if (el) {
                var elRect = el.getBoundingClientRect();
                return { left: elRect.left, top: elRect.top };
            }
            return { left: 0, top: 0 };
        }

        function leftLimit(min) {
            return options.width - min;
        }

        function topLimit(min) {
            return options.height - min;
        }

        function getValue(val, min, max) {
            if (val < min) {
                return min;
            }
            if (val > max) {
                return max;
            }
            return val;
        }

        function getPosition(v, min, max) {
            var value = getValue(v, min, max);
            return value - min;
        }

        function zoomLensLeft(left) {
            var leftMin = data.zoomLens.width / 2;
            return getPosition(left, leftMin, leftLimit(leftMin));
        }

        function zoomLensTop(top) {
            var topMin = data.zoomLens.height / 2;
            return getPosition(top, topMin, topLimit(topMin));
        }

        function setZoomedImgSize(data) {
            data.zoomedImg.element.style.width = '100%';
            data.zoomedImg.element.style.height = '100%';
        }

        function onSourceImgLoad() {
            // use height determined by browser if height is not set in options
            options.height = data.sourceImg.element.height;
            data.sourceImg.element.style.height = options.fillContainer //? '100%' : options.height + 'px';

            // use width determined by browser if width is not set in options
            options.width = data.sourceImg.element.width;
            data.sourceImg.element.style.width = options.fillContainer //? '100%' : options.width + 'px';

            setZoomedImgSize(data);

            data.sourceImg.naturalWidth = data.sourceImg.element.naturalWidth;
            data.sourceImg.naturalHeight = data.sourceImg.element.naturalHeight;
            data.zoomedImg.element.style.backgroundSize = data.sourceImg.naturalWidth / options.scale + 'px ' + data.sourceImg.naturalHeight / options.scale + 'px';

            data.zoomLens.element.style.background = 'white';
            data.zoomLens.element.style.opacity = '0.4';

            scaleX = data.sourceImg.naturalWidth / options.width;
            scaleY = data.sourceImg.naturalHeight / options.height;
            offset = getOffset(data.sourceImg.element);

            data.zoomedImg.element.style.display = 'block';
            data.zoomLens.width = data.zoomedImg.element.clientWidth / scaleX;
            data.zoomLens.height = data.zoomedImg.element.clientHeight / scaleY;
            data.zoomedImg.element.style.display = 'none';

            data.zoomLens.element.style.position = 'absolute';
            data.zoomLens.element.style.width = data.zoomLens.width + 'px';
            data.zoomLens.element.style.height = data.zoomLens.height + 'px';
            data.zoomLens.element.pointerEvents = 'none';
        }

        function setup() {
            data.sourceImg.element = container.children[0];

            // if sourceImg is not an img (might be a picture element), try to find one
            if (data.sourceImg.element.nodeName !== "IMG") {
                data.sourceImg.element = data.sourceImg.element.querySelector('img');
            }

            options = options || {};
            container.style.position = 'relative';
            data.sourceImg.element.style.width = options.fillContainer ? '100%' : options.width ? options.width + 'px' : 'auto';
            data.sourceImg.element.style.height = options.fillContainer ? '100%' : options.height ? options.height + 'px' : 'auto';

            data.zoomLens.element = container.appendChild(lensDiv);
            data.zoomLens.element.style.display = 'none';
            data.zoomLens.element.classList.add('js-image-zoom__zoomed-area');

            data.zoomedImg.element = data.zoomContainer.appendChild(div);
            data.zoomedImg.element.classList.add('js-image-zoom__zoomed-image');
            data.zoomedImg.element.style.backgroundImage = "url('" + data.sourceImg.element.src + "')";
            data.zoomedImg.element.style.backgroundRepeat = 'no-repeat';
            data.zoomedImg.element.style.display = 'none';

            data.zoomedImg.element.style.position = 'absolute';
            data.zoomedImg.element.style.bottom = data.zoomedImgOffset.vertical - (data.zoomedImgOffset.vertical * 2) + 'px';
            data.zoomedImg.element.style.left = 'calc(50% + ' + data.zoomedImgOffset.horizontal + 'px)';
            // data.zoomedImg.element.style.bottom = 'calc(50% + ' + data.zoomedImgOffset.vertical + 'px)';
            data.zoomedImg.element.style.transform = 'translate3d(-50%, 100%, 0)';

            // setup event listeners
            container.addEventListener('mousemove', events, false);
            container.addEventListener('mouseenter', events, false);
            container.addEventListener('mouseleave', events, false);
            data.zoomLens.element.addEventListener('mouseenter', events, false);
            data.zoomLens.element.addEventListener('mouseleave', events, false);
            window.addEventListener('scroll', events, false);
            return data;
        }

        function kill() {
            // remove event listeners
            container.removeEventListener('mousemove', events, false);
            container.removeEventListener('mouseenter', events, false);
            container.removeEventListener('mouseleave', events, false);
            data.zoomLens.element.removeEventListener('mouseenter', events, false);
            data.zoomLens.element.removeEventListener('mouseleave', events, false);
            window.removeEventListener('scroll', events, false);

            // remove dom nodes
            if (data.zoomLens && data.zoomedImg) {
                container.removeChild(data.zoomLens.element);
                data.zoomContainer.removeChild(data.zoomedImg.element);
            }
            data.sourceImg.element.style.width = '';
            data.sourceImg.element.style.height = '';
            return data;
        }

        var events = {
            handleEvent: function(event) {
                switch (event.type) {
                    case 'mousemove':
                        return this.handleMouseMove(event);
                    case 'mouseenter':
                        return this.handleMouseEnter(event);
                    case 'mouseleave':
                        return this.handleMouseLeave(event);
                    case 'scroll':
                        return this.handleScroll(event);
                }
            },
            handleMouseMove: function(event) {
                var offsetX;
                var offsetY;
                var backgroundTop;
                var backgroundRight;
                var backgroundPosition;
                if (offset) {
                    offsetX = zoomLensLeft(event.clientX - offset.left);
                    offsetY = zoomLensTop(event.clientY - offset.top);
                    backgroundTop = offsetX * scaleX;
                    backgroundRight = offsetY * scaleY;
                    backgroundPosition = '-' + backgroundTop + 'px ' + '-' + backgroundRight + 'px';
                    data.zoomedImg.element.style.backgroundPosition = backgroundPosition;
                    data.zoomLens.element.style.cssText += 'transform:' + 'translate(' + offsetX + 'px,' + offsetY + 'px);display: block;left:0px;top:0px;'

                }
            },
            handleMouseEnter: function() {
                data.zoomedImg.element.style.display = 'block';
                data.zoomLens.element.style.display = 'block';

            },
            handleMouseLeave: function() {
                data.zoomedImg.element.style.display = 'none';
                data.zoomLens.element.style.display = 'none';
            },
            handleScroll: function() {
                offset = getOffset(data.sourceImg.element);
            }
        };

        // Setup/Initialize library
        setup();

        if (data.sourceImg.element.complete) {
            onSourceImgLoad();
        } else {
            data.sourceImg.element.onload = onSourceImgLoad;
        }

        return {
            setup: function() {
                setup();
            },
            kill: function() {
                kill();
            },
            _getInstanceInfo: function() {
                return {
                    setup: setup,
                    kill: kill,
                    onSourceImgLoad: onSourceImgLoad,
                    data: data,
                    options: options
                }
            }
        }
    }
}));