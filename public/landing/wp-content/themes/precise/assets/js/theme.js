window.la_studio = {};

(function($) {
    "use strict";

    var la_studio = window.la_studio || {},
        $window = $(window),
        $document = $(document),
        $htmlbody = $('html,body'),
        $body = $('body.precise-body'),
        $masthead = $('#masthead'),
        $masthead_inner = $masthead.find('>.site-header-inner'),
        $masthead_aside = $('#masthead_aside'),
        $masthead_aside_inner = $masthead_aside.find('.site-header-inner'),
        $masthead_mb = $('.site-header-mobile'),
        $masthead_mb_inner = $masthead_mb.find('>.site-header-inner'),
        $footer_colophon = $('#colophon'),
        $la_full_page = $('#la_full_page');

    function userAgentDetection() {
        var ua = navigator.userAgent.toLowerCase(),
            platform = navigator.platform.toLowerCase(),
            UA = ua.match(/(opera|ie|firefox|chrome|version)[\s\/:]([\w\d\.]+)?.*?(safari|version[\s\/:]([\w\d\.]+)|$)/) || [null, 'unknown', 0],
            mode = UA[1] == 'ie' && document.documentMode;

        window.laBrowser = {
            name: (UA[1] == 'version') ? UA[3] : UA[1],
            version: UA[2],
            platform: {
                name: ua.match(/ip(?:ad|od|hone)/) ? 'ios' : (ua.match(/(?:webos|android)/) || platform.match(/mac|win|linux/) || ['other'])[0]
            }
        };
    }
    function getOffset(elem) {
        if (elem.getBoundingClientRect && window.laBrowser.platform.name != 'ios') {
            var bound = elem.getBoundingClientRect(), html = elem.ownerDocument.documentElement, htmlScroll = getScroll(html), elemScrolls = getScrolls(elem), isFixed = (styleString(elem, 'position') == 'fixed');
            return {
                x: parseInt(bound.left) + elemScrolls.x + ((isFixed) ? 0 : htmlScroll.x) - html.clientLeft,
                y: parseInt(bound.top) + elemScrolls.y + ((isFixed) ? 0 : htmlScroll.y) - html.clientTop
            };
        }
        var element = elem, position = {x: 0, y: 0};
        if (isBody(elem))return position;
        while (element && !isBody(element)) {
            position.x += element.offsetLeft;
            position.y += element.offsetTop;
            if (window.laBrowser.name == 'firefox') {
                if (!borderBox(element)) {
                    position.x += leftBorder(element);
                    position.y += topBorder(element);
                }
                var parent = element.parentNode;
                if (parent && styleString(parent, 'overflow') != 'visible') {
                    position.x += leftBorder(parent);
                    position.y += topBorder(parent);
                }
            } else if (element != elem && window.laBrowser.name == 'safari') {
                position.x += leftBorder(element);
                position.y += topBorder(element);
            }
            element = element.offsetParent;
        }
        if (window.laBrowser.name == 'firefox' && !borderBox(elem)) {
            position.x -= leftBorder(elem);
            position.y -= topBorder(elem);
        }
        return position;
    }
    function getScroll(elem) {
        return {
            x: window.pageXOffset || document.documentElement.scrollLeft,
            y: window.pageYOffset || document.documentElement.scrollTop
        };
    }
    function getScrolls(elem) {
        var element = elem.parentNode, position = {x: 0, y: 0};
        while (element && !isBody(element)) {
            position.x += element.scrollLeft;
            position.y += element.scrollTop;
            element = element.parentNode;
        }
        return position;
    }
    function styleString(element, style) {
        return $(element).css(style);
    }
    function styleNumber(element, style) {
        return parseInt(styleString(element, style)) || 0;
    }
    function borderBox(element) {
        return styleString(element, '-moz-box-sizing') == 'border-box';
    }
    function topBorder(element) {
        return styleNumber(element, 'border-top-width');
    }
    function leftBorder(element) {
        return styleNumber(element, 'border-left-width');
    }
    function isBody(element) {
        return (/^(?:body|html)$/i).test(element.tagName);
    }
    function getParameterByName(name, url) {
        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }
    function addStyleSheet( css ) {
        var head, styleElement;
        head = document.getElementsByTagName('head')[0];
        styleElement = document.createElement('style');
        styleElement.setAttribute('type', 'text/css');
        if (styleElement.styleSheet) {
            styleElement.styleSheet.cssText = css;
        } else {
            styleElement.appendChild(document.createTextNode(css));
        }
        head.appendChild(styleElement);
        return styleElement;
    }
    function add_query_arg(uri, key, value){
        var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
        var separator = uri.indexOf('?') !== -1 ? "&" : "?";
        if (uri.match(re)) {
            return uri.replace(re, '$1' + key + "=" + value + '$2');
        }
        else {
            return uri + separator + key + "=" + value;
        }
    }
    function showMessageBox( html ){
        lightcase.start({
            href: '#',
            showSequenceInfo: false,
            maxWidth:600,
            maxHeight: 500,
            onFinish: {
                insertContent: function () {
                    lightcase.get('contentInner').children().html('<div class="la-global-message">' + html + '</div>');
                    lightcase.resize();
                    clearTimeout(la_studio.timeOutMessageBox);
                    la_studio.timeOutMessageBox = setTimeout(function(){
                        lightcase.close();
                    }, 20 * 1000);
                }
            },
            onClose : {
                qux: function() {
                    clearTimeout(la_studio.timeOutMessageBox);
                }
            }
        });

    }
    function isCookieEnable (){
        if (navigator.cookieEnabled) return true;
        document.cookie = "cookietest=1";
        var ret = document.cookie.indexOf("cookietest=") != -1;
        document.cookie = "cookietest=1; expires=Thu, 01-Jan-1970 00:00:01 GMT";
        return ret;
    }
    userAgentDetection();

    la_studio.helps = {

        isDebug : true,
        is_rtl: ($body.hasClass('rtl') ? true : false),
        is_active_vc : ($body.hasClass('wpb-js-composer') ? true : false),
        slugify: function(text){
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-')           // Replace spaces with -
                .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
                .replace(/\-\-+/g, '-')         // Replace multiple - with single -
                .replace(/^-+/, '')             // Trim - from start of text
                .replace(/-+$/, '');
        },
        log: function(){
            if(la_studio.helps.isDebug){
                console.log(arguments);
            }
        },
        getTransforms:  function(translate3d){
            return {
                '-webkit-transform': translate3d,
                '-moz-transform': translate3d,
                '-ms-transform':translate3d,
                'transform': translate3d
            };
        },
        makeRandomId : function(){
            var text = "",
                char = "abcdefghijklmnopqrstuvwxyz",
                num = "0123456789",
                i;
            for( i = 0; i < 5; i++ ){
                text += char.charAt(Math.floor(Math.random() * char.length));
            }
            for( i = 0; i < 5; i++ ){
                text += num.charAt(Math.floor(Math.random() * num.length));
            }
            return text;
        },
        getOffset: function( $elm ){
            return $elm.length ? getOffset($elm[0]) : {x:0, y:0};
        },
        getAdminbarHeight : function(){
            return ($('#wpadminbar').length && $('#wpadminbar').css('position') == 'fixed') ? $('#wpadminbar').height() : 0;
        },
        fullscreenFooterCalcs: function() {

        },
        shuffleitem : function ($animarr) {
            var array = [];
            $animarr.each(function (i) {
                array[i] = $(this);
            });

            // shuffle
            var copy = [], n = array.length, i;
            while (n) {
                i = Math.floor(Math.random() * array.length);
                if (i in array) {
                    copy.push(array[i]);
                    delete array[i];
                    n--;
                }
            }

            return copy;
        },
        setuptop : function ($animarr) {
            $animarr.each(function () {
                var $item = $(this),
                    t = parseInt($item.css('top'), 10) + ( $item.height() / 2);
                $item.css({
                    top: t + 'px',
                    opacity: 0
                });
            });
        },
        animate_hide : function(animation, $container, $animarr, callback){
            var animationtimeout = 0;

            if (animation === "fade" || animation === "normal") {
                $animarr.each(function () {
                    var element = $(this);
                    $(this).animate({
                        "opacity": 0
                    }, 800, function(){
                        $(element).addClass('isotope-hide-element');
                        $(element).remove();
                    });
                });
                animationtimeout = 1000;
            } else if (animation === "seqfade" || animation === "upfade" || animation === "sequpfade") {
                $($animarr.get().reverse()).each(function (i) {
                    var element = $(this);
                    window.setTimeout(function () {
                        $(element).show().animate({
                            "opacity": 0
                        }, 800, function(){
                            $(element).addClass('isotope-hide-element');
                            $(element).remove();
                        });
                    }, 100 + i * 50);
                });
                animationtimeout = 1000 + $animarr.length * 50;
            } else if (animation === "randomfade" || animation === "randomupfade") {
                var shufflearray = la_studio.helps.shuffleitem($animarr);
                $(shufflearray).each(function (i) {
                    var element = $(this);
                    window.setTimeout(function () {
                        $(element).show().animate({
                            "opacity": 0
                        }, 800, function(){
                            $(element).addClass('isotope-hide-element');
                            $(element).remove();
                        });
                    }, 100 + i * 50);
                });
                animationtimeout = 1000 + $animarr.length * 50;
            }

            window.setTimeout(function () {
                $container.isotope('remove', $animarr);
                callback.call();
            }, animationtimeout);
        },
        animate_load : function( animation, $container, $animarr, callback ){
            var animationtimeout = 0;
            var shufflearray;
            var i;

            // hide all element that not yet loaded
            $animarr.each(function () {
                $(this).css({"opacity": 0});
            });

            if (animation === "normal") {
                $animarr.each(function () {
                    $(this).css({"opacity": 1});
                });
                animationtimeout = 1000;
            } else if (animation === "fade") {
                $animarr.each(function () {
                    $(this).animate({
                        "opacity": 1
                    }, 1000);
                });
                animationtimeout = 1000;
            } else if (animation === "seqfade") {
                $animarr.each(function (i) {
                    var element = $(this);
                    window.setTimeout(function () {
                        $(element).show().animate({
                            "opacity": 1
                        }, 1000);
                    }, 100 + i * 50);
                });
                animationtimeout = 500 + ($animarr.length * 50);
            } else if (animation === "upfade") {
                la_studio.helps.setuptop($animarr);
                $animarr.each(function () {
                    var element = $(this);
                    $(element).animate({
                        top: parseInt($(element).css('top'), 10) - ( $(element).height() / 2),
                        opacity: 1
                    }, 1500);
                });
                animationtimeout = 2000;
            } else if (animation === "sequpfade") {
                la_studio.helps.setuptop($animarr);
                $animarr.each(function (i) {
                    var element = $(this);
                    window.setTimeout(function () {
                        $(element).animate({
                            top: parseInt($(element).css('top'), 10) - ( $(element).height() / 2),
                            opacity: 1
                        }, 1000);
                    }, 100 + i * 50);
                });
                animationtimeout = 500 + ($animarr.length * 50);
            } else if (animation === "randomfade") {
                shufflearray = la_studio.helps.shuffleitem($animarr);
                var animaterandomfade = function () {
                    var element = shufflearray.pop();
                    $(element).animate({
                        "opacity": 1
                    }, 1000);
                };
                for (i = 0; i < shufflearray.length; i++) {
                    window.setTimeout(animaterandomfade, 75 + i * 50);
                }
                animationtimeout = 500 + ($animarr.length * 50);
            } else if (animation === "randomupfade") {
                shufflearray = la_studio.helps.shuffleitem($animarr);
                la_studio.helps.setuptop();
                var animaterandomupfade = function () {
                    var element = shufflearray.pop();
                    $(element).animate({
                        top: parseInt($(element).css('top'), 10) - ( $(element).height() / 2),
                        opacity: 1
                    }, 1000);
                };
                for (i = 0; i < shufflearray.length; i++) {
                    window.setTimeout(animaterandomupfade, 75 + i * 50);
                }
                animationtimeout = 500 + ($animarr.length * 50);
            }

            window.setTimeout(function () {
                callback.call();
            }, (animationtimeout + 1000));
        },
        getMobileMenuEffect : function(){
            var animationClasses = {
                classin : 'dl-animate-in-2',
                classout : 'dl-animate-out-2'
            };
            switch (precise_configs.mm_mb_effect){
                case "1":
                    animationClasses = {
                        classin : 'dl-animate-in-1',
                        classout : 'dl-animate-out-1'
                    };
                    break;

                case "2":
                    animationClasses = {
                        classin : 'dl-animate-in-2',
                        classout : 'dl-animate-out-2'
                    };
                    break;

                case "3":
                    animationClasses = {
                        classin : 'dl-animate-in-3',
                        classout : 'dl-animate-out-3'
                    };
                    break;

                case "4":
                    animationClasses = {
                        classin : 'dl-animate-in-4',
                        classout : 'dl-animate-out-4'
                    };
                    break;

                case "5":
                    animationClasses = {
                        classin : 'dl-animate-in-5',
                        classout : 'dl-animate-out-5'
                    };
                    break;

            }

            return animationClasses;
        }

    }

    la_studio.shortcodes = {
        unit_responsive : function(){
            var xlg = '',
                lg  = '',
                md  = '',
                sm  = '',
                xs  = '',
                mb  = '';
            $('.la-unit-responsive').each(function(){
                var t 		= $(this),
                    n 		= t.attr('data-responsive-json-new'),
                    target 	= t.attr('data-unit-target'),
                    tmp_xlg = '',
                    tmp_lg  = '',
                    tmp_md  = '',
                    tmp_sm  = '',
                    tmp_xs  = '',
                    tmp_mb  = '';
                if (typeof n !== 'undefined' || n != null) {
                    $.each($.parseJSON(n), function (i, v) {
                        var css_prop = i;
                        if (typeof v !== 'undefined' && v != null && v != '') {
                            $.each(v.split(";"), function(i, vl) {
                                if (typeof vl !== 'undefined' && vl != null && vl != '') {
                                    var splitval = vl.split(":"),
                                        _elm_attr = css_prop + ":" + splitval[1] + ";";
                                    switch( splitval[0]) {
                                        case 'xlg':
                                            tmp_xlg     += _elm_attr;
                                            break;
                                        case 'lg':
                                            tmp_lg      += _elm_attr;
                                            break;
                                        case 'md':
                                            tmp_md      += _elm_attr;
                                            break;
                                        case 'sm':
                                            tmp_sm      += _elm_attr;
                                            break;
                                        case 'xs':
                                            tmp_xs      += _elm_attr;
                                            break;
                                        case 'mb':
                                            tmp_mb      += _elm_attr;
                                            break;
                                    }
                                }
                            });
                        }
                    });
                }
                if(tmp_xlg!='') {   xlg += target+ '{' + tmp_xlg + '}' }
                if(tmp_lg!='') {    lg  += target+ '{' + tmp_lg  + '}' }
                if(tmp_md!='') {    md  += target+ '{' + tmp_md  + '}' }
                if(tmp_sm!='') {    sm  += target+ '{' + tmp_sm  + '}' }
                if(tmp_xs!='') {    xs  += target+ '{' + tmp_xs  + '}' }
                if(tmp_mb!='') {    mb  += target+ '{' + tmp_mb  + '}' }
            });

            var css = '';
            css += lg;
            css += "\n@media (min-width: 1824px) {\n" + xlg + "\n}";
            css += "\n@media (max-width: 1199px) {\n" + md  + "\n}";
            css += "\n@media (max-width: 991px)  {\n" + sm  + "\n}";
            css += "\n@media (max-width: 767px)  {\n" + xs  + "\n}";
            css += "\n@media (max-width: 479px)  {\n" + mb  + "\n}";
            addStyleSheet(css);
            $('.la-divider').removeAttr('style');
        },
        fix_tabs : function(){
            $document
                .on( 'click.vc.tabs.data-api', '[data-vc-tabs]', function(e){
                    var plugin_tabs, $slick_slider, $selector;
                    plugin_tabs = $(this).data('vc.tabs');
                    $selector = $(plugin_tabs.getSelector());
                    $slick_slider = $('.slick-slider', $selector);
                    e.preventDefault();
                    $('.elm-ajax-loader', $selector).trigger('la_event_ajax_load');
                    if( $slick_slider.length > 0 ){
                        $slick_slider.css('opacity','0').slick("setPosition").css('opacity','1');
                    }
                })
                .on('show.vc.accordion','[data-vc-accordion]',function(e){
                    var $data = $(this).data("vc.accordion"),
                        $selector = $data.getTarget(),
                        $slick_slider = $('.slick-slider', $selector);
                    $('.elm-ajax-loader', $selector).trigger('la_event_ajax_load');
                    if( $slick_slider.length > 0 ){
                        $slick_slider.css('opacity','0').slick("setPosition").css('opacity','1');
                    }
                });
        },
        fix_parallax_row: function(){
            var call_vc_parallax = setInterval(function(){
                if(window.vcParallaxSkroll !== 'undefined'){
                    try{
                        window.vcParallaxSkroll.refresh();
                    }catch (ex){
                        //la_studio.helps.log(ex);
                    }
                    clearInterval(call_vc_parallax);
                }
            },100);
        },
        fix_rtl_row_fullwidth : function(){
            if(!la_studio.helps.is_active_vc){
                return;
            }

            function la_fix_rtl_full_width_row(){
                var $elements = $('[data-vc-full-width="true"]');
                $.each($elements, function () {
                    var $el = $(this);
                    $el.css('right', $el.css('left')).css('left', '');
                });
            }
            if(la_studio.helps.is_rtl){
                // Fixes rows in RTL
                $(document).on('vc-full-width-row', function () {
                    la_fix_rtl_full_width_row();
                });
                la_fix_rtl_full_width_row();
            }
        },
        fix_row_fullwidth: function(){
            if(!la_studio.helps.is_active_vc){
                return;
            }
            var winW = $window.width(),
                $page = $('#main.site-main');

            $document.on('vc-full-width-row', function(e){
                for (var i = 1; i < arguments.length; i++) {
                    var $el = $(arguments[i]);
                    $el.addClass("vc_hidden");
                    var $el_full = $el.next(".vc_row-full-width");
                    $el_full.length || ($el_full = $el.parent().next(".vc_row-full-width"));
                    var el_margin_left = parseInt($el.css("margin-left"), 10),
                        el_margin_right = parseInt($el.css("margin-right"), 10),
                        offset = 0 - $el_full.offset().left - el_margin_left + $page.offset().left + parseInt($page.css('padding-left')),
                        width = $page.width();
                    if ($el.css({
                            position: "relative",
                            left: offset,
                            "box-sizing": "border-box",
                            width: $page.width()
                        }), !$el.data("vcStretchContent")) {
                        var padding = -1 * offset;
                        0 > padding && (padding = 0);
                        var paddingRight = width - padding - $el_full.width() + el_margin_left + el_margin_right;
                        0 > paddingRight && (paddingRight = 0), $el.css({
                            "padding-left": padding + "px",
                            "padding-right": paddingRight + "px"
                        })
                    }
                    $el.attr("data-vc-full-width-init", "true"), $el.addClass('vc-has-modified').removeClass("vc_hidden");
                }
            });
            $document.trigger('vc-full-width-row',$('[data-vc-full-width="true"]'));

            $document.on('la-vc-gradient', '.la_row_grad', function(e){
                var selector = $(this),
                    grad = selector.data('grad'),
                    row = selector.next();
                grad = grad.replace('url(data:image/svg+xml;base64,','');
                var e_pos = grad.indexOf(';');
                grad = grad.substring(e_pos+1);
                row.attr('style', row.attr('style') + grad);
                selector.remove();
            });

            $('.la_row_grad').trigger('la-vc-gradient');
            if(typeof vc_js === "undefined"){
                $window.resize(function(){
                    $document.trigger('vc-full-width-row',$('[data-vc-full-width="true"]'));
                });
            }
        },
        google_map: function(){
            $('.la-shortcode-maps').each(function(){
                $(this).closest('.wpb_wrapper').height('100%');
            });
            $window.on('load resize',function(){
                var $maps = $('.map-full-height');
                $maps.css('height',$maps.closest('.vc_column-inner ').height());
            });
        },
        counter : function(){
            var $shortcode = $('.la-stats-counter');
            $shortcode.appear();
            $shortcode.on('appear', function(){
                var $this = $(this),
                    $elm = $this.find('.icon-value');
                if(false === !!$this.data('appear-success')){
                    var endNum = parseFloat($elm.data('counter-value'));
                    var Num = $elm.data('counter-value') + ' ';
                    var speed = parseInt($elm.data('speed'));
                    var sep = $elm.data('separator');
                    var dec = $elm.data('decimal');
                    var dec_count = Num.split(".");
                    var grouping = true;
                    var prefix = endNum > 0 && endNum < 10 ? '0' : '';
                    if(dec_count[1])
                        dec_count = dec_count[1].length-1;
                    else
                        dec_count = 0;
                    if(dec == "none")
                        dec = "";
                    if(sep == "none")
                        grouping = false;
                    else
                        grouping = true;

                    $elm.countup({
                        startVal: 0,
                        endVal: endNum,
                        decimals: dec_count,
                        duration: speed,
                        options: {
                            useEasing : true,
                            useGrouping : grouping,
                            separator : sep,
                            decimal : dec,
                            prefix: prefix
                        }
                    });
                    $this.data('appear-success','true');
                }
            });
        },
        countdown : function(){
            $document.on('la_event_countdown','.elm-countdown-dateandtime',function(e){
                var $this = $(this),
                    t = new Date($this.html()),
                    tfrmt = $this.data('countformat'),
                    labels_new = $this.data('labels'),
                    new_labels = labels_new.split(","),
                    labels_new_2 = $this.data('labels2'),
                    new_labels_2 = labels_new_2.split(",");

                var server_time = new Date($this.data('time-now'));

                var ticked = function (a){
                    var $amount = $this.find('.countdown-amount'),
                        $period = $this.find('.countdown-period');
                    $amount.css({
                        'color': $this.data('tick-col'),
                        'border-color':$this.data('br-color'),
                        'border-width':$this.data('br-size'),
                        'border-style':$this.data('br-style'),
                        'border-radius':$this.data('br-radius'),
                        'background':$this.data('bg-color'),
                        'padding':$this.data('padd')
                    });
                    $period.css({
                        'font-size':$this.data('tick-p-size'),
                        'color':$this.data('tick-p-col')
                    });

                    if($this.data('tick-style')=='bold'){
                        $amount.css('font-weight','bold');
                    }
                    else if ($this.data('tick-style')=='italic'){
                        $amount.css('font-style','italic');
                    }
                    else if ($this.data('tick-style')=='boldnitalic'){
                        $amount.css('font-weight','bold');
                        $amount.css('font-style','italic');
                    }
                    if($this.data('tick-p-style')=='bold'){
                        $period.css('font-weight','bold');
                    }
                    else if ($this.data('tick-p-style')=='italic'){
                        $period.css('font-style','italic');
                    }
                    else if ($this.data('tick-p-style')=='boldnitalic'){
                        $period.css('font-weight','bold');
                        $period.css('font-style','italic');
                    }
                };

                if($this.hasClass('usrtz')){
                    $this.countdown({labels: new_labels, labels1: new_labels_2, until : t, format: tfrmt, padZeroes:true,onTick:ticked});
                }else{
                    $this.countdown({labels: new_labels, labels1: new_labels_2, until : t, format: tfrmt, padZeroes:true,onTick:ticked , serverSync:server_time});
                }
            });
            $('.elm-countdown-dateandtime').trigger('la_event_countdown')
        },
        pie_chart : function(){
            $('.la-circle-progress')
                .appear({ force_process: true })
                .on('appear',function(){
                    var $this = $(this);
                    var value = $this.data('pie-value'),
                        color = $this.data('pie-color'),
                        unit  = $this.data('pie-units'),
                        emptyFill = $this.data('empty-fill'),
                        border = 5,
                        init = $(this).data('has_init'),
                        $el_val = $this.find('.sc-cp-v');

                    if(init !== 'true'){
                        $this.find('.sc-cp-canvas').circleProgress({
                            value: parseFloat(value/100),
                            thickness: border,
                            emptyFill: emptyFill,
                            reverse: false,
                            lineCap: 'round',
                            size: 200,
                            startAngle: - Math.PI / 4,
                            fill: {
                                color: color
                            }
                        }).on('circle-animation-progress', function(event, progress, stepValue) {
                            $el_val.text( parseInt(100 * stepValue) + unit );
                        });
                        $this.data('has_init','true');
                    }
                });
        },
        progress_bar: function(){
            if($.isFunction($.fn.waypoint)){
                $(document).on('la_event:vc_progress_bar', '.vc_progress_bar', function(){
                    $(this).find('.vc_label_units').removeAttr('style');
                    $(this).find('.vc_bar').removeAttr('style');
                    $(this).find(".vc_single_bar").each(function (index) {
                        var $this = $(this),
                            bar = $this.find(".vc_bar"),
                            unit = $this.find(".vc_label_units"),
                            val = bar.data("percentage-value");
                        setTimeout(function () {
                            unit.css({
                                opacity: 1
                            });
                            if(la_studio.helps.is_rtl){
                                unit.css('right', val + '%');
                            }else{
                                unit.css('left', val + '%');
                            }
                            bar.css({
                                width: val + "%"
                            })
                        }, 200 * index);
                    })
                });
                $('.vc_progress_bar').waypoint(function () {
                    $(this).trigger('la_event:vc_progress_bar');
                }, { offset: "85%"} )
            }
        },
        tweetsFeed : function(){
            $('.la-tweets-feed').each(function(idx){
                $(this).attr('id', 'la_tweets_' + idx );
                var $this = $(this),
                    widget_id = $this.attr('data-widget-id'),
                    profile = $this.attr('data-profile'),
                    count = $this.attr('data-amount');

                var config = {
                    "id": '',
                    "profile": {"screenName": 'lastudioweb'},
                    "dataOnly": true,
                    "maxTweets": count,
                    "customCallback": handleTweetCallback
                };
                if(widget_id){
                    config.id = widget_id;
                }
                if(profile){
                    config.profile = {"screenName": profile};
                }

                function handleTweetCallback(tweets){
                    var html = '';
                    for (var i = 0, lgth = tweets.length; i < lgth ; i++) {
                        var tweetObject = tweets[i];
                        html += '<div class="tweet-feed-item">'
                            + '<div class="tweet-content">' + tweetObject.tweet + '</div>'
                            + '<div class="tweet-infos">' + tweetObject.author + '</div>'
                            + '<div class="tweet-link"><a href="' + tweetObject.permalinkURL + '"><i class="fa fa-twitter"></i>' + tweetObject.time + '</a></div>'
                            + '</div>';
                    }
                    $this.html(html);
                    $('.tweet-content a.link.customisable', $this).each(function(){
                        var $that = $(this);
                        $that.html($that.attr('href'));
                    });
                    if($this.parent('.twitter-feed').hasClass('tweets-slider')){
                        $this.slick({
                            arrows: false,
                            infinite: true,
                            autoplay: true,
                            autoplaySpeed: 5000,
                            adaptiveHeight: true,
                            speed: 1000,
                            rtl: la_studio.helps.is_rtl
                        })
                    }
                }

                twitterFetcher.fetch(config);
            });

        },
        instagramFeed: function(){
            $('.la-instagram-feeds').appear();
            $document.on('la_event_ajax_load_instagram', '.la-instagram-feeds', function(){
                var $this = $(this),
                    _configs = $this.data('feed_config'),
                    $target, feed_configs, feed;

                if($this.hasClass('loading')){
                    return;
                }

                $this.addClass('loading');

                if( '' == precise_configs.instagram_token ){
                    $this.addClass('loaded loaded-error');
                }
                $target = $('.la-instagram-loop', $this);

                var cache_key = '';
                for (var _k in _configs) {
                    if('template' == _k){
                        continue;
                    }
                    cache_key += '_';
                    cache_key += _configs[_k];
                }
                cache_key = la_studio.helps.slugify(cache_key).replace(/\-+/, '_').replace(/\_\_+/g, '_').replace(/^_+/, '');

                feed_configs = $.extend({
                    target: $target.get(0),
                    accessToken: precise_configs.instagram_token,
                    filter: function(image) {
                        //image.created_time_ago = moment.unix(image.created_time).fromNow();
                        return true;
                    },
                    before: function(){
                        $target.html('');
                    },
                    success: function() {
                        if($target.hasClass('la-instagram-slider')){
                            $target.addClass('la-slick-slider');
                            setTimeout(function(){
                                $target.trigger('la_event_init_carousel');
                            },200);
                        }
                        $this.addClass('loaded');

                    },
                    after: function(){
                        if(cache_key != ''){
                            try {
                                Cookies.set(cache_key, 'yes', { expires: 1 });
                                sessionStorage.setItem(cache_key, $target.html());
                            }catch (ex){

                            }
                        }
                    }
                }, _configs);

                try{
                    if(cache_key != ''){
                        var _feedFormCache = sessionStorage.getItem(cache_key);
                        if(Cookies.get(cache_key) == 'yes' && typeof _feedFormCache !== "undefined" && _feedFormCache != null ){
                            $target.html(_feedFormCache);
                            feed_configs.success();
                        }
                        else{
                            feed = new Instafeed(feed_configs);
                            feed.run();
                        }
                    }
                    else{
                        feed = new Instafeed(feed_configs);
                        feed.run();
                    }

                }catch (ex){
                    $this.addClass('loaded loaded-error');
                    la_studio.helps.log(ex);
                }

            });
            $document.on('appear', '.la-instagram-feeds', function( e ){
                $(this).trigger('la_event_ajax_load_instagram');
            })
        },
        timeline: function(){
            function t_get_maxheight($elm){
                var max_height = 0;
                $elm.each(function(){
                    if($(this).outerHeight() > max_height){
                        max_height = $(this).outerHeight();
                    }
                });
                return max_height;
            }
            var $timeline2 = $('.la-timeline-wrap.style-2');
            $timeline2.each(function(){
                var _this = $(this),
                    _h1 = t_get_maxheight( $('.timeline-block:nth-child(2n+1)', _this)),
                    _h2 = t_get_maxheight( $('.timeline-block:nth-child(2n)', _this)),
                    _w = 0;

                $('.timeline-line', _this).css('top', _h1 );

                _this.css({
                    height: _h1 + _h2
                });
                $('.timeline-wrapper', _this).css({
                    height: _h1 + _h2
                });
                $('.timeline-block', _this).each(function(idx){
                    var customStyle = {
                        //left: $(this).outerWidth() * idx,
                        top: 0
                    };
                    if(idx%2 != 0){
                        customStyle.top = _h1;
                    }
                    _w += $(this).outerWidth();
                    $(this).css(customStyle);
                });

                $('.timeline-wrapper', _this).slick({
                    variableWidth: true,
                    infinite: false,
                    prevArrow: '<button type="button" class="slick-prev"><i class="precise-icon-arrow-minimal-left"></i></button>',
                    nextArrow: '<button type="button" class="slick-next"><i class="precise-icon-arrow-minimal-right"></i></button>',
                    draggable: true,
                    rtl: la_studio.helps.is_rtl
                });

                _this.addClass('la-inited');

            });
        },
        fullpage: function(){
            if( "undefined" !== typeof $.fn.fullpage ){
                var anchors = [],
                    navigationTooltips = [],
                    fp_config;

                $('<div class="la-fp-arrows"><ul><li class="prev"><i></i></li><li class="num"><span class="current">01</span><span class="total">01</span></li><li class="next"><i></i></li></ul></div>').appendTo($body);
                $document
                    .on('click', '.la-fp-arrows .prev', function(e){
                        e.preventDefault();
                        $.fn.fullpage.moveSectionUp();
                    })
                    .on('click', '.la-fp-arrows .next', function(e){
                        e.preventDefault();
                        $.fn.fullpage.moveSectionDown();
                    });

                $footer_colophon.addClass('la_fp_section fp-auto-height').attr('data-anchor', 'colophon').appendTo($la_full_page);

                $('.vc_section.la_fp_section').each(function(){
                    var _name = $(this).attr('data-anchor'),
                        _tip = $(this).attr('data-fp-tooltip');
                    if(!_name) _name = la_studio.helps.makeRandomId();
                    if(!_tip) _tip = '';
                    anchors.push(_name);
                    navigationTooltips.push(_tip);

                    /**
                     * Copy background to make parallax
                     */
                    if($('.la_fp_slide.la_fp_child_section', $(this)).length == 0){
                        var $fp_bg = $('<div class="fp-bg" data-parent-anchor="'+_name+'"></div>');
                        $fp_bg.css('background', $(this).css('background'));
                        $(this).addClass('dont-need-bg').prepend($fp_bg);
                    }

                });


                fp_config = $.extend({
                    sectionSelector : '.la_fp_section',
                    slideSelector : '.la_fp_slide',
                    navigation : false,
                    anchors: anchors,
                    navigationTooltips: navigationTooltips,
                    onLeave: function(index, nextIndex, direction){

                        var $that = $(this),
                            $next_elem = $('#la_full_page > .fp-section:nth-child('+nextIndex+')'),
                            $header_sticky_fallback = $('.la-header-sticky-height');

                        $('.la-fp-arrows .num .current').html(nextIndex < 10 ? '0' + nextIndex : nextIndex );

                        var $transformProp = (!navigator.userAgent.match(/(Android|iPod|iPhone|iPad|BlackBerry|IEMobile|Opera Mini)/)) ? 'transform' : 'all';
                        /* Checking header sticky */
                        if($body.hasClass('enable-header-sticky')){
                            if( 'up' == direction && nextIndex == 1 ) {
                                $masthead_inner.css('top', '0');
                                $masthead.removeClass('fp-header-is-sticky is-sticky');
                            }
                            if( 'down' == direction && nextIndex > 1 ) {
                                $masthead_inner.css('top', la_studio.helps.getAdminbarHeight());
                                $masthead.addClass('fp-header-is-sticky is-sticky');
                            }
                        }
                        if($next_elem.hasClass('site-footer')){
                            $next_elem.prev('.vc_section').addClass('last-before-footer');
                        }
                        else{
                            //$next_elem.css({
                            //    paddingTop: $masthead.height()
                            //});
                            $next_elem.find('.wpb_animate_when_almost_visible:not(.animated)').addClass('animated');

                            if($window.width() > fp_config.responsiveWidth){
                                if($that.find('.fp-slides').length){
                                    $that.find('.fp-slide.active .wpb_animate_when_almost_visible.wpb_start_animation').removeClass('wpb_start_animation').addClass('la_reinit_animation');
                                }else{
                                    $that.find('.wpb_animate_when_almost_visible.wpb_start_animation').removeClass('wpb_start_animation').addClass('la_reinit_animation');
                                }
                            }
                        }

                        //$('.fp-parallax').fpParallaxImage('transition', {
                        //    direction : direction
                        //});
                        /* reset animation */
                        $la_full_page.trigger('la_event_fp:onLeave', [index, nextIndex, direction]);
                    },
                    afterLoad: function(anchorLink, index){
                        var $that = $(this),
                            $row_current = $('#la_full_page > .fp-section:nth-child('+index+')');

                        if($row_current.hasClass('site-footer')){
                            $row_current.prev('.vc_section').addClass('last-before-footer');
                        }
                        if($window.width() > fp_config.responsiveWidth) {
                            if ($that.find('.fp-slides').length) {
                                $that.find('.fp-slide.active .wpb_animate_when_almost_visible:not(.wpb_start_animation)').addClass('wpb_start_animation');
                            }
                            else {
                                $that.find('.wpb_animate_when_almost_visible:not(.wpb_start_animation)').addClass('wpb_start_animation');
                            }
                        }

                        $la_full_page.trigger('la_event_fp:afterLoad', [anchorLink, index]);
                    },
                    afterRender: function(){
                        $('.la-fp-arrows .num .total').html(anchors.length);
                        if($body.hasClass('enable-header-transparency')){
                            $masthead.addClass('fp-header-is-transparency');
                        }
                        //$masthead_inner.css('top', la_studio.helps.getAdminbarHeight());

                        $('#fp-nav li:gt('+ parseInt(anchors.length - 1) +')').remove();

                        //$('.fp-parallax').fpParallaxImage();
                        $la_full_page.trigger('la_event_fp:afterRender');
                    },
                    afterResize: function(){
                        la_studio.helps.fullscreenFooterCalcs();
                        //$('.fp-parallax').fpParallaxImage('resize');
                        $la_full_page.trigger('la_event_fp:afterResize');
                    },
                    afterResponsive: function(isResponsive){

                        $la_full_page.trigger('la_event_fp:afterResponsive', [isResponsive]);
                    },
                    afterSlideLoad: function(anchorLink, index, slideAnchor, slideIndex){
                        var $that = $(this);
                        if($window.width() > fp_config.responsiveWidth) {
                            $that.find('.wpb_animate_when_almost_visible:not(.wpb_start_animation)').addClass('wpb_start_animation');
                        }

                        $la_full_page.trigger('la_event_fp:afterSlideLoad', [anchorLink, index, slideAnchor, slideIndex]);
                    },
                    onSlideLeave: function(anchorLink, index, slideIndex, direction, nextSlideIndex){
                        var $that = $(this);
                        if($window.width() > fp_config.responsiveWidth) {
                            $that.find('.wpb_animate_when_almost_visible.wpb_start_animation').removeClass('wpb_start_animation').addClass('la_reinit_animation');
                        }

                        $la_full_page.trigger('la_event_fp:onSlideLeave', [anchorLink, index, slideIndex, direction, nextSlideIndex]);
                    }
                }, precise_configs.fullpage );

                if($('.vc_section.la_fp_fixed_top').length == 0){
                    fp_config.fixedElements = fp_config.fixedElements.replace('.la_fp_fixed_top', '');
                }
                if($('.vc_section.la_fp_fixed_bottom').length == 0 ){
                    fp_config.fixedElements = fp_config.fixedElements.replace('.la_fp_fixed_bottom', '');
                }

                fp_config.fixedElements = fp_config.fixedElements.replace(/^,+/, '');

                $la_full_page.fullpage(fp_config);

                $window.resize(function(){
                    try {
                        $.fn.fullpage.reBuild();
                    }catch (ex){
                        la_studio.helps.log(ex);
                    }
                });

            }
        },
        team_member: function(){

        },
        hotspots: function(){
            //add pulse animation
            $('.la-image-with-hotspots[data-hotspot-icon="numerical"]').each(function(){
                $(this).find('.la_hotspot_wrap').each(function(i){
                    var $that = $(this);
                    setTimeout(function(){
                        $that.find('.la_hotspot').addClass('pulse');
                    },i*300);
                });
            });

            function hotSpotHoverBind() {

                var hotSpotHoverTimeout = [];

                $('.la-image-with-hotspots:not([data-tooltip-func="click"]) .la_hotspot').each(function(i){

                    hotSpotHoverTimeout[i] = '';

                    $(this).on('mouseover', function(){
                        clearTimeout(hotSpotHoverTimeout[i]);
                        $(this).parent().css({'z-index':'400', 'height':'auto','width':'auto'});
                    });

                    $(this).on('mouseleave', function(){
                        var $that = $(this);
                        $that.parent().css({'z-index':'auto'});
                        hotSpotHoverTimeout[i] = setTimeout(function(){
                            $that.parent().css({'height':'30px','width':'30px'});
                        },300);

                    });

                });

            }

            hotSpotHoverBind();

            $('.la-image-with-hotspots').each(function(){
                $(this).find('.la_hotspot_wrap').each(function(i){
                    if($(window).width() > 768) {
                        //remove click if applicable
                        if($(this).closest('.la-image-with-hotspots[data-tooltip-func="hover"]').length > 0) {
                            $(this).find('.la_hotspot').removeClass('click');
                            $(this).find('.nttip').removeClass('open');
                        }
                        $(this).find('.nttip .inner a.tipclose').remove();
                        $('.nttip').css('height','auto');

                        //reset for positioning
                        $(this).css({'width': 'auto','height': 'auto'});
                        $(this).find('.nttip').removeClass('force-right').removeClass('force-left').removeClass('force-top').css('width','auto');

                        var $tipOffset = $(this).find('.nttip').offset();

                        //against right side fix
                        if($tipOffset.left > $(this).parents('.la-image-with-hotspots').width() - 200)
                            $(this).find('.nttip').css('width','250px');
                        else
                            $(this).find('.nttip').css('width','auto');

                        //responsive
                        if($tipOffset.left < 0)
                            $(this).find('.nttip').addClass('force-right');
                        else if($tipOffset.left + $(this).find('.nttip').outerWidth(true) > $(window).width())
                            $(this).find('.nttip').addClass('force-left').css('width','250px');
                        else if($tipOffset.top + $(this).find('.nttip').height() + 35 > $(window).height() && $('#nectar_fullscreen_rows').length > 0)
                            $(this).find('.nttip').addClass('force-top');

                        if($(this).find('> .open').length == 0)
                            $(this).css({'width': '30px','height': '30px'});

                    } else {
                        //fixed position
                        $(this).find('.nttip').removeClass('force-left').removeClass('force-right').removeClass('force-top');
                        $(this).find('.la_hotspot').addClass('click');

                        if($(this).find('.nttip a.tipclose').length == 0)
                            $(this).find('.nttip .inner').append('<a href="#" class="tipclose"><span></span></a>');

                        //change height of fixed
                        $('.nttip').css('height',$(window).height());
                    }
                });
            });

            $document
                .on('click','.la_hotspot.click',function(){
                    $(this).parents('.la-image-with-hotspots').find('.nttip').removeClass('open');
                    $(this).parent().find('.nttip').addClass('open');

                    $(this).parents('.la-image-with-hotspots').find('.la_hotspot').removeClass('open');
                    $(this).parent().find('.la_hotspot').addClass('open');

                    if($(window).width() > 768) {
                        $(this).parent().css({'z-index':'10', 'height':'auto','width':'auto'});

                        var $that = $(this);

                        setTimeout(function(){
                            $that.parents('.la-image-with-hotspots').find('.la_hotspot_wrap').each(function(){
                                if($(this).find('> .open').length == 0)
                                    $(this).css({'height':'30px','width':'30px', 'z-index':'auto'});
                            });
                        },300);
                    }

                    if($(window).width() <= 768) $(this).parents('.wpb_row, [class*="vc_col-"]').css('z-index','200');

                    return false;
                })
                .on('click','.la_hotspot.open',function(){
                    $(this).parent().find('.nttip').removeClass('open');
                    $(this).parent().find('.la_hotspot').removeClass('open');

                    $(this).parents('.wpb_row').css('z-index','auto');

                    return false;
                })

                .on('click','.nttip.open',function(){
                    $(this).parents('.la-image-with-hotspots').find('.nttip').removeClass('open');
                    $(this).parents('.wpb_row').css('z-index','auto');
                    return false;
                });
        }
    }

    la_studio.theme = {
        ajax_loader : function(){
            $('.elm-ajax-loader').appear();
            $document
                .on('la_event_ajax_load', '.elm-ajax-loader', function(e){
                    if($(this).hasClass('is-loading') || $(this).hasClass('has-loaded')){
                        return;
                    }
                    var $this = $(this),
                        query = $this.data('query-settings'),
                        request_url = $this.data('request'),
                        nonce = $this.data('public-nonce'),
                        requestData = {
                            action : 'get_shortcode_loader_by_ajax',
                            tag : query.tag,
                            data : query,
                            _vcnonce : nonce
                        };

                    $this.addClass('is-loading');

                    $.ajax({
                        url : request_url,
                        method: "POST",
                        dataType: "html",
                        data : requestData
                    }).done(function(data){
                        var $data = $(data);
                        $document.trigger('la_event_ajax_load:before_render',[$this,$data]);
                        $this.removeClass('is-loading');
                        $this.addClass('has-loaded');
                        $data.addClass('fadeIn animated');
                        $data.appendTo($this);
                        $document.trigger('la_event_ajax_load:after_render',[$this,$data]);
                    });
                })
                .on('la_event_ajax_load:after_render',function( e, $wrap, $data ){
                    var $slider = $wrap.find('.la-slick-slider'),
                        $isotope = $wrap.find('.la-isotope-container'),
                        $isotope_filter = $wrap.find('.la-isotope-filter-container'),
                        $count_up = $wrap.find('.elm-countdown-dateandtime');
                    if($slider.length){
                        $slider.trigger('la_event_init_carousel')
                    }
                    if($isotope.length){
                        $isotope.trigger('la_event_init_isotope');
                    }
                    if($isotope_filter.length){
                        $isotope_filter.trigger('la_event_init_isotope_filter')
                    }
                    if($count_up.length){
                        $count_up.trigger('la_event_countdown');
                    }
                    la_studio.shortcodes.fix_parallax_row();
                    $window.trigger('resize');
                })
                .on('appear', '.elm-ajax-loader', function( e ){
                    $(this).trigger('la_event_ajax_load');
                })
                .on('click', '.elm-loadmore-ajax a', function(e){
                    e.preventDefault();
                    var $this = $(this).closest('.elm-loadmore-ajax');
                    if($this.hasClass('is-loading')){
                        return;
                    }
                    var $container = $($this.data('container')),
                        elem = $this.data('item-class'),
                        query = $this.data('query-settings'),
                        request_url = $this.data('request'),
                        nonce = $this.data('public-nonce'),
                        paged = parseInt($this.data('paged')),
                        max_page = parseInt($this.data('max-page')),
                        requestData;
                    if(paged < max_page){
                        query.atts.paged = paged + 1;
                        requestData = {
                            action : 'get_shortcode_loader_by_ajax',
                            tag : query.tag,
                            data : query,
                            _vcnonce : nonce
                        };
                        $this.addClass('is-loading');
                        $.ajax({
                            url : request_url,
                            method: "POST",
                            dataType: "html",
                            data : requestData
                        }).done(function(data){
                            var $data = $(data).find(elem);
                            $data.imagesLoaded(function() {
                                if($container.data('slider_config')){
                                    $container.slick('slickAdd', $data);
                                    $container.slick('setPosition');
                                }else if( $container.data('isotope') ){
                                    $container.isotope('insert', $data.addClass('showmenow') );
                                    $container.trigger('la_event_isotope_load_more');
                                }else{
                                    $data.appendTo($container);
                                }
                                if($data.find('.la-slick-slider').length){
                                    setTimeout(function(){
                                        $data.find('.la-slick-slider').trigger('la_event_init_carousel');
                                    }, 250);
                                }

                                var $count_up = $data.find('.elm-countdown-dateandtime');
                                if($count_up.length){
                                    setTimeout(function(){
                                        $count_up.trigger('la_event_countdown');
                                    }, 350);
                                }

                                $this.data('paged', paged + 1);
                                $this.removeClass('is-loading');
                                if( max_page === paged + 1 ){
                                    $this.addClass('hide');
                                }
                            });
                        });
                    }
                })
                .on('click', '.elm-pagination-ajax a', function(e){
                    e.preventDefault();
                    if($(this).closest('.elm-pagination-ajax').hasClass('is-loading')){
                        return;
                    }
                    var $this = $(this),
                        $parent = $this.closest('.elm-pagination-ajax'),
                        $container = $($parent.data('container')),
                        elem = $parent.data('item-class'),
                        query = $parent.data('query-settings'),
                        request_url = $parent.data('request'),
                        nonce = $parent.data('public-nonce'),
                        paged = parseInt(getParameterByName('la_paged', $this.attr('href'))),
                        appendType = $parent.data('append-type'),
                        requestData;
                    if(paged > 0){
                        query.atts.paged = paged;
                        requestData = {
                            action : 'get_shortcode_loader_by_ajax',
                            tag : query.tag,
                            data : query,
                            _vcnonce : nonce
                        };
                        $parent.addClass('is-loading');
                        $.ajax({
                            url : request_url,
                            method: "POST",
                            dataType: "html",
                            data : requestData
                        }).done(function(data){
                            var $data = $(data).find(elem);
                            $data.imagesLoaded(function() {
                                if( $container.data('isotope') ){
                                    $container.isotope('remove', $container.isotope('getItemElements'));
                                    $container.isotope('insert', $data);
                                    setTimeout(function(){
                                        $container.isotope('layout');
                                    },200)
                                }else{
                                    $data.addClass('fadeIn animated');
                                    $data.appendTo($container.empty());
                                }
                                if($data.find('.la-slick-slider').length){
                                    setTimeout(function(){
                                        $data.find('.la-slick-slider').trigger('la_event_init_carousel');
                                    }, 250);
                                }
                                var $count_up = $data.find('.elm-countdown-dateandtime');
                                if($count_up.length){
                                    setTimeout(function(){
                                        $count_up.trigger('la_event_countdown');
                                    }, 350);
                                }
                                $parent.removeClass('is-loading');
                            });
                            $parent.find('.la-pagination').html($(data).find('.la-pagination').html());
                        });
                    }
                });
        },
        mega_menu : function(){

            function fix_megamenu_position( $elem, containerClass, container_width, isVerticalMenu) {
                if($('.megamenu-inited', $elem).length){
                    return false;
                }

                var $popup = $('> .popup', $elem);

                if ($popup.length == 0) return;
                var megamenu_width = $popup.outerWidth();

                if (megamenu_width > container_width) {
                    megamenu_width = container_width;
                }
                if (!isVerticalMenu) {

                    if(containerClass == 'body.precise-body'){
                        $popup.css('left', 0 - $elem.offset().left).css('left');
                        return;
                    }

                    var $container = $(containerClass),
                        container_padding_left = parseInt($container.css('padding-left')),
                        container_padding_right = parseInt($container.css('padding-right')),
                        parent_width = $popup.parent().outerWidth(),
                        left = 0,
                        container_offset = la_studio.helps.getOffset($container),
                        megamenu_offset = la_studio.helps.getOffset($popup);

                    if (megamenu_width > parent_width) {
                        left = -(megamenu_width - parent_width) / 2;
                    }else{
                        left = 0
                    }

                    if ((megamenu_offset.x - container_offset.x - container_padding_left + left) < 0) {
                        left = -(megamenu_offset.x - container_offset.x - container_padding_left);
                    }
                    if ((megamenu_offset.x + megamenu_width + left) > (container_offset.x + $container.outerWidth() - container_padding_right)) {
                        left -= (megamenu_offset.x + megamenu_width + left) - (container_offset.x + $container.outerWidth() - container_padding_right);
                    }
                    $popup.css('left', left).css('left');
                }

                if (isVerticalMenu) {
                    var clientHeight = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight,
                        itemOffset = $popup.offset(),
                        itemHeight = $popup.outerHeight(),
                        scrollTop = $window.scrollTop();
                    if (itemOffset.top - scrollTop + itemHeight > clientHeight) {
                        $popup.css({top: clientHeight - itemOffset.top + scrollTop - itemHeight - 20});
                    }
                }

                $popup.addClass('megamenu-inited');
            }

            var $megamenu = $('.mega-menu'),
                $mobile_nav = $('#la_mobile_nav');

            $document.on('click', '.toggle-category-menu', function(){
                $(this).next().slideToggle();
            });
            $document.on('la_reset_megamenu', '.mega-menu', function(){
                var _that = $(this),
                    containerClass = _that.parent().attr('data-container'),
                    parentContainerClass = _that.parent().attr('data-parent-container'),
                    isVerticalMenu = _that.hasClass('isVerticalMenu'),
                    container_width = $(containerClass).width();

                if(isVerticalMenu){
                    container_width = ( parentContainerClass ? $(parentContainerClass).width() : $window.width() )  -  $(containerClass).outerWidth();
                }

                $('li.mm-popup-wide > .popup', _that).removeAttr('style');

                $('li.mm-popup-wide .megamenu-inited', _that).removeClass('megamenu-inited');

                $('li.mm-popup-wide', _that).each(function(){
                    var $menu_item = $(this),
                        $popup = $('> .popup', $menu_item),
                        $inner_popup = $('> .popup > .inner', $menu_item),
                        item_max_width = parseInt(!!$inner_popup.data('maxWidth') ? $inner_popup.data('maxWidth') : $inner_popup.css('maxWidth')),
                        default_width = 1170,
                        _containerClass = containerClass;

                    if(container_width < default_width){
                        default_width = container_width;
                    }
                    if(default_width > item_max_width){
                        default_width = item_max_width;
                    }

                    var new_megamenu_width = default_width - parseInt($inner_popup.css('padding-left')) - parseInt($inner_popup.css('padding-right')),
                        _tmp = $menu_item.attr('class').match(/mm-popup-column-(\d)/),
                        columns = _tmp && _tmp[1] || 4;

                    if( $menu_item.hasClass('mm-popup-force-fullwidth') ) {
                        if(isNaN(item_max_width)){
                            if(isVerticalMenu){
                                var _tmp_ww = $('#page.site > .site-inner').width();
                                if(_that.closest('#header_aside').length){
                                    _tmp_ww = _tmp_ww - _that.closest('#header_aside').width();
                                }
                                new_megamenu_width = _tmp_ww - parseInt($inner_popup.css('padding-left')) - parseInt($inner_popup.css('padding-right'));
                            }
                            else{
                                new_megamenu_width = $window.width() - parseInt($inner_popup.css('padding-left')) - parseInt($inner_popup.css('padding-right'));
                            }
                        }
                    }

                    $('> ul > li', $inner_popup).each(function(){
                        var _col = parseFloat($(this).data('column')) || 1;
                        if(_col < 0) _col = 1;
                        var column_width = parseFloat( (new_megamenu_width / columns) * _col);
                        $(this).data('old-width', $(this).width()).css('width', column_width);
                    });

                    if( $menu_item.hasClass('mm-popup-force-fullwidth')){
                        $inner_popup.data('maxWidth', item_max_width).css('maxWidth', 'none');
                        $('> ul', $inner_popup).css('width', item_max_width);
                        if(!isVerticalMenu){
                            default_width = $window.width();
                            _containerClass = 'body.precise-body';
                        }else{
                            var _tmp_ww = $('#page.site > .site-inner').width();
                            if(_that.closest('#header_aside').length){
                                _tmp_ww = _tmp_ww - _that.closest('#header_aside').width();
                            }
                            default_width = _tmp_ww;
                        }
                    }

                    $popup.width(default_width);

                    fix_megamenu_position( $menu_item, _containerClass, container_width, isVerticalMenu);

                });

            });

            $megamenu.trigger('la_reset_megamenu');

            $window.on('resize', function(){
                $megamenu.trigger('la_reset_megamenu');
            });

            var $primary_menu = $('.main-menu').clone();

            $primary_menu.find('.mm-menu-block').remove();
            $primary_menu.find('.sub-menu').addClass('dl-submenu').removeAttr('style');
            $primary_menu.find('.mm-item-level-0').each(function(){
                var _that = $(this);
                if($('>.popup', _that).length){
                    var $submenu = _that.find('> .popup > .inner > .sub-menu').clone();
                    _that.find('> .popup').remove();
                    $submenu.find('li').removeAttr('style data-column');
                    $submenu.appendTo(_that);
                }
            });
            $primary_menu.removeAttr('id class').attr('class', 'dl-menu dl-menuopen').appendTo($mobile_nav);
            $mobile_nav.dlmenu({
                backtext: precise_configs.text.backtext,
                animationClasses : la_studio.helps.getMobileMenuEffect()
            });


            var $header6_menu = $('.header6-nav .main-menu');
            $('.sub-menu', $header6_menu).addClass('dl-submenu');
            $header6_menu.removeAttr('id class').attr('class', 'dl-menu dl-menuopen');
            $('.header6-nav').dlmenu({
                animationClasses : la_studio.helps.getMobileMenuEffect()
            });

            function fix_com_submenu_position( $elem, containerClass, container_width) {
                if($('.submenu-inited', $elem).length){
                    return false;
                }

                var $popup = $('> .menu', $elem);

                if ($popup.length == 0) return;
                var megamenu_width = $popup.outerWidth();

                if (megamenu_width > container_width) {
                    megamenu_width = container_width;
                }
                var $container = $(containerClass),
                    container_padding_left = parseInt($container.css('padding-left')),
                    container_padding_right = parseInt($container.css('padding-right')),
                    parent_width = $popup.parent().outerWidth(),
                    left = 0,
                    container_offset = la_studio.helps.getOffset($container),
                    megamenu_offset = la_studio.helps.getOffset($popup);

                if(la_studio.helps.is_rtl){
                    container_offset.x = $window.width() - (container_offset.x + $container.innerWidth()) ;
                    megamenu_offset.x = $window.width() - (megamenu_offset.x + $popup.innerWidth()) ;
                }


                if (megamenu_width > parent_width) {
                    left = -(megamenu_width - parent_width) / 2;
                }else{
                    left = 0
                }

                if ((megamenu_offset.x - container_offset.x - container_padding_left + left) < 0) {
                    left = -(megamenu_offset.x - container_offset.x - container_padding_left);
                }
                if ((megamenu_offset.x + megamenu_width + left) > (container_offset.x + $container.outerWidth() - container_padding_right)) {
                    left -= (megamenu_offset.x + megamenu_width + left) - (container_offset.x + $container.outerWidth() - container_padding_right);
                }
                if(la_studio.helps.is_rtl){
                    $popup.css('right', left).css('right');
                }else{
                    $popup.css('left', left).css('left');
                }
                $popup.addClass('submenu-inited');
            }

            $document.on('la_reset_com_submenu', '.la_com_action--dropdownmenu', function(e, containerClass, container_width){
                var _that = $(this);
                $('>.menu', _that).removeAttr('style');
                $('>.menu.submenu-inited', _that).removeClass('submenu-inited');
                fix_com_submenu_position(_that, containerClass , container_width);
            });
            $('.site-header-mobile .la_com_action--dropdownmenu').trigger('la_reset_com_submenu', '.site-header-mobile', $('.site-header-mobile').width());
            $('.header-top-elements .la_com_action--dropdownmenu').trigger('la_reset_com_submenu', '.header-top-elements', $('.header-top-elements').width());
            $window.on('resize', function(){
                $('.site-header-mobile .la_com_action--dropdownmenu').trigger('la_reset_com_submenu', '.site-header-mobile', $('.site-header-mobile').width());
                $('.header-top-elements .la_com_action--dropdownmenu').trigger('la_reset_com_submenu', '.header-top-elements', $('.header-top-elements').width());
            });

        },
        accordion_menu : function(){
            var $sidebar_inner =  $('.sidebar-inner');
            $('.widget_pages > ul, .widget_archive > ul, .widget_categories > ul, .widget_product_categories > ul', $sidebar_inner).addClass('menu').closest('.widget').addClass('accordion-menu');
            $('.widget_nav_menu', $sidebar_inner).closest('.widget').addClass('accordion-menu');
            $('.widget_categories > ul li.cat-parent,.widget_product_categories li.cat-parent', $sidebar_inner).addClass('mm-item-has-sub');

            $('.menu li > ul').each(function(){
                var $ul = $(this);
                $ul.before('<span class="narrow"><i></i></span>');
            });

            $document.on('click','.accordion-menu li.menu-item-has-children > a,.menu li.mm-item-has-sub > a,.menu li > .narrow',function(e){
                e.preventDefault();
                var $parent = $(this).parent();
                if ($parent.hasClass('open')) {
                    $parent.removeClass('open');
                    $parent.find('>ul').stop().slideUp();
                } else {
                    $parent.addClass('open');
                    $parent.find('>ul').stop().slideDown();
                    $parent.siblings().removeClass('open').find('>ul').stop().slideUp();
                }
            });
        },

        headerSidebar: function(){
            $masthead_aside_inner.stick_in_parent({
                offset_top: la_studio.helps.getAdminbarHeight()
            });
            $window.on('resize', function(){
                if($masthead_aside_inner.length){
                    setTimeout(function(){
                        $body.trigger("sticky_kit:recalc");
                    },300);
                }
            })
        },
        header_sticky : function(){

            if(!$body.hasClass('enable-header-sticky')) return;

            if($masthead.length == 0) return;

            var lastScrollTop = 0,
                lastScrollTopMb = 0,
                $header_sticky_fallback = $('.la-header-sticky-height'),
                $header_mb_sticky_fallback = $('.la-header-sticky-height-mb');

            $window.on('resize', function(e){
                delete window['latest_height_mb'];
                delete window['latest_height'];
            });

            $window.on('load scroll', function(e){
                if($body.hasClass('la-enable-fullpage')){
                    return;
                }
                var scrollTop = $window.scrollTop(),
                    header_offset = la_studio.helps.getOffset($masthead),
                    header_offset_y = header_offset.y;

                if(typeof window['latest_height'] === 'undefined'){
                    $header_sticky_fallback.height($masthead.height()).hide();
                    window['latest_height'] = $masthead.height();
                }

                if($window.width() > 800 && scrollTop > header_offset_y + window['latest_height']){
                    if(!$masthead.hasClass('is-sticky')){
                        window['latest_height'] = $masthead.height();
                        $header_sticky_fallback.height($masthead.height()).show();
                        $masthead.addClass('is-sticky');
                        $masthead_inner.css('top',la_studio.helps.getAdminbarHeight());
                    }
                    if(scrollTop < $('#page.site').height() && scrollTop < lastScrollTop){
                        $masthead_inner.removeClass('sticky--unpinned').addClass('sticky--pinned');
                    }else{
                        $masthead_inner.removeClass('sticky--pinned').addClass('sticky--unpinned');
                    }
                }else{
                    if($masthead.hasClass('is-sticky')){
                        $masthead.removeClass('is-sticky');
                        $masthead_inner.css('top','0').removeClass('sticky--pinned sticky--unpinned');
                        //window['latest_height'] = $masthead.height('auto').height();
                        $header_sticky_fallback.hide().height($masthead.height());
                        window['latest_height'] = $masthead.height();
                    }
                }
                lastScrollTop = scrollTop;
            });

            $window.on('load scroll', function(e){
                if($body.hasClass('la-enable-fullpage')){
                    return;
                }
                var scrollTop = $window.scrollTop(),
                    header_offset = la_studio.helps.getOffset($masthead_mb),
                    header_offset_y = header_offset.y;

                if(typeof window['latest_height_mb'] === 'undefined'){
                    $header_mb_sticky_fallback.height($masthead_mb.height()).hide();
                    window['latest_height_mb'] = $masthead_mb.height();
                }


                if(scrollTop > header_offset_y + window['latest_height_mb']){
                    if(!$masthead_mb.hasClass('is-sticky')){
                        window['latest_height_mb'] = $masthead_mb.height();
                        $header_mb_sticky_fallback.height($masthead_mb.height()).show();
                        $masthead_mb.addClass('is-sticky');
                        $masthead_mb_inner.css('top',la_studio.helps.getAdminbarHeight());
                    }
                    if(scrollTop < $('#page.site').height() && scrollTop < lastScrollTopMb){
                        $masthead_mb_inner.removeClass('sticky--unpinned').addClass('sticky--pinned');
                    }else{
                        $masthead_mb_inner.removeClass('sticky--pinned').addClass('sticky--unpinned');
                    }
                }else{
                    if($masthead_mb.hasClass('is-sticky')){
                        $masthead_mb.removeClass('is-sticky');
                        $masthead_mb_inner.css('top','0').removeClass('sticky--pinned sticky--unpinned');
                        $header_mb_sticky_fallback.hide().height($masthead_mb.height());
                        window['latest_height_mb'] = $masthead_mb.height();
                    }
                }
                lastScrollTopMb = scrollTop;
            });
        },
        auto_popup : function(){
            $('.la-popup:not(.wpb_single_image), .banner-video .banner--link-overlay, .la-popup.wpb_single_image a,.la-popup-slideshow').lightcase({
                showTitle: false,
                showCaption: false,
                maxWidth: $window.width(),
                maxHeight: $window.height(),
                iframe:{
                    width:1280,
                    height:720
                }
            });
        },
        auto_carousel : function(){

            $('.la-carousel-wrapper')
                .on('init', function (e) {
                    e.preventDefault();
                    $('.la-carousel-wrapper .la-item-wrap.slick-active').each(function (idx, el) {
                        $(this).addClass($(this).data('animation'));
                    });
                })
                .on('beforeChange', function (event, slick, currentSlide) {
                    var $inViewPort = $("[data-slick-index='" + currentSlide + "']");
                    $inViewPort.siblings().removeClass($inViewPort.data('animation'));
                })
                .on('afterChange', function (event, slick, currentSlide, nextSlide) {
                    var slidesScrolled = slick.options.slidesToScroll,
                        slidesToShow = slick.options.slidesToShow,
                        centerMode = slick.options.centerMode,
                        windowWidth = $window.width();

                    if ( windowWidth < 1824 ) {
                        slidesToShow = slick.options.responsive[0].settings.slidesToShow;
                    }
                    if ( windowWidth < 1200 ) {
                        slidesToShow = slick.options.responsive[1].settings.slidesToShow;
                    }
                    if ( windowWidth < 992 ) {
                        slidesToShow = slick.options.responsive[2].settings.slidesToShow;
                    }
                    if ( windowWidth < 768 ) {
                        slidesToShow = slick.options.responsive[3].settings.slidesToShow;
                    }
                    if ( windowWidth < 480 ) {
                        slidesToShow = slick.options.responsive[4].settings.slidesToShow;
                    }

                    var $currentParent = slick.$slider[0].parentElement.id,
                        slideToAnimate = currentSlide + slidesToShow - 1;

                    var $inViewPort;

                    if (slidesScrolled == 1) {
                        if ( centerMode == true ) {
                            var animate = slideToAnimate - 2;
                            $inViewPort = $( '#' + $currentParent + " [data-slick-index='" + animate + "']");
                            $inViewPort.addClass($inViewPort.data('animation'));
                        } else {
                            $inViewPort = $( '#' + $currentParent + " [data-slick-index='" + slideToAnimate + "']");
                            $inViewPort.addClass($inViewPort.data('animation'));
                        }
                    } else {
                        for (var i = slidesScrolled + currentSlide; i >= 0; i--) {
                            $inViewPort = $( '#' + $currentParent + " [data-slick-index='" + i + "']");
                            $inViewPort.addClass($inViewPort.data('animation'));
                        }
                    }
                });

            $document.on('la_event_init_carousel','.la-slick-slider, .la-carousel-for-products ul.products',function(e){
                var $this = $(this),
                    slider_config = $this.data('slider_config') || {};
                slider_config = $.extend({
                    prevArrow: '<button type="button" class="slick-prev"><span class="precise-icon-arrow-minimal-left"></span></button>',
                    nextArrow: '<button type="button" class="slick-next"><span class="precise-icon-arrow-minimal-right"></span></button>',
                    adaptiveHeight: true,
                    rtl: la_studio.helps.is_rtl
                }, slider_config);
                try{
                    if(slider_config.arrows == true && typeof slider_config.appendArrows === "undefined"){
                        if($this.closest('.woocommerce').length && $this.closest('.woocommerce').closest('.vc_row').length ){
                            slider_config.appendArrows = $('<div class="la-slick-nav"></div>').prependTo($this.parent());
                        }
                    }
                }catch (ex){ }

                $this.slick(slider_config);
            });
            $('.la-slick-slider,.la-carousel-for-products ul.products').trigger('la_event_init_carousel');
        },
        init_isotope  : function(){

            var get_isotope_column_number = function (w_w, item_w) {
                w_w = ( w_w > 1920 ) ? 1920 : w_w;
                return Math.round(w_w / item_w);
            };

            var resize_portfolio_item_list = function ( $isotope_container ) {


                if($isotope_container.hasClass('grid-items')){
                    return;
                }
                else{
                    if(!$isotope_container.hasClass('pf-masonry') && !$isotope_container.hasClass('prods_masonry')){
                        return;
                    }
                }

                var ww = $window.width(),
                    _base_w = $isotope_container.data('item-width'),
                    _base_h = $isotope_container.data('item-height'),
                    wrapperwidth = $isotope_container.width();

                if($isotope_container.hasClass('prods_masonry')){
                    wrapperwidth = $isotope_container.width();
                }

                var portfolionumber = get_isotope_column_number(wrapperwidth, _base_w);


                if( ww < 1200){
                    portfolionumber = $isotope_container.data('md-col');
                    $isotope_container.removeClass('cover-img-bg');
                }
                else{
                    $isotope_container.addClass('cover-img-bg');
                }
                if( ww < 800){
                    portfolionumber = $isotope_container.data('sm-col');
                }
                if( ww < 768){
                    portfolionumber = $isotope_container.data('xs-col');
                }
                if( ww < 500){
                    portfolionumber = $isotope_container.data('mb-col');
                }

                var itemwidth = Math.floor(wrapperwidth / portfolionumber),
                    selector = $isotope_container.data('item_selector'),
                    margin = parseInt($isotope_container.data('item_margin') || 0),
                    dimension = parseFloat( _base_w / _base_h );

                $( selector, $isotope_container ).each(function (idx) {

                    var thiswidth = parseFloat( $(this).data('width') || 1 ),
                        thisheight = parseFloat( $(this).data('height') || 1),
                        _css = {};

                    if (isNaN(thiswidth)) thiswidth = 1;
                    if (isNaN(thisheight)) thisheight = 1;

                    if( ww < 1200){
                        thiswidth = thisheight = 1;
                    }

                    _css.width = Math.floor((itemwidth * thiswidth) - (margin / 2));
                    _css.height = Math.floor((itemwidth / dimension) * thisheight);

                    if( ww < 1200){
                        _css.height = 'auto';
                    }

                    $(this).css(_css);

                });
            };

            var initialize_isotope_image_loaded = function( $isotope_container ){
                var item_selector   = $isotope_container.data('item_selector'),
                    callback        = ( $isotope_container.data('callback') || false ),
                    configs         = ( $isotope_container.data('config_isotope') || {} );

                var columnWidth = $isotope_container.attr('data-item-width');
                if ($().isotope) {

                    configs = $.extend({
                        percentPosition: true,
                        itemSelector : item_selector,
                        masonry : {
                            gutter: 0
                        }
                    },configs);

                    if(columnWidth && columnWidth != '' && !$isotope_container.hasClass('masonry__column-type-default')){
                        configs.masonry.columnWidth = 1
                    }

                    $isotope_container.isotope(configs);

                    $('.la-isotope-loading', $isotope_container).hide();
                    $isotope_container.addClass('loaded');
                    la_studio.helps.animate_load('normal', $isotope_container, $(item_selector, $isotope_container), function () {
                        $(item_selector, $isotope_container).addClass('showmenow');
                        $isotope_container.isotope('layout');
                    });
                }
            };

            $document
                .on( 'la_event_init_isotope', '.la-isotope-container', function(e){
                    var $this = $(this);
                    $('.la-isotope-loading', $this).show();
                    resize_portfolio_item_list($this);
                    $window.on('resize', function(e){
                        resize_portfolio_item_list($this);
                    });
                    $this.imagesLoaded()
                        .done(initialize_isotope_image_loaded($this))
                        .fail(initialize_isotope_image_loaded($this));
                })
                .on( 'la_event_isotope_load_more', '.la-isotope-container', function( e, elem ){
                    var $isotope_container = $(this);
                    resize_portfolio_item_list($isotope_container);
                    $isotope_container.isotope('layout');
                })
                .on( 'la_event_init_isotope_filter', '.la-isotope-filter-container', function(e){
                    var $this = $(this),
                        options = ($this.data('isotope_option') || {}),
                        $isotope = $($this.data('isotope_container'));

                    $this.find('li').on('click', function c(e) {
                        e.preventDefault();
                        var selector = $(this).attr('data-filter');
                        $this.find('.active').removeClass('active');

                        if (selector != '*')
                            selector = '.' + selector;
                        if ($isotope){
                            $isotope.isotope(
                                $.extend(options,{
                                    filter: selector
                                })
                            );
                        }
                        $(this).addClass('active');
                        $this.find('.la-toggle-filter').removeClass('active').text($(this).text());
                    })
                })
                .on('click', '.la-toggle-filter', function(e){
                    e.preventDefault();
                    $(this).toggleClass('active');
                });

            $('.la-isotope-container').trigger('la_event_init_isotope');
            $('.la-isotope-filter-container').trigger('la_event_init_isotope_filter');

        },
        init_infinite : function(){

            $document.on('la_event_init_infinite', '.la-infinite-container', function(){
                var $this           = $(this),
                    itemSelector    = $this.data('item_selector'),
                    curr_page       = $this.data('page_num'),
                    page_path       = $this.data('path'),
                    max_page        = $this.data('page_num_max');

                var default_options =  {
                    navSelector  : ".la-pagination",
                    nextSelector : ".la-pagination a.next",
                    loading      : {
                        finished: function(){
                            $('.la-infinite-loading', $this).remove();
                        },
                        msg: $("<div class='la-infinite-loading'><div class='la-loader spinner3'><div class='dot1'></div><div class='dot2'></div><div class='bounce1'></div><div class='bounce2'></div><div class='bounce3'></div></div></div>")
                    }
                };
                $this.parent().append('<div class="la-infinite-container-flag"></div>');
                default_options = $.extend( default_options, {
                    itemSelector : itemSelector,
                    state : {
                        currPage: curr_page
                    },
                    pathParse : function(a, b) {
                        return [page_path, '/'];
                    },
                    maxPage : max_page
                });
                $this.infinitescroll(
                    default_options,
                    function(data) {

                        var $data = $(data);
                        $('.la-slick-slider,.la-carousel-for-products ul.products', $data).trigger('la_event_init_carousel');
                        if( $this.data('isotope') ){
                            $this.append( $data )
                                .isotope( 'appended', $data )
                                .isotope('layout');
                            setTimeout(function(){
                                $this.isotope('layout');
                            }, 100);
                        }else{
                            $data.each(function(idx){
                                if(idx == 0){
                                    idx = 1;
                                }
                                $(this).css({
                                    'animation-delay': (idx * 100) + 'ms',
                                    '-webkit-animation-delay': (idx * 100) + 'ms'
                                });
                            });
                            $data.addClass('fadeInUp animated');
                        }

                        $('.la-infinite-loading', $this).remove();

                        if($('.la-infinite-container-flag', $this.parent()).length){
                            var $offset = getOffset($('.la-infinite-container-flag', $this.parent())[0]);
                            if($offset.y < window.innerHeight){
                               $this.infinitescroll('retrieve');
                            }
                        }

                        var __instance = $this.data('infinitescroll');
                        try{
                            $('.blog-main-loop__btn-loadmore').removeClass('loading');
                            if(max_page == __instance.options.state.currPage ){
                                $('.blog-main-loop__btn-loadmore').addClass('nothing-to-load');
                            }
                        }catch (ex){

                        }

                    }
                );
                if( $this.hasClass('infinite-show-loadmore')){
                    $this.infinitescroll('pause');
                }
                if($('.la-infinite-container-flag', $this.parent()).length){
                    var $offset = getOffset($('.la-infinite-container-flag', $this.parent())[0]);
                    if($offset.y < window.innerHeight){
                       $this.infinitescroll('retrieve');
                    }
                }
            });

            $(document).on('click', '.blog-main-loop__btn-loadmore', function(e){
                e.preventDefault();
                var $btn = $(this);
                $btn.addClass('loading');
                $('.blog-main-loop.infinite-show-loadmore').infinitescroll('retrieve');
            });

            $('.la-infinite-container').trigger('la_event_init_infinite');
        },
        scrollToTop : function(){
            $window.on('load scroll', function(){
                if($window.scrollTop() > $window.height() + 100){
                    $('.backtotop-container').addClass('show');
                }else{
                    $('.backtotop-container').removeClass('show');
                }
            })
            $document.on('click', '.btn-backtotop', function(e){
                e.preventDefault();
                $htmlbody.animate({
                    scrollTop: 0
                }, 800)
            })
        },
        css_animation : function(){
            $('.la-animation').each(function(){
                var delay = $(this).attr('data-animation-delay');
                if(delay){
                    $(this).css({
                        "-webkit-animation-delay": delay,
                        "animation-delay": delay
                    });
                }
            });
            if($.isFunction($.fn.waypoint) ){
                $('.la-animation:not(.wpb_start_animation)').waypoint(function(){
                    $(this).addClass($(this).data('animation-class'));
                }, {offset: "85%"} )
            }
        },
        extra_func : function(){
            $document
                .on('click', '.vc_message_box > .close-button', function(e){
                    e.preventDefault();
                    var _this = $(this),
                        _parent = _this.closest('.vc_message_box');
                    _parent.slideUp(300);
                })
                .on('click','.wc-view-toggle span',function(){
                    var _this = $(this),
                        _mode = _this.data('view_mode');
                    if(!_this.hasClass('active')){
                        $('.wc-view-toggle span').removeClass('active');
                        _this.addClass('active');
                        $('.page-content').find('ul.products').removeClass('products-grid').removeClass('products-list').addClass('products-'+_mode);
                        Cookies.set('precise_wc_catalog_view_mode', _mode, { expires: 30 });
                    }
                })
                .on('click','.quantity .desc-qty',function(e){
                    e.preventDefault();
                    var $qty = $(this).closest('.quantity').find('.qty'),
                        min_val = 0,
                        max_val = 0,
                        default_val = 1,
                        old_val = parseInt($qty.val());
                    if( $qty.attr('min') )  min_val = parseInt( $qty.attr('min') );
                    if( $qty.attr('max') )  max_val = parseInt( $qty.attr('max') );
                    if( min_val ) default_val = min_val;
                    if( max_val > 0 ) default_val = max_val;
                    if( max_val ){
                        $qty.val( (old_val && max_val > old_val) ? old_val + 1 : default_val);
                    }else{
                        $qty.val( (old_val) ? old_val + 1 : default_val);
                    }
                })
                .on('click','.quantity .inc-qty',function(e){
                    e.preventDefault();
                    var $qty = $(this).closest('.quantity').find('.qty'),
                        min_val = 0,
                        old_val = parseInt($qty.val());
                    if( $qty.attr('min') )  min_val = parseInt( $qty.attr('min') );
                    $qty.val((old_val > 0 && old_val > min_val) ? old_val - 1 : min_val);
                })
                .on('click', '.popup-button-continue', function(e){
                    e.preventDefault();
                    lightcase.close();
                })
                .on('click', '.btn-aside-toggle', function(e){
                    e.preventDefault();
                    if($(this).hasClass('btn-master-toggle')){
                        $body.toggleClass('open-master-aside');
                    }else{
                        $body.toggleClass('open-header-aside');
                    }

                })
                .on('click', '.la_com_action--searchbox.searchbox__01', function(e){
                    e.preventDefault();
                    $body.addClass('open-search-form');
                    setTimeout(function(){
                        $('.searchform-fly .search-field').focus();
                    }, 600);
                })
                .on('click', '.btn-close-search', function(e){
                    e.preventDefault();
                    $body.removeClass('open-search-form');
                })
                .on('click', '.la-overlay-global,.header-aside-overlay', function(e){
                    e.preventDefault();
                    $('.la_com_action--primary-menu').removeClass('active');
                    $body.removeClass('open-aside open-search-form open-cart-aside open-mobile-menu open-advanced-shop-filter open-header-aside open-master-aside');
                })
                .on('click', '.site-header-mobile .la_com_action--primary-menu', function(e){
                    e.preventDefault();
                    $(this).toggleClass('active');
                    $body.toggleClass('open-mobile-menu');
                })
                .on('click', '.site-main,.section-page-header', function(e){
                    $('.site-header-mobile .la_com_action--primary-menu').removeClass('active');
                    $body.removeClass('open-mobile-menu');
                })
                .on('click', '.btn-advanced-shop-filter', function(e){
                    e.preventDefault();
                    $body.toggleClass('open-advanced-shop-filter');
                    $('.la-advanced-product-filters').animate({
                        height: 'toggle'
                    });
                })

            if($window.width() > 992 && $window.width() < 1200 && $masthead_aside.find('.la-sticky-sidebar').length){
                $masthead_aside.find('.la-sticky-sidebar').css('position', 'static');
            }

            $('.wpcf7-form-control-wrap + i').each(function(){
                $(this).appendTo($(this).prev());
            });

            $('.append-css-to-head').each(function(){
                addStyleSheet( $(this).text() );
            });

            $body.data('header-transparency', ($body.hasClass('enable-header-transparency')));
        }
    }

    la_studio.woocommerce = {

        ProductGalleryList : function(){
            $document.on('click','.product_item .la-swatch-control .swatch-wrapper', function(e){
                e.preventDefault();
                var $swatch_control = $(this),
                    $image = $swatch_control.closest('.product_item').find('.product_item--thumbnail-holder img').first();
                if($swatch_control.closest('.product_item--thumbnail').length > 0){
                    $image = $swatch_control.closest('.product_item--thumbnail').find('.product_item--thumbnail-holder img').last();
                }
                if($swatch_control.hasClass('selected')) return;
                $swatch_control.addClass('selected').siblings().removeClass('selected');
                if(!$image.hasClass('_has_changed')){
                    $image.attr('data-o-src', $image.attr('src')).attr('data-o-sizes', $image.attr('sizes')).attr('data-o-srcset', $image.attr('srcset'));
                }
                $image.attr('src', $swatch_control.attr('data-thumb')).removeAttr('sizes srcset');
            })
        },
        ProductQuickView : function(){
            $document.on('click','.la-quickview-button',function(e){
                if($window.width() > 900){
                    e.preventDefault();
                    lightcase.start({
                        href: $(this).data('href'),
                        showSequenceInfo: false,
                        type: 'ajax',
                        maxWidth: 1300,
                        maxHeight: 650,
                        iframe:{
                            width: $window.width(),
                            height: $window.height()
                        },
                        ajax: {
                            width: $window.width(),
                            height: $window.height()
                        },
                        onFinish: {
                            renderContent: function () {
                                var $popup = lightcase.get('case');
                                try {
                                    $('.la-woo-product-gallery', $popup).la_product_gallery();
                                }catch (ex){}
                                setTimeout(function(){
                                    lightcase.resize();
                                },300);
                            }
                        }
                    })
                }
            });
        },
        ProductAddCart : function(){

            $document.on('click', '.la_com_action--cart', function(e){
                if($window.width() > 767){
                    e.preventDefault();
                    $body.toggleClass('open-cart-aside');
                }
            });

            $document.on('click', '.btn-close-cart', function(e){
                e.preventDefault();
                $body.removeClass('open-cart-aside');
            });

            $document.on( 'adding_to_cart', function( e ){
                $body.addClass('open-cart-aside');
                $('.cart-flyout').addClass('cart-flyout--loading');
                $('.la_com_action--cart > a > i').removeClass('precise-icon-cart-modern').addClass('fa-spinner fa-spin');
            });
            $document.on( 'added_to_cart', function( e, fragments, cart_hash, $button ){
                var $product_image = $button.closest('.product').find('.product_item--thumbnail img:eq(0)'),
                    target_attribute = $body.is('.woocommerce-yith-compare') ? ' target="_parent"' : '',
                    product_name = 'Product';

                if ( !!$button.data('product_title')){
                    product_name = $button.data('product_title');
                }
                var html = '<div class="popup-added-msg">';
                if ($product_image.length){
                    html += $('<div>').append($product_image.clone()).html();
                }
                html += '<div class="popup-message"><strong class="text-color-heading">'+ product_name +' </strong>' + precise_configs.addcart.success + '</div>';
                html += '<a rel="nofollow" class="btn btn-secondary view-popup-addcart" ' + target_attribute + ' href="' + wc_add_to_cart_params.cart_url + '">' + wc_add_to_cart_params.i18n_view_cart + '</a>';
                html += '<a class="btn popup-button-continue" rel="nofollow" href="#">'+ precise_configs.global.continue_shopping + '</a>';
                html += '</div>';
                $('.cart-flyout').removeClass('cart-flyout--loading');
                $('.la_com_action--cart > a > i').removeClass('fa-spinner fa-spin').addClass('precise-icon-cart-modern');
                //showMessageBox(html);
            } );
            $('.la-global-message').on('click','.popup-button-continue',function(e){
                e.preventDefault();
                $('.la-global-message .close-message').trigger('click');
            })
        },

        ProductAddCompare : function(){

            $document.on('click', 'table.compare-list .remove a', function(e){
                e.preventDefault();
                $('.add_compare[data-product_id="' + $(this).data('product_id') + '"]', window.parent.document).removeClass('added');
            });

            $document.on('click','.la_com_action--compare', function(e){
                e.preventDefault();
                try{
                    lightcase.close();
                }catch (ex){

                }
                var action_url = add_query_arg('', 'action', yith_woocompare.actionview);
                action_url = add_query_arg(action_url, 'iframe', 'true');
                $body.trigger('yith_woocompare_open_popup', { response: action_url });
            });
            $document.on( 'click', '.product a.add_compare', function(e){
                e.preventDefault();

                if($(this).hasClass('added')){
                    $body.trigger('yith_woocompare_open_popup', { response: add_query_arg( add_query_arg('', 'action', yith_woocompare.actionview) , 'iframe', 'true') });
                    return;
                }

                var $button     = $(this),
                    widget_list = $('.yith-woocompare-widget ul.products-list'),
                    $product_image = $button.closest('.product').find('.product_item--thumbnail img:eq(0)'),
                    data        = {
                        action: yith_woocompare.actionadd,
                        id: $button.data('product_id'),
                        context: 'frontend'
                    },
                    product_name = 'Product';
                if(!!$button.data('product_title')){
                    product_name = $button.data('product_title');
                }

                if($button.closest('.product--summary').length){
                    $product_image = $button.closest('.product').find('.woocommerce-product-gallery__image img:eq(0)');
                }

                $.ajax({
                    type: 'post',
                    url: yith_woocompare.ajaxurl.toString().replace( '%%endpoint%%', yith_woocompare.actionadd ),
                    data: data,
                    dataType: 'json',
                    beforeSend: function(){
                        $button.addClass('loading');
                    },
                    complete: function(){
                        $button.removeClass('loading').addClass('added');
                    },
                    success: function(response){
                        if($.isFunction($.fn.block) ) {
                            widget_list.unblock()
                        }
                        var html = '<div class="popup-added-msg">';
                        if ($product_image.length){
                            html += $('<div>').append($product_image.clone()).html();
                        }
                        html += '<div class="popup-message"><strong class="text-color-heading">'+ product_name +' </strong>' + precise_configs.compare.success + '</div>';
                        html += '<a class="btn btn-secondary la_com_action--compare" rel="nofollow" href="'+response.table_url+'">'+precise_configs.compare.view+'</a>';
                        html += '<a class="btn popup-button-continue" href="#" rel="nofollow">'+ precise_configs.global.continue_shopping + '</a>';
                        html += '</div>';

                        showMessageBox(html);

                        $('.add_compare[data-product_id="' + $button.data('product_id') + '"]').addClass('added');

                        widget_list.unblock().html( response.widget_table );
                    }
                });
            });
        },
        ProductAddWishlist : function(){

            function set_attribute_for_wl_table(){
                var $table = $('table.wishlist_table');
                $table.addClass('shop_table_responsive');
                $table.find('thead th').each(function(){
                    var _th = $(this),
                        _text = _th.text().trim();
                    if(_text != ""){
                        $('td.' + _th.attr('class'), $table).attr('data-title', _text);
                    }
                });
            }
            set_attribute_for_wl_table();
            $body.on('removed_from_wishlist', function(e){
                set_attribute_for_wl_table();
            });
            $document.on('added_to_cart', function(e, fragments, cart_hash, $button){
                setTimeout(set_attribute_for_wl_table, 800);
            });

            $document.on('click','.product a.add_wishlist',function(e){
                if(!$(this).hasClass('added')) {
                    e.preventDefault();
                    var $button     = $(this),
                        product_id = $button.data( 'product_id' ),
                        $product_image = $button.closest('.product').find('.product_item--thumbnail img:eq(0)'),
                        product_name = 'Product',
                        data = {
                            add_to_wishlist: product_id,
                            product_type: $button.data( 'product-type' ),
                            action: yith_wcwl_l10n.actions.add_to_wishlist_action
                        };
                    if (!!$button.data('product_title')) {
                        product_name = $button.data('product_title');
                    }
                    if($button.closest('.product--summary').length){
                        $product_image = $button.closest('.product').find('.woocommerce-product-gallery__image img:eq(0)');
                    }
                    try {
                        if (yith_wcwl_l10n.multi_wishlist && yith_wcwl_l10n.is_user_logged_in) {
                            var wishlist_popup_container = $button.parents('.yith-wcwl-popup-footer').prev('.yith-wcwl-popup-content'),
                                wishlist_popup_select = wishlist_popup_container.find('.wishlist-select'),
                                wishlist_popup_name = wishlist_popup_container.find('.wishlist-name'),
                                wishlist_popup_visibility = wishlist_popup_container.find('.wishlist-visibility');

                            data.wishlist_id = wishlist_popup_select.val();
                            data.wishlist_name = wishlist_popup_name.val();
                            data.wishlist_visibility = wishlist_popup_visibility.val();
                        }

                        if (!isCookieEnable()) {
                            alert(yith_wcwl_l10n.labels.cookie_disabled);
                            return;
                        }

                        $.ajax({
                            type: 'POST',
                            url: yith_wcwl_l10n.ajax_url,
                            data: data,
                            dataType: 'json',
                            beforeSend: function () {
                                $button.addClass('loading');
                            },
                            complete: function () {
                                $button.removeClass('loading').addClass('added');
                            },
                            success: function (response) {
                                var msg = $('#yith-wcwl-popup-message'),
                                    response_result = response.result,
                                    response_message = response.message;

                                if (yith_wcwl_l10n.multi_wishlist && yith_wcwl_l10n.is_user_logged_in) {
                                    var wishlist_select = $('select.wishlist-select');
                                    if (typeof $.prettyPhoto !== 'undefined') {
                                        $.prettyPhoto.close();
                                    }
                                    wishlist_select.each(function (index) {
                                        var t = $(this),
                                            wishlist_options = t.find('option');
                                        wishlist_options = wishlist_options.slice(1, wishlist_options.length - 1);
                                        wishlist_options.remove();

                                        if (typeof response.user_wishlists !== 'undefined') {
                                            var i = 0;
                                            for (i in response.user_wishlists) {
                                                if (response.user_wishlists[i].is_default != "1") {
                                                    $('<option>')
                                                        .val(response.user_wishlists[i].ID)
                                                        .html(response.user_wishlists[i].wishlist_name)
                                                        .insertBefore(t.find('option:last-child'))
                                                }
                                            }
                                        }
                                    });

                                }
                                var html = '<div class="popup-added-msg">';
                                if (response_result == 'true') {
                                    if ($product_image.length){
                                        html += $('<div>').append($product_image.clone()).html();
                                    }
                                    html += '<div class="popup-message"><strong class="text-color-heading">'+ product_name +' </strong>' + precise_configs.wishlist.success + '</div>';
                                }else {
                                    html += '<div class="popup-message">' + response_message + '</div>';
                                }
                                html += '<a class="btn btn-secondary view-popup-wishlish" rel="nofollow" href="' + response.wishlist_url.replace('/view', '') + '">' + precise_configs.wishlist.view + '</a>';
                                html += '<a class="btn popup-button-continue" rel="nofollow" href="#">' + precise_configs.global.continue_shopping + '</a>';
                                html += '</div>';

                                showMessageBox(html);
                                $button.attr('href',response.wishlist_url);
                                $('.add_wishlist[data-product_id="' + $button.data('product_id') + '"]').addClass('added');
                                $body.trigger('added_to_wishlist');
                            }
                        });
                    } catch (ex) {
                        la_studio.helps.log(ex);
                    }
                }
            })

        },
        ProductSticky: function(){
            $('.la-p-single-3 .la-single-product-page .la-custom-pright').stick_in_parent({
                parent: $('.la-single-product-page'),
                offset_top: ($masthead.length ? parseInt($masthead.height()) + 30 : 30)
            });

            $document.on('click', '.la-p-single-wrap.la-p-single-3 .wc-tabs a', function(e){
                setTimeout(function(){
                    $body.trigger("sticky_kit:recalc");
                }, 300);
            });

            $('.woocommerce-tabs .wc-tab-title a').on('click', function(e){
                e.preventDefault();
                var $this = $(this),
                    $wrap = $this.closest('.woocommerce-tabs'),
                    $wc_tabs = $wrap.find('.wc-tabs'),
                    $panel = $this.closest('.wc-tab');

                $wc_tabs.find('a[href="'+ $this.attr('href') +'"]').parent().addClass('active').siblings().removeClass('active');
                $panel.addClass('active').siblings().removeClass('active');
            });
            $('.woocommerce-Tabs-panel--description').addClass('active');
        },

        AjaxShop : function(){

            la_studio.helps.ajax_xhr = null;

            if( $('#la_shop_products').length == 0){
                return;
            }

            var elm_to_replace = [
                '#la_shop_products',
                '.woocommerce-result-count',
                '.wc-view-count',
                '.la-advanced-product-filters .sidebar-inner'
            ];

            var target_to_init = '#la_shop_products .la-pagination a, .la-advanced-product-filters-result a',
                target_to_init2 = '.wc-ordering a, .wc-view-count a, .woocommerce.product-sort-by a, .woocommerce.la-price-filter-list a, .woocommerce.widget_layered_nav a, .woocommerce.widget_product_tag_cloud a';


            $document
                .on('la_ajax_shop:filter_ajax', function(e, url, element){

                    if( $('.wc-toolbar-container').length > 0) {
                        var position = $('.wc-toolbar-container').offset().top - 200;
                        $htmlbody.stop().animate({
                                scrollTop: position
                        }, 800 );
                    }

                    if($body.hasClass('open-advanced-shop-filter')){
                        $body.removeClass('open-advanced-shop-filter');
                    }

                    if ('?' == url.slice(-1)) {
                        url = url.slice(0, -1);
                    }
                    url = url.replace(/%2C/g, ',');

                    if (typeof (history.pushState) != "undefined") {
                        history.pushState(null, null, url);
                    }

                    $document.trigger('la_ajax_shop:filter_ajax:before_send', [url, element]);

                    if (la_studio.helps.ajax_xhr) {
                        la_studio.helps.ajax_xhr.abort();
                    }

                    la_studio.helps.ajax_xhr = $.get(url, function ( response ) {

                        for ( var i = 0; i < elm_to_replace.length; i++){
                           if( $(elm_to_replace[i]).length ){

                               if( elm_to_replace[i] == '.la-advanced-product-filters .sidebar-inner'){
                                   if( $(response).find(elm_to_replace[i]).length ){
                                       $(elm_to_replace[i]).replaceWith( $(response).find(elm_to_replace[i]) );
                                   }
                               }else{
                                   try {
                                       $(elm_to_replace[i]).find('.elm-countdown-dateandtime').countdown('destroy');
                                   }catch (ex){}
                                   $(elm_to_replace[i]).replaceWith( $(response).find(elm_to_replace[i]) );
                               }
                            }
                        }

                        if(element.closest('.widget_layered_nav').length){
                            var _tmp_id = element.closest('.widget_layered_nav').attr('id');
                            $('#' + _tmp_id).replaceWith( $(response).find('#' + _tmp_id) );
                        }

                        if(element.closest('.la-price-filter-list').length){
                            var _tmp_id = element.closest('.la-price-filter-list').attr('id');
                            $('#' + _tmp_id).replaceWith( $(response).find('#' + _tmp_id) );
                        }
                        if(element.closest('.widget_layered_nav_filters').length){
                            var _tmp_id = element.closest('.widget_layered_nav_filters').attr('id');
                            $('#' + _tmp_id).replaceWith( $(response).find('#' + _tmp_id) );
                        }

                        $('.la-ajax-shop-loading').removeClass('loading');

                        $document.trigger('la_ajax_shop:filter_ajax:success', [response, url, element]);

                    }, 'html');

                })

                .on('la_ajax_shop:filter_ajax:success', function(e, response, url, element){

                    var $product_container = $('#la_shop_products');
                    $product_container.imagesLoaded().done(function(){
                        if($product_container.find('.la-isotope-container').length){
                            $product_container.find('.la-isotope-container').trigger('la_event_init_isotope');
                        }
                        if($product_container.find('.la-isotope-filter-container').length){
                            $product_container.find('.la-isotope-filter-container').trigger('la_event_init_isotope_filter');
                        }
                        if($product_container.find('.la-slick-slider').length){
                            $product_container.find('.la-slick-slider').trigger('la_event_init_carousel');
                        }
                    });
                })

                .on('click', target_to_init, function(e){
                    e.preventDefault();
                    $('.la-ajax-shop-loading').addClass('loading');
                    $document.trigger('la_ajax_shop:filter_ajax', [$(this).attr('href'), $(this)]);
                })
                .on('click', target_to_init2, function(e){
                    e.preventDefault();
                    $('.la-ajax-shop-loading').addClass('loading');
                    if($(this).closest('.widget_layered_nav').length){
                        $(this).parent().addClass('active');
                    }else{
                        $(this).parent().addClass('active').siblings().removeClass('active');
                    }
                    $document.trigger('la_ajax_shop:filter_ajax', [$(this).attr('href'), $(this)]);
                })
                .on('click', '.woocommerce.widget_layered_nav_filters a', function(e){
                    e.preventDefault();
                    $('.la-ajax-shop-loading').addClass('loading');
                    $document.trigger('la_ajax_shop:filter_ajax', [$(this).attr('href'), $(this)]);
                })
                .on('submit', '.widget_price_filter form', function(e){
                    e.preventDefault();
                    var $form = $(this),
                        url = $form.attr('action') + '?' + $form.serialize();
                    $('.la-ajax-shop-loading').addClass('loading');
                    $document.trigger('la_ajax_shop:filter_ajax', [url, $form]);
                })

        }
    }

    la_studio.theme.for_demo = function(){

        $document.on('click', '.footer-handheld-footer-bar .la_com_action--dropdownmenu .component-target', function(e){
            e.preventDefault();
            $body.removeClass('open-mobile-menu open-search-form');
            $(this).parent().toggleClass('active').siblings('.la_com_action--dropdownmenu').removeClass('active');
        });

        $document.on('click', '.footer-handheld-footer-bar .la_com_action--searchbox', function(e){
            e.preventDefault();
            var $this = $(this);
            if($this.hasClass('active')){
                $body.removeClass('open-mobile-menu open-search-form');
                $this.removeClass('active');
            }else{
                $body.addClass('open-search-form');
                $this.addClass('active');
            }
        });

        $('.portfolio-single-page.style-2 .s-portfolio-right .s-portfolio-right--inner').stick_in_parent({
            parent: $('.portfolio-single-page'),
            offset_top: ($masthead.length ? parseInt($masthead.height()) + 30 : 30)
        });
        $('.portfolio-single-page.style-2 .s-portfolio-right .s-portfolio-right--inner').parent('.s-portfolio-right').css('position','static');

        $document
            .on('click', '.quantity .qty-minus', function(e){
                e.preventDefault();
                var $qty = $(this).next('.qty'),
                    val = parseInt($qty.val());
                $qty.val( val > 1 ? val-1 : 1).trigger('change');
            })
            .on('click', '.quantity .qty-plus', function(e){
                e.preventDefault();
                var $qty = $(this).prev('.qty'),
                    val = parseInt($qty.val());
                $qty.val( val > 0 ? val+1 : 1 ).trigger('change');
            });
        $('#coupon_code_ref').on('change', function(e){
            $('.woocommerce-cart-form__contents #coupon_code').val($(this).val());
        });
        $('#coupon_btn_ref').on('click', function(e){
            e.preventDefault();
            $('.woocommerce-cart-form__contents [name="apply_coupon"]').click();
        });
        $('.dropdown-currency-language .menu > li').each(function(){
            var $this = $(this);
            $this.children('a').append('<span>'+$this.find('li').first().text()+'</span>');
        });

        $document.on('click', '#la_tabs_customer_login .la_tab_control a', function(e){
            e.preventDefault();
            var $this = $(this),
                $target = $($this.attr('href'));
            $this.parent().addClass('active').siblings().removeClass('active');
            $target.addClass('active').show().siblings('div').removeClass('active').hide();
        });
        $document.on('click', '#la_tabs_customer_login .btn-create-account', function(e){
            e.preventDefault();
            $('#la_tabs_customer_login .la_tab_control li:eq(1) a').trigger('click');
        });
        $('#la_tabs_customer_login .la_tab_control li:first-child a').trigger('click');
    }

    $(function(){
        la_studio.shortcodes.fullpage();

        la_studio.theme.ajax_loader();
        la_studio.theme.mega_menu();
        la_studio.theme.accordion_menu();
        la_studio.theme.header_sticky();
        la_studio.theme.headerSidebar();
        la_studio.theme.auto_popup();
        la_studio.theme.auto_carousel();
        la_studio.theme.init_isotope();
        la_studio.theme.init_infinite();
        la_studio.theme.scrollToTop();
        la_studio.theme.css_animation();

        la_studio.shortcodes.unit_responsive();
        la_studio.shortcodes.fix_parallax_row();
        la_studio.shortcodes.google_map();
        la_studio.shortcodes.counter();
        la_studio.shortcodes.fix_tabs();
        la_studio.shortcodes.countdown();
        la_studio.shortcodes.pie_chart();
        la_studio.shortcodes.progress_bar();
        la_studio.shortcodes.fix_row_fullwidth();
        la_studio.shortcodes.fix_rtl_row_fullwidth();

        la_studio.shortcodes.timeline();
        la_studio.shortcodes.team_member();
        la_studio.shortcodes.hotspots();

        la_studio.woocommerce.ProductQuickView();
        la_studio.woocommerce.ProductAddCart();
        la_studio.woocommerce.ProductAddCompare();
        la_studio.woocommerce.ProductAddWishlist();
        la_studio.woocommerce.ProductSticky();
        la_studio.woocommerce.ProductGalleryList();
        la_studio.woocommerce.AjaxShop();
        la_studio.theme.extra_func();

        la_studio.theme.for_demo();

    });

    setTimeout(function(){
        $body.removeClass('site-loading');
    }, 500);
    $window.load(function(){
        $body.removeClass('site-loading');
    });
    $window.on('beforeunload', function(e){
        if(window.laBrowser.name != 'safari'){
            $('#page.site').css('opacity', '0');
            $body.addClass('site-loading');
        }
    });
    $window.on('pageshow', function(e){
        if (e.originalEvent.persisted) {
            $body.removeClass('site-loading');
        }
    });

    $window.on('load resize', function(){
        var $css_id = $('#latheme_fix_css_sticky'),
            $whatever = $('#page > .site-inner'),
            css = '';
        if($whatever.length == 0) return;
        css += '.enable-header-sticky .site-header-mobile.is-sticky .site-header-inner, .enable-header-sticky .site-header.is-sticky .site-header-inner {';
        css += 'max-width: ' + $whatever.outerWidth() + 'px;' ;
        if($body.hasClass('rtl')){
            css += 'right: ' + ($window.width() - ($whatever.offset().left + $whatever.outerWidth())) + 'px;' ;
        }else{
            css += 'left: ' + ($whatever.offset().left) + 'px;' ;
        }
        css += '}';
        if($css_id.length == 0){
            $('head').append('<style id="latheme_fix_css_sticky">'+css+'</style>');
        }else{
            $css_id.html(css);
        }
    });

    $window.load(function(){

        la_studio.shortcodes.tweetsFeed();
        la_studio.shortcodes.instagramFeed();

        function la_newsletter_popup(){
            var $newsletter_popup = $('#la_newsletter_popup');
            if($newsletter_popup.length){
                var show_on_mobile = $newsletter_popup.attr('data-show-mobile'),
                    p_delay = parseInt($newsletter_popup.attr('data-delay'));
                if( (show_on_mobile && $(window).width() < 767) ){
                    return;
                }
                try{
                    if(Cookies.get('precise_dont_display_popup') == 'yes'){
                        return;
                    }
                }catch (ex){}

                setTimeout(function(){
                    lightcase.start({
                        href: '#',
                        maxWidth: parseInt(precise_configs.popup.max_width),
                        maxHeight: parseInt(precise_configs.popup.max_height),
                        inline: {
                            width : parseInt(precise_configs.popup.max_width),
                            height : parseInt(precise_configs.popup.max_height)
                        },
                        onInit : {
                            foo: function() {
                                $('body.lastudio-precise').addClass('open-newsletter-popup');
                            }
                        },
                        onClose : {
                            qux: function() {
                                if($('.la-newsletter-popup #dont_show_popup').length && $('.la-newsletter-popup #dont_show_popup').is(':checked')){
                                    var backtime = parseInt($newsletter_popup.attr('data-back-time'));
                                    try {
                                        Cookies.set('precise_dont_display_popup', 'yes', { expires: backtime, path: '/' });
                                    } catch (ex){}
                                }
                                $('body.lastudio-precise').removeClass('open-newsletter-popup');
                            }
                        },
                        onFinish: {
                            injectContent: function () {
                                lightcase.get('contentInner').children().append($newsletter_popup);
                                $('.lightcase-icon-close').hide();
                                lightcase.resize();
                            }
                        }
                    });
                }, p_delay)
            }

            $(document).on('click', '.btn-close-newsletter-popup', function(e){
                e.preventDefault();
                lightcase.close();
            })
        }
        la_newsletter_popup();
    });

})(jQuery);

(function($) {
    "use strict";

    $.LaStudioHoverDir = function( selector ){
        this.$el = $(selector);
        this._init();
    };
    $.LaStudioHoverDir.prototype = {
        _init : function( ) {
            this._loadEvents();
        },
        _loadEvents : function() {
            var self = this;
            this.$el.on( 'mouseenter.hoverdir, mouseleave.hoverdir', function( event ) {
                var $el = $(this),
                    direction = self._getDir( $el, { x : event.pageX, y : event.pageY } ),
                    _cls = self._getClass( direction),
                    _prefix = ( event.type === 'mouseenter' ) ? 'in-' : 'out-';

                $el.removeClass('in-top in-left in-right in-bottom out-top out-left out-right out-bottom');
                $el.addClass(_prefix + _cls)
            })
        },
        _getDir : function( $el, coordinates ) {
            var w = $el.width(),
                h = $el.height(),
                x = ( coordinates.x - $el.offset().left - ( w/2 )) * ( w > h ? ( h/w ) : 1 ),
                y = ( coordinates.y - $el.offset().top  - ( h/2 )) * ( h > w ? ( w/h ) : 1 );
            return Math.round( ( ( ( Math.atan2(y, x) * (180 / Math.PI) ) + 180 ) / 90 ) + 3 ) % 4;
        },
        _getClass : function( direction ){
            var _cls;
            switch( direction ) {
                case 0:
                    _cls = 'top';
                    break;
                case 1:
                    _cls = 'right';
                    break;
                case 2:
                    _cls = 'bottom';
                    break;
                case 3:
                    _cls = 'left';
                    break;
            }
            return _cls;
        }
    };

    $.fn.lastudiohoverdir = function(){
        return new $.LaStudioHoverDir( this );
    };
    $(function(){
        $('.item-overlay-effect').lastudiohoverdir();
    });

})(jQuery);

(function($) {
    "use strict";

    /**
     * Product gallery class.
     */
    var LA_ProductGallery = function( $target, args ) {
        this.$target = $target;
        this.$images = $( '.woocommerce-product-gallery__image', $target );

        if(!$target.parent('.product--large-image').data('old_gallery')){
            $target.parent('.product--large-image').data('old_gallery', $target.find('.woocommerce-product-gallery__wrapper').html());
        }

        // No images? Abort.
        if ( 0 === this.$images.length ) {
            this.$target.css( 'opacity', 1 );
            this.$target.parent().addClass('no-gallery');
            return;
        }
        if( 1 === this.$images.length ){
            this.$target.parent().addClass('no-gallery');
        }else{
            this.$target.parent().removeClass('no-gallery');
        }

        // Make this object available.
        $target.data( 'product_gallery', this );

        // Pick functionality to initialize...
        this.flexslider_enabled = $.isFunction( $.fn.slick );

        if($target.hasClass('no-slider-script') || $target.hasClass('force-disable-slider-script')){
            this.flexslider_enabled = false;
        }

        //this.flexslider_enabled = false;
        this.zoom_enabled       = $.isFunction( $.fn.zoom ) && wc_single_product_params.zoom_enabled;
        this.photoswipe_enabled = typeof PhotoSwipe !== 'undefined' && wc_single_product_params.photoswipe_enabled;

        // ...also taking args into account.
        if ( args ) {
            this.flexslider_enabled = false === args.flexslider_enabled ? false : this.flexslider_enabled;
            this.zoom_enabled       = false === args.zoom_enabled ? false : this.zoom_enabled;
            this.photoswipe_enabled = false === args.photoswipe_enabled ? false : this.photoswipe_enabled;
        }

        if($target.hasClass('force-disable-slider-script')){
            this.flexslider_enabled = false;
            this.zoom_enabled       = false;
        }

        this.thumb_verital = false;


        if(this.$images.length < 2){
            this.flexslider_enabled = false;
        }

        try {
            if(precise_configs.product_single_design == 2){
                this.thumb_verital = true;
            }
        }catch (ex){
            this.thumb_verital = false;
        }

        // Bind functions to this.
        this.initSlickslider       = this.initSlickslider.bind( this );
        this.initZoom             = this.initZoom.bind( this );
        this.initPhotoswipe       = this.initPhotoswipe.bind( this );
        this.onResetSlidePosition = this.onResetSlidePosition.bind( this );
        this.getGalleryItems      = this.getGalleryItems.bind( this );
        this.openPhotoswipe       = this.openPhotoswipe.bind( this );

        if ( this.flexslider_enabled ) {
            this.initSlickslider();
            $target.on( 'woocommerce_gallery_reset_slide_position', this.onResetSlidePosition );
        } else {
            this.$target.css( 'opacity', 1 );
            setTimeout(function(){
                $('body').trigger("sticky_kit:recalc");
            }, 200);
        }

        if ( this.zoom_enabled ) {
            this.initZoom();
            $target.on( 'woocommerce_gallery_init_zoom', this.initZoom );
        }

        if ( this.photoswipe_enabled ) {
            this.initPhotoswipe();
        }
        $target.removeClass('la-rebuild-product-gallery').parent().removeClass('swatch-loading');
    };

    /**
     * Initialize flexSlider.
     */
    LA_ProductGallery.prototype.initSlickslider = function() {
        var images  = this.$images,
            $target = this.$target,
            $slides = $target.find('.woocommerce-product-gallery__wrapper'),
            $thumb = $target.parent().find('.la-thumb-inner'),
            rand_num = la_studio.helps.makeRandomId(),
            thumb_id = 'la_woo_thumb_' + rand_num,
            target_id = 'la_woo_target_' + rand_num;

        $slides.attr('id', target_id);
        $thumb.attr('id', thumb_id);

        images.each(function(){
            var $that = $(this);
            var video_code = $that.find('a[data-videolink]').data('videolink');
            var image_h = $slides.css('height');
            var thumb_html = '<div class="la-thumb"><img src="'+ $that.attr('data-thumb') +'"/></div>';
            if (typeof video_code != 'undefined' && video_code) {

                if (video_code.indexOf("http://selfhosted/") == 0) {
                    video_code = video_code.replace('http://selfhosted/', '');

                    thumb_html = '<div class="la-thumb has-thumb-video"><div><img src="'+ $that.attr('data-thumb') +'"/><span class="play-overlay"><i class="fa fa-play-circle-o" aria-hidden="true"></i></span></div></div>';

                    $('img', $that).imagesLoaded(function () {
                        $that.unbind('click');
                        $that.find('.zoomImg').css({
                            'display': 'none!important'
                        });
                        $that.append('<video class="selfhostedvid  noLightbox" width="460" height="315" controls preload="auto"><source src="' + video_code + '" /></video>');
                        $that.attr('data-video', '<div class="la-media-wrapper"><video class="selfhostedvid  noLightbox" width="460" height="315" controls preload="auto"><source src="' + video_code + '" /></video></div>');
                        $that.find('img').css({
                            'opacity': '0',
                            'z-index': '-1'
                        });
                        $that.find('iframe').next().remove();
                    });

                } else {

                    thumb_html = '<div class="la-thumb has-thumb-video"><div><img src="'+ $that.attr('data-thumb') +'"/><span class="play-overlay"><i class="fa-play-circle-o"></i></span></div></div>';

                    $('img', $that).imagesLoaded(function () {
                        $that.unbind('click');
                        $that.find('.zoomImg').css({
                            'display': 'none!important'
                        });
                        $that.append('<iframe src ="' + video_code + '" width="460" " style="height:' + image_h + '; z-index:999999;" frameborder="no"></iframe>');
                        $that.attr('data-video', '<div class="la-media-wrapper"><iframe src ="' + video_code + '" width="980" height="551" frameborder="no" allowfullscreen></iframe></div>');
                        $that.find('img').css({
                            'opacity': '0',
                            'z-index': '-1'
                        });
                        $that.find('iframe').next().remove();
                    });
                }
            }
            $(thumb_html).appendTo($thumb);
        });
        $thumb.slick({
            infinite: false,
            slidesToShow: 4,
            slidesToScroll: 1,
            asNavFor: '#' + target_id,
            dots: false,
            arrows: true,
            focusOnSelect: true,
            prevArrow: '<span class="slick-prev"><span class="precise-icon-arrow-minimal-left"></span></span>',
            nextArrow: '<span class="slick-next"><span class="precise-icon-arrow-minimal-right"></span></span>',
            vertical: this.thumb_verital,
            rtl: la_studio.helps.is_rtl,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        vertical: this.thumb_verital,
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 991,
                    settings: {
                        vertical: false,
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        vertical: false,
                        slidesToShow: 5
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        vertical: false,
                        slidesToShow: 4
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        vertical: false,
                        slidesToShow: 3
                    }
                }
            ]
        });

        $slides.slick({
            infinite: false,
            swipe: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            asNavFor: '#' + thumb_id,
            rtl: la_studio.helps.is_rtl
        });
        $target.css( 'opacity', 1 );
        setTimeout(function(){
            $('body').trigger("sticky_kit:recalc");
        }, 200);
        setTimeout(function(){
            $thumb.slick('setPosition');
            $target.parent().removeClass('swatch-loading');
        },100);
    };

    /**
     * Init zoom.
     */
    LA_ProductGallery.prototype.initZoom = function() {
        var zoomTarget   = this.$images,
            galleryWidth = this.$target.width(),
            zoomEnabled  = false;

        if ( ! this.flexslider_enabled ) {
            zoomTarget = zoomTarget.first();
        }

        $( zoomTarget ).each( function( index, target ) {
            var image = $( target ).find( 'img' );

            if ( image.data( 'large_image_width' ) > galleryWidth ) {
                zoomEnabled = true;
                return false;
            }
        } );

        // But only zoom if the img is larger than its container.
        if ( zoomEnabled ) {
            var zoom_options = {
                touch: false
            };

            if ( 'ontouchstart' in window ) {
                zoom_options.on = 'click';
            }

            zoomTarget.trigger( 'zoom.destroy' );
            zoomTarget.zoom( zoom_options );
        }
    };

    /**
     * Init PhotoSwipe.
     */
    LA_ProductGallery.prototype.initPhotoswipe = function() {
        if ( this.zoom_enabled && this.$images.length > 0 ) {
            this.$target.prepend( '<a href="#" class="woocommerce-product-gallery__trigger"></a>' );
            this.$target.on( 'click', '.woocommerce-product-gallery__trigger', this.openPhotoswipe );
        }
        this.$target.on( 'click', '.woocommerce-product-gallery__image a', this.openPhotoswipe );
    };

    /**
     * Reset slide position to 0.
     */
    LA_ProductGallery.prototype.onResetSlidePosition = function() {
        this.$target.find('.woocommerce-product-gallery__wrapper').slick('slickGoTo', 0);
    };

    /**
     * Get product gallery image items.
     */
    LA_ProductGallery.prototype.getGalleryItems = function() {
        var $slides = this.$images,
            items   = [];

        if ( $slides.length > 0 ) {
            $slides.each( function( i, el ) {
                var img = $( el ).find( 'img' ),
                    large_image_src = img.attr( 'data-large_image' ),
                    large_image_w   = img.attr( 'data-large_image_width' ),
                    large_image_h   = img.attr( 'data-large_image_height' ),
                    item            = {
                        src: large_image_src,
                        w:   large_image_w,
                        h:   large_image_h,
                        title: img.attr( 'title' )
                    };
                if($(el).attr('data-video')){
                    item = {
                        html: $(el).attr('data-video')
                    };
                }
                items.push( item );
            } );
        }

        return items;
    };

    /**
     * Open photoswipe modal.
     */
    LA_ProductGallery.prototype.openPhotoswipe = function( e ) {
        e.preventDefault();

        var pswpElement = $( '.pswp' )[0],
            items       = this.getGalleryItems(),
            eventTarget = $( e.target ),
            clicked;

        if ( ! eventTarget.is( '.woocommerce-product-gallery__trigger' ) ) {
            clicked = eventTarget.closest( '.woocommerce-product-gallery__image' );
        } else {
            clicked = this.$target.find( '.slick-current' );
        }

        var options = {
            index:                 $( clicked ).index(),
            shareEl:               false,
            closeOnScroll:         false,
            history:               false,
            hideAnimationDuration: 0,
            showAnimationDuration: 0
        };

        // Initializes and opens PhotoSwipe.
        var photoswipe = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options );
        photoswipe.init();
    };

    /**
     * Function to call la_product_gallery on jquery selector.
     */
    $.fn.la_product_gallery = function( args ) {
        new LA_ProductGallery( this, args );
        return this;
    };

    /*
     * Initialize all galleries on page.
     */
    $( '.la-woo-product-gallery' ).each( function() {
        $( this ).la_product_gallery();
    } );


})(jQuery);


/*
 Initialize LA Swatches
 */
(function($) {
    'use strict';

    function variation_calculator(variation_attributes, product_variations, all_set_callback, not_all_set_callback) {
        this.recalc_needed = true;

        this.all_set_callback = all_set_callback;
        this.not_all_set_callback = not_all_set_callback;

        //The varioius attributes and their values available as configured in woocommerce. Used to build and reset variations_current
        this.variation_attributes = variation_attributes;

        //The actual variations that are configured in woocommerce.
        this.variations_available = product_variations;

        //Stores the calculation result for attribute + values that are available based on the selected attributes.
        this.variations_current = {};

        //Stores the selected attributes + values
        this.variations_selected = {};

        //Reset all the attributes + values to disabled.  They will be reenabled durring the calcution.
        this.reset_current = function () {
            for (var attribute in this.variation_attributes) {
                this.variations_current[attribute] = {};
                for (var av = 0; av < this.variation_attributes[attribute].length; av++) {
                    this.variations_current[attribute.toString()][this.variation_attributes[attribute][av].toString()] = 0;
                }
            }
        };

        //Do the things to update the variations_current object with attributes + values which are enabled.
        this.update_current = function () {
            this.reset_current();
            for (var i = 0; i < this.variations_available.length; i++) {
                if (!this.variations_available[i].variation_is_active) {
                    continue; //Variation is unavailable, probably out of stock.
                }

                //the variation attributes for the product this variation.
                var variation_attributes = this.variations_available[i].attributes;

                //loop though each variation attribute, turning on and off attributes which won't be available.
                for (var attribute in variation_attributes) {

                    var maybe_available_attribute_value = variation_attributes[attribute];
                    var selected_value = this.variations_selected[attribute];

                    if (selected_value && selected_value == maybe_available_attribute_value) {
                        this.variations_current[attribute][maybe_available_attribute_value] = 1; //this is a currently selected attribute value
                    } else {

                        var result = true;

                        /*

                         Loop though any other item that is selected,
                         checking to see if the attribute value does not match one of the attributes for this variation.
                         If it does not match the attributes for this variation we do nothing.
                         If none have matched at the end of these loops, the atttribute_option will remain off and unavailable.

                         */
                        for (var other_selected_attribute in this.variations_selected) {

                            if (other_selected_attribute == attribute) {
                                //We are looking to see if any attribute that is selected will cause this to fail.
                                //Continue the loop since this is the attribute from above and we don't need to check against ourselves.
                                continue;
                            }

                            //Grab the value that is selected for the other attribute.
                            var other_selected_attribute_value = this.variations_selected[other_selected_attribute];

                            //Grab the current product variations attribute value for the other selected attribute we are checking.
                            var other_available_attribute_value = variation_attributes[other_selected_attribute];

                            if (other_selected_attribute_value) {
                                if (other_available_attribute_value) {
                                    if (other_selected_attribute_value != other_available_attribute_value) {
                                        /*
                                         The value this variation has for the "other_selected_attribute" does not match.
                                         Since it does not match it does not allow us to turn on an available attribute value.

                                         Set the result to false so we skip turning anything on.

                                         Set the result to false so that we do not enable this attribute value.

                                         If the value does match then we know that the current attribute we are looping through
                                         might be available for us to set available attribute values.
                                         */
                                        result = false;
                                        //Something on this variation didn't match the current selection, so we don't care about any of it's attributes.
                                    }
                                }
                            }
                        }

                        /**
                         After checking this attribute against this variation's attributes
                         we either have an attribute which should be enabled or not.

                         If the result is false we know that something on this variation did not match the currently selected attribute values.

                         **/
                        if (result) {
                            if (maybe_available_attribute_value === "") {
                                for (var av in this.variations_current[attribute]) {
                                    this.variations_current[attribute][av] = 1;
                                }

                            } else {
                                this.variations_current[attribute][maybe_available_attribute_value] = 1;
                            }
                        }

                    }
                }
            }

            this.recalc_needed = false;
        };

        this.get_current = function () {
            if (this.recalc_needed) {
                this.update_current();
            }
            return this.variations_current;
        };

        this.reset_selected = function () {
            this.recalc_needed = true;
            this.variations_selected = {};
        }

        this.set_selected = function (key, value) {
            this.recalc_needed = true;
            this.variations_selected[key] = value;
        };

        this.get_selected = function () {
            return this.variations_selected;
        }
    }

    function la_generator_gallery_html( variation ){
        var _html = '';
        if( typeof variation !== "undefined" && $.isArray(variation.la_additional_images) ){
            $.each(variation.la_additional_images, function(idx, val){
                _html += '<div data-thumb="'+val.thumb[0]+'" class="woocommerce-product-gallery__image">';
                _html += '<a href="'+val.large[0]+'" data-videolink="'+val.videolink+'">';
                _html += '<img ';
                _html += 'width="'+val.single[1]+'" ';
                _html += 'height="'+val.single[2]+'" ';
                _html += 'src="'+val.single[0]+'" ';
                _html += 'class="attachment-shop_single size-shop_single" ';
                _html += 'alt="'+val.alt+'" ';
                _html += 'title="'+val.title+'" ';
                _html += 'data-caption="'+val.caption+'" ';
                _html += 'data-src="'+val.large[0]+'" ';
                _html += 'data-large_image="'+val.large[0]+'" ';
                _html += 'data-large_image_width="'+val.large[1]+'" ';
                _html += 'data-large_image_height="'+val.large[2]+'" ';
                _html += 'srcset="'+val.srcset+'" ';
                _html += 'sizes="'+val.sizes+'" ';
                _html += '</a>';
                _html += '</div>';
            });
        }
        return _html;
    }

    function la_update_swatches_gallery($form, variation ){
        var $product_selector = $form.closest('.la-p-single-wrap'),
            $main_image_col = $product_selector.find('.product--large-image'),
            _html = '';
        if(variation !== null){
            _html = la_generator_gallery_html(variation);
        }
        else{
            var _old_gallery = $main_image_col.data('old_gallery') || false;
            if(_old_gallery){
                _html = _old_gallery;
            }
        }
        if (_html != '') {
            _html = '<div class="woocommerce-product-gallery--with-images la-woo-product-gallery'+ ($main_image_col.hasClass('force-disable-slider-script') ? ' force-disable-slider-script' : '') +'"><figure class="woocommerce-product-gallery__wrapper">'+_html+'</figure><div class="la_woo_loading"><div class="la-loader spinner3"><div class="dot1"></div><div class="dot2"></div><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div></div></div>';
            _html += '<div id="la_woo_thumbs" class="la-woo-thumbs"><div class="la-thumb-inner"></div></div>';
            $main_image_col.css('min-height', $main_image_col.height()).addClass('swatch-loading').html(_html);
            var $la_gallery_selector = $main_image_col.find('.la-woo-product-gallery');
            if(variation !== null){
                $la_gallery_selector.addClass('la-rebuild-product-gallery');
            }
            $la_gallery_selector.la_product_gallery().addClass('swatch-loaded');
            $main_image_col.css('min-height', 0);
        }
    }

    $.fn.la_variation_form = function () {
        var $form = this;
        var $product_id = parseInt($form.data('product_id'), 10);
        var calculator = null;
        var $use_ajax = false;
        var $swatches_xhr = null;

        $form.addClass('la-init-swatches');

        $form.find('td.label').each(function(){
            var $label = $(this).find('label');
            $label.append('<span class="swatch-label"></span>');
        });

        $form.on('bind_calculator', function () {

            var $product_variations = $form.data('product_variations');
            $use_ajax = $product_variations === false;

            if ($use_ajax) {
                $form.block({message: null, overlayCSS: {background: '#fff', opacity: 0.6}});
            }

            var attribute_keys = {};

            //Set the default label.
            $form.find('.select-option.selected').each(function (index, el) {
                var $this = $(this);

                //Get the wrapper select div
                var $option_wrapper = $this.closest('div.select').eq(0);
                var $label = $option_wrapper.closest('tr').find('.swatch-label').eq(0);
                var $la_select_box = $option_wrapper.find('select').first();

                // Decode entities
                var attr_val = $('<div/>').html($this.data('value')).text();

                // Add slashes
                attr_val = attr_val.replace(/'/g, '\\\'');
                attr_val = attr_val.replace(/"/g, '\\\"');

                if ($label) {
                    $label.html($la_select_box.children("[value='" + attr_val + "']").eq(0).text());
                }
                $la_select_box.trigger('change');
            });

            $form.find('.variations select').each(function (index, el) {
                var $current_attr_select = $(el);
                var current_attribute_name = $current_attr_select.data('attribute_name') || $current_attr_select.attr('name');

                attribute_keys[current_attribute_name] = [];

                //Build out a list of all available attributes and their values.
                var current_options = '';
                current_options = $current_attr_select.find('option:gt(0)').get();

                if (current_options.length) {
                    for (var i = 0; i < current_options.length; i++) {
                        var option = current_options[i];
                        attribute_keys[current_attribute_name].push($(option).val());
                    }
                }
            });

            if ($use_ajax) {
                if ($swatches_xhr) {
                    $swatches_xhr.abort();
                }

                var data = {
                    product_id: $product_id,
                    action: 'la_swatch_get_product_variations'
                };

                $swatches_xhr = $.ajax({
                    url: precise_configs.ajax_url,
                    type: 'POST',
                    data: data,
                    success: function (response) {
                        calculator = new variation_calculator(attribute_keys, response.data, null, null);
                        $form.unblock();
                    }
                });
            } else {
                calculator = new variation_calculator(attribute_keys, $product_variations, null, null);
            }

            $form.trigger('woocommerce_variation_has_changed');
        });

        $form
            .on('change', '.wc-default-select', function(e){
                var $__that = $(this);
                var $label = $__that.closest('tr').find('.swatch-label').eq(0);
                if($__that.val() != ''){
                    $label.html($__that.find('option:selected').html());
                }else{
                    $label.html('');
                }
            });

        $form.find('.wc-default-select').trigger('change');

        $form
        // On clicking the reset variation button
            .on('click', '.reset_variations', function () {
                $form.find('.swatch-label').html('');
                $form.find('.select-option').removeClass('selected');
                $form.find('.radio-option').prop('checked', false);
                return false;
            })
            .on('click', '.select-option', function (e) {
                e.preventDefault();

                var $this = $(this);

                //Get the wrapper select div
                var $option_wrapper = $this.closest('div.select').eq(0);
                var $label = $option_wrapper.closest('tr').find('.swatch-label').eq(0);

                if ($this.hasClass('disabled')) {
                    return false;
                } else if ($this.hasClass('selected')) {
                    $this.removeClass('selected');
                    var $la_select_box = $option_wrapper.find('select').first();
                    $la_select_box.children('option:eq(0)').prop("selected", "selected").change();
                    if ($label) {
                        $label.html('');
                    }
                } else {

                    $option_wrapper.find('.select-option').removeClass('selected');
                    //Set the option to selected.
                    $this.addClass('selected');

                    //Select the option.
                    var $la_select_box = $option_wrapper.find('select').first();

                    // Decode entities
                    var attr_val = $('<div/>').html($this.data('value')).text();

                    // Add slashes
                    attr_val = attr_val.replace(/'/g, '\\\'');
                    attr_val = attr_val.replace(/"/g, '\\\"');

                    $la_select_box.trigger('focusin').children("[value='" + attr_val + "']").prop("selected", "selected").change();
                    if ($label) {
                        $label.html($la_select_box.children("[value='" + attr_val + "']").eq(0).text());
                    }
                }
            })
            .on('change', '.radio-option', function (e) {

                var $this = $(this);

                //Get the wrapper select div
                var $option_wrapper = $this.closest('div.select').eq(0);

                //Select the option.
                var $la_select_box = $option_wrapper.find('select').first();

                // Decode entities
                var attr_val = $('<div/>').html($this.val()).text();

                // Add slashes
                attr_val = attr_val.replace(/'/g, '\\\'');
                attr_val = attr_val.replace(/"/g, '\\\"');

                $la_select_box.trigger('focusin').children("[value='" + attr_val + "']").prop("selected", "selected").change();


            })
            .on('woocommerce_variation_has_changed', function () {
                if (calculator === null) {
                    return;
                }

                $form.find('.variations select').each(function () {
                    var attribute_name = $(this).data('attribute_name') || $(this).attr('name');
                    calculator.set_selected(attribute_name, $(this).val());
                });

                var current_options = calculator.get_current();

                //Grey out or show valid options.
                $form.find('div.select').each(function (index, element) {
                    var $la_select_box = $(element).find('select').first();

                    var attribute_name = $la_select_box.data('attribute_name') || $la_select_box.attr('name');
                    var avaiable_options = current_options[attribute_name];

                    $(element).find('div.select-option').each(function (index, option) {
                        if (!avaiable_options[$(option).data('value')]) {
                            $(option).addClass('disabled', 'disabled');
                        } else {
                            $(option).removeClass('disabled');
                        }
                    });

                    $(element).find('input.radio-option').each(function (index, option) {
                        if (!avaiable_options[$(option).val()]) {
                            $(option).attr('disabled', 'disabled');
                            $(option).parent().addClass('disabled', 'disabled');
                        } else {
                            $(option).removeAttr('disabled');
                            $(option).parent().removeClass('disabled');
                        }
                    });
                });

                if ($use_ajax) {
                    //Manage a regular  default select list.
                    // WooCommerce core does not do this if it's using AJAX for it's processing.
                    $form.find('.wc-default-select').each(function (index, element) {
                        var $la_select_box = $(element);

                        var attribute_name = $la_select_box.data('attribute_name') || $la_select_box.attr('name');
                        var avaiable_options = current_options[attribute_name];

                        $la_select_box.find('option:gt(0)').removeClass('attached');
                        $la_select_box.find('option:gt(0)').removeClass('enabled');
                        $la_select_box.find('option:gt(0)').removeAttr('disabled');

                        //Disable all options
                        $la_select_box.find('option:gt(0)').each(function (optindex, option_element) {
                            if (!avaiable_options[$(option_element).val()]) {
                                $(option_element).addClass('disabled', 'disabled');
                            } else {
                                $(option_element).addClass('attached');
                                $(option_element).addClass('enabled');
                            }
                        });

                        $la_select_box.find('option:gt(0):not(.enabled)').attr('disabled', 'disabled');

                    });
                }
            })
            .on('found_variation', function( event, variation ){
                la_update_swatches_gallery($form, variation);
            })
            .on('reset_image', function( event ){
                la_update_swatches_gallery($form, null);
            });
    };

    var forms = [];

    $(document).on('wc_variation_form', '.variations_form',  function (e) {
        var $form = $(e.target);
        forms.push($form);
        if ( !$form.data('has_swatches_form') ) {
            if (true || $form.find('.swatch-control').length) {
                $form.data('has_swatches_form', true);

                $form.la_variation_form();
                $form.trigger('bind_calculator');

                $form.on('reload_product_variations', function () {
                    for (var i = 0; i < forms.length; i++) {

                        forms[i].trigger('woocommerce_variation_has_changed');
                        forms[i].trigger('bind_calculator');
                        forms[i].trigger('woocommerce_variation_has_changed');
                    }
                })
            }
        }
    });

    $('.variations_form').trigger('wc_variation_form');

})(jQuery);

(function($) {
    "use strict";

    $(function(){
        $(document)
            .on('click', 'html.touch .mega-menu > li.menu-item-has-children > a', function(e){
                if( $(window).width() < 992 && precise_configs.support_touch != "" ) {
                    $(this).parent().siblings().removeClass('go-go');
                    if (!$(this).parent().hasClass('go-go')) {
                        e.preventDefault();
                        $(this).parent().addClass('go-go');
                    }
                }
            })
            .on('click', 'html.touch .product_item--thumbnail-holder .woocommerce-loop-product__link', function(e){
                if( $(window).width() < 992 && precise_configs.support_touch != "" ) {
                    if (!$(this).hasClass('go-go')) {
                        e.preventDefault();
                        $(this).addClass('go-go');
                    }
                }
            });
    });

})(jQuery);