!function ($) {
    window['fp_parallaxExtension'] = function () {

        var global_bg_type,
            global_bg_height,
            global_bg_width,
            win_height,
            win_width,
            fp_sections,
            global_is_property_bacbkground,
            isContinuousHorizontal,
            _getFPData = $.fn.fullpage.getFullpageData(),
            FPDataOptions = _getFPData.options,
            FPDataInternals = _getFPData.internals,
            WRAPPER = "fullpage-wrapper",
            WRAPPER_SEL = "." + WRAPPER,
            ACTIVE = "active",
            ACTIVE_SEL = "." + ACTIVE,
            SECTION = "fp-section",
            SECTION_SEL = "." + SECTION,
            SECTION_ACTIVE_SEL = SECTION_SEL + ACTIVE_SEL,
            SLIDE = "fp-slide",
            SLIDE_SEL = "." + SLIDE,
            SLIDE_ACTIVE_SEL = SLIDE_SEL + ACTIVE_SEL,
            NO_TRANSITION = "fp-notransition",
            BG = "fp-bg",
            BG_SEL = "." + BG,
            P_REVEAL = "reveal",
            P_COVER = "cover",
            P_STYLESHEET = "fp-parallax-stylesheet",
            P_TRANSITION = "fp-parallax-transitions",
            P_TRANSITION_SEL = "#" + P_TRANSITION,
            P_TRANSITION_CLASS = "fp-parallax-transition-class",
            P_TRANSITION_CLASS_SEL = "#" + P_TRANSITION_CLASS,
            global_is_scrolling = false,
            global_element_offset = 0,
            onGrabStatus = false,
            ContinuousHorizontalStatus = false,
            global_scrolling_status = true,
            _lafullpage_45 = true,
            global_has_init = false,
            global_resizing_status = false,
            isContinuousVertical = false,
            isOnGrab = false,
            $window = $(window),
            _timer,
            _self = this;

        function set_log( msg, title){
            console.group("LA Parallax: " + (typeof title !== "undefined" ? title : '') );
            console.log(msg);
            console.groupEnd();
        }

        function _getBgOffsetHeight(value) {
            return {
                cover: {
                    offsetNormal: value ? 0 : global_bg_height
                },
                reveal: {
                    offsetNormal: value ? -global_bg_height : 0
                }
            }
        }

        function _getBgOffsetWidth(value) {
            return {
                cover: {
                    offsetNormal: value ? 0 : global_bg_width
                },
                reveal: {
                    offsetNormal: value ? -global_bg_width : 0
                }
            }
        }

        function _getBgHeight(value) {
            return value * win_height / 100
        }

        function _getBgWidth( value ) {
            if (is_active_menu()) {
                return value * win_width / 100
            }
        }

        function updateSectionData() {
            var $currentSection = $(SECTION_ACTIVE_SEL).length ? $(SECTION_ACTIVE_SEL) : $(SECTION_SEL).first();
            setDataToSection($currentSection, 0);
        }

        function _set_const() {
            return true;
        }

        function reBuildDataForSection() {
            var $currentSection = $(SECTION_ACTIVE_SEL).length ? $(SECTION_ACTIVE_SEL) : $(SECTION_SEL).first(),
                is_reveal = global_bg_type === P_REVEAL,
                $sectionNext = is_reveal ? $currentSection.nextAll() : $currentSection.prevAll(),
                $sectionPrev = is_reveal ? $currentSection.prevAll() : $currentSection.nextAll();

            if(_set_const()){
                $sectionNext.each(function () {
                    setDataToSection($(this), _getBgOffsetHeight(is_reveal)[global_bg_type]["offsetNormal"], "silent")
                });
                $sectionPrev.each(function () {
                    setDataToSection($(this), 0, "silent")
                });
                if(is_active_menu()){
                    $(SECTION_SEL).each(function () {
                        var $_slides = $(this).find(SLIDE_SEL);
                        if ($_slides.length) {
                            var $currentSection = $(this).find(SLIDE_ACTIVE_SEL).length ? $(this).find(SLIDE_ACTIVE_SEL) : $(this).find(SLIDE_SEL).first();
                            reBuildDataForSlide($currentSection)
                        }
                    })
                }
            }
        }

        function reBuildDataForSlide( $slide ) {
            var is_reveal = global_bg_type === P_REVEAL,
                $slideNext = is_reveal ? $slide.nextAll() : $slide.prevAll(),
                $slidePrev = is_reveal ? $slide.prevAll() : $slide.nextAll();

            if(_set_const()){
                $slideNext.each(function () {
                    setDataToSlide($(this), _getBgOffsetWidth(is_reveal)[global_bg_type]["offsetNormal"], "silent")
                });
                $slidePrev.each(function () {
                    setDataToSlide($(this), 0, "silent")
                });
            }
        }

        function handlerSetAutoScrolling(e, data) {
            win_width = $window.width();
            if(data && !FPDataOptions.scrollBar){
                insertCssForElement();
                insertTransitionCSS();
            }else{
                removeTransitionCSS();
            }
            set_log('running', 'handlerSetAutoScrolling');
        }

        function handlerDestroy() {
            _self.destroy();
            global_has_init = false;
        }

        function initEventHandler() {
            $(WRAPPER_SEL)
                .on("setAutoScrolling", handlerSetAutoScrolling)
                .on("destroy", handlerDestroy)
                .on("onScroll", handlerOnScroll)
                .on("afterResponsive", handlerAfterResponsive)
                .on("onGrab", handlerOnGrab)
                .on("onContinuosHorizontal", handlerOnContinuosHorizontal)
                .on("onContinuousVertical", handlerOnContinuousVertical)
                .on("onResize", handlerOnResize);
        }

        function handlerOnGrab(e, $data) {
            if($data){
                removeTransitionCSS();
            }
            else{
                isOnGrab = true;
            }
        }

        function handlerAfterResponsive(e, $data) {
            $(BG_SEL).data("final-x", 0);
            $(BG_SEL).data("final-y", 0);
            fp_sections = document.querySelectorAll(SECTION_SEL);
            reBuildDataForSection();
        }

        function handlerOnContinuosHorizontal(e, $data) {
            global_resizing_status = true;
            if (_self.fp_fixed()) {
                var $currentSlide = "left" === $data.xMovement ? $(SECTION_ACTIVE_SEL).find(SLIDE_SEL).first() : $(SECTION_ACTIVE_SEL).find(SLIDE_SEL).last();
                reBuildDataForSlide($currentSlide);
                setTimeout(function () {
                    _self.applyHorizontal($data)
                },50)
            }
        }

        function handlerOnContinuousVertical(e, $data) {
            isContinuousVertical = true;
            reBuildDataForSection();
            setTimeout(function () {
                _self.apply($data)
            }, 50)
        }

        function handlerOnScroll() {
            set_log('running', 'handlerOnScroll');
            if(global_has_init && !global_is_scrolling && (FPDataOptions.scrollBar || !FPDataOptions.autoScrolling || FPDataInternals.usingExtension("dragAndMove"))){
                requestAnimationFrame(handlerRequestAnimationFrame);
                global_is_scrolling = true
            }
        }

        function insertCssForElement() {
            if (_set_const()) {
                if(FPDataOptions.autoScrolling && !FPDataOptions.scrollBar){
                    var css_content = ".fp-bg{ transition: all " + FPDataOptions.scrollingSpeed + "ms " + FPDataOptions.easingcss3 + "} .fp-slide, .fp-section{ will-change: transform; transition: background-position " + FPDataOptions.scrollingSpeed + "ms " + FPDataOptions.easingcss3 + "}";
                    appendCSS(P_TRANSITION, css_content);
                }
            }
        }

        function insertTransitionCSS() {
            var _content_css = ".fp-bg-animate{ transition: all " + FPDataOptions.scrollingSpeed + "ms " + FPDataOptions.easingcss3 + "}";
            appendCSS(P_TRANSITION_CLASS, _content_css)
        }

        function removeTransitionCSS() {
            $(P_TRANSITION_SEL).remove();
        }

        function handlerOnResize() {
            clearTimeout( _timer );
            _timer = setTimeout(handlerOnResizeCallBack, 250);
        }

        function handlerOnResizeCallBack() {
            win_height = $window.height();
            win_width = $window.width();
            global_bg_height = _getBgHeight(FPDataOptions.parallaxOptions.percentage);
            global_bg_width = _getBgWidth(FPDataOptions.parallaxOptions.percentage);
            if(_self.fp_fixed() && is_active_menu()){
                updateSectionData();
                reBuildDataForSection();
                setHeightForBgElement();
            }
        }

        function _check_const() {
            return true;
        }

        function setHeightForBgElement() {
            $(BG_SEL).height(win_height);
        }

        function handlerRequestAnimationFrame() {
            var currentScroll = FPDataInternals.usingExtension("dragAndMove") ? Math.abs($.fn.fullpage.dragAndMove.getCurrentScroll()) : $window.scrollTop(),
                isAtBottom = global_element_offset > currentScroll,
                current_section_idx = $(SECTION_ACTIVE_SEL).index(SECTION_SEL),
                currentSectionOffset = win_height + currentScroll;
            global_element_offset = currentScroll;
            if (_self.fp_fixed()) {
                for (var i = 0; i < fp_sections.length; ++i) {
                    var section = fp_sections[i],
                        nextSectionOffset = win_height + section.offsetTop;
                    if(!isAtBottom && section.offsetTop <= currentSectionOffset){
                        current_section_idx = i;
                    }else{
                        if(isAtBottom && nextSectionOffset >= currentScroll && section.offsetTop < currentScroll && fp_sections.length > i + 1){
                            current_section_idx = i + 1
                        }
                    }
                }
            }
            set_log(current_section_idx, 'currentIndex');

            var _lafullpage_a = win_height - (fp_sections[current_section_idx].offsetTop - currentScroll),
                _lafullpage_b = _lafullpage_a * global_bg_height / win_height;
            if (global_bg_type !== P_REVEAL && (current_section_idx -= 1),
                    _check_const()) {
                var _lafullpage_c = global_bg_type !== P_REVEAL ? _lafullpage_b : -global_bg_height + _lafullpage_b;
                if (setDataToSection($(SECTION_SEL).eq(current_section_idx), _lafullpage_c), current_section_idx - 1 >= 0 && setDataToSection($(fp_sections[current_section_idx - 1]), _getBgOffsetHeight(false)[global_bg_type]["offsetNormal"]), !_self.fp_fixed()) {
                    return false
                };
                "undefined" != typeof fp_sections[current_section_idx + 1] && setDataToSection($(fp_sections[current_section_idx + 1]), _getBgOffsetHeight(true)[global_bg_type]["offsetNormal"]), global_is_scrolling = false
            }
        }

        function _sanitize_value( value ) {
            return Math.round(2 * value) / 2
        }

        function is_active_menu() {
            return true;
            //return _check_const() && "#menu" === FPDataOptions.menu
        }

        function setDataToSection($elem, value, type) {
            var position = _sanitize_value(value, 1),
                $slides = $elem.find(SLIDE_SEL);

            if ($slides.length && _check_const()) {
                var $_slides = ($elem.index(SECTION_SEL), $slides.filter(ACTIVE_SEL));
                $elem = $_slides.length ? $_slides : $slides.first()
            }

            if (global_is_property_bacbkground) {
                $elem.css({
                    "background-position-y": position + "px"
                })
            } else {
                if ( (!$elem.hasClass(SLIDE) || $elem.hasClass(ACTIVE) || "undefined" != typeof type) && is_active_menu()) {
                    var $bg_elem = $elem.find(BG_SEL),
                        _value = "undefined" != typeof $bg_elem.data("final-x") ? $bg_elem.data("final-x") : 0;
                    $bg_elem.toggleClass(NO_TRANSITION, "undefined" != typeof type).css({
                        transform: "translate3d(" + _value + "px, " + position + "px, 0)"
                    }).data("final-x", _value).data("final-y", position)
                }
            }
        }

        function setDataToSlide($elem, value, type) {

            var position = _sanitize_value(value, 1),
                $bg_elem = global_is_property_bacbkground ? $elem : $elem.find(BG_SEL);
            if (!FPDataOptions.scrollBar && FPDataOptions.autoScrolling || $bg_elem.addClass("fp-bg-animate"),
                    global_is_property_bacbkground) {
                $bg_elem.toggleClass(NO_TRANSITION, "undefined" != typeof type).css({
                    "background-position-x" : position + "px"
                })
            } else {
                var new_v = 0,
                    old_v = $bg_elem.data("final-y");
                if( "none" !== old_v && "undefined" != typeof old_v ){
                    new_v = old_v
                }
                $bg_elem.toggleClass(NO_TRANSITION, "undefined" != typeof type).css({
                    transform: "translate3d(" + position + "px, " + new_v + "px, 0)"
                }).data("final-x", position).data("final-y", new_v)
            }
        }

        function getSlideOrSection( $section ) {
            return $section.find(SLIDE_SEL).length ? $section.find(SLIDE_SEL).length > 1 ? $section.find(SLIDE_SEL) : $section.find(SLIDE_SEL) : $section
        }

        function appendCSS(style_id, content) {
            $("#" + style_id).length || $('<style id="' + style_id + '">' + content + "</style>").appendTo('head')
        }

        _self.fp_fixed = function () {
            return _check_const();
        };

        _self.apply = function ( $elem ) {

            if (isOnGrab && insertCssForElement(), !$elem.localIsResizing && !FPDataOptions.scrollBar && FPDataOptions.autoScrolling && _set_const()) {
                if (g_isAboutToRewindVertical = "up" !== $elem.yMovement && !$elem.sectionIndex || $elem.isMovementUp && !($elem.leavingSection - 1),
                    g_isAboutToRewindVertical && FPDataOptions.continuousVertical && !isContinuousVertical) {
                    return void ((g_isAboutToRewindVertical = false))
                }
                onGrabStatus = ("up" === $elem.yMovement);

                var _lafullpage_5 = _getBgOffsetHeight(onGrabStatus),
                    _lafullpage_6 = _lafullpage_5[global_bg_type]["offsetNormal"];

                setDataToSection($(SECTION_SEL).eq($elem.sectionIndex), 0),
                    setDataToSection($(SECTION_SEL).eq($elem.leavingSection - 1), _lafullpage_6),
                    global_scrolling_status = 1 === Math.abs($elem.leavingSection - 1 - $elem.sectionIndex);
                for (var i = Math.min($elem.leavingSection - 1, $elem.sectionIndex) + 1; i < Math.max($elem.leavingSection - 1, $elem.sectionIndex); i++) {
                    setDataToSection($(SECTION_SEL).eq(i), 0, "silent")
                }
            }
        };

        _self.applyHorizontal = function ($elem) {
            if (!$elem.localIsResizing && "none" != $elem.xMovement) {
                if (isContinuousHorizontal = "undefined" != typeof $elem.direction && $elem.direction !== $elem.xMovement,
                    isContinuousHorizontal && FPDataOptions.continuousHorizontal && !global_resizing_status && _set_const()) {
                    return void ((isContinuousHorizontal = false))
                }
                ContinuousHorizontalStatus = isContinuousHorizontal ? "left" === $elem.direction : "left" === $elem.xMovement;
                var _lafullpage_4 = _getBgOffsetWidth(ContinuousHorizontalStatus)
                    , _lafullpage_5 = _lafullpage_4[global_bg_type]["offsetNormal"];
                if (_self.fp_fixed() && (setDataToSlide($(SECTION_ACTIVE_SEL).find(SLIDE_SEL).eq($elem.slideIndex), 0),
                        setDataToSlide($(SECTION_ACTIVE_SEL).find(SLIDE_SEL).eq($elem.prevSlideIndex), _lafullpage_5),
                        _lafullpage_45 = 1 === Math.abs($elem.slideIndex - $elem.prevSlideIndex),
                        is_active_menu())) {
                    for (var i = Math.min($elem.slideIndex, $elem.prevSlideIndex) + 1; i < Math.max($elem.slideIndex, $elem.prevSlideIndex); i++) {
                        setDataToSlide($(SECTION_ACTIVE_SEL).find(SLIDE_SEL).eq(i), 0, "silent")
                    }
                }
            }
        };

        _self.init = function () {
            if (win_height = $window.height(),
                    win_width = $window.width(),
                    global_bg_type = FPDataOptions.parallaxOptions.type,
                    global_bg_height = _getBgHeight(FPDataOptions.parallaxOptions.percentage),
                    global_bg_width = _getBgWidth(FPDataOptions.parallaxOptions.percentage),
                    fp_sections = document.querySelectorAll(FPDataOptions.sectionSelector),
                    global_is_property_bacbkground = "background" === FPDataOptions.parallaxOptions.property,
                    setHeightForBgElement(),
                    initEventHandler(),
                    !global_is_property_bacbkground) {
                var css_content = ".fp-bg{top:0;bottom:0;width: 100%;position:absolute;z-index: -1;-webkit-backface-visibility: hidden; backface-visibility: hidden; }.fp-section, .fp-slide, .fp-section.fp-table, .fp-slide.fp-table, .fp-section .fp-tableCell, .fp-slide .fp-tableCell {position:relative;overflow: hidden;}";
                appendCSS(P_STYLESHEET, css_content);
                insertCssForElement();
            }
            insertTransitionCSS();
            updateSectionData();
            reBuildDataForSection();
            global_has_init = true;
        };

        _self.destroy = function() {
            removeTransitionCSS();
            $(P_TRANSITION_CLASS_SEL).remove();
            global_bg_height = _getBgHeight(0);
            global_bg_width = _getBgWidth(0);
            reBuildDataForSection();
            $(BG_SEL).css({
                "height" : "",
                "transform": ""
            });
            $(WRAPPER_SEL)
                .off("setAutoScrolling")
                .off("destroy")
                .off("onScroll")
                .off("afterResponsive")
                .off("onGrab")
                .off("onContinuosHorizontal")
                .off("onContinuousVertical")
                .off("onResize");
        };

        _self.setOption = function (name, value) {
            "offset" === name ? ( FPDataOptions.parallaxOptions.percentage = value, global_bg_height = _getBgHeight(value), global_bg_width = _getBgWidth(value) ) : "type" === name && ( FPDataOptions.parallaxOptions.type = value, global_bg_type = value ), reBuildDataForSection()
        };

        _self.afterSlideLoads = function () {

            var $currentSlide = global_is_property_bacbkground ? getSlideOrSection($(SECTION_ACTIVE_SEL)) : $(SECTION_ACTIVE_SEL).find(BG_SEL);
            if ($currentSlide.removeClass("fp-bg-animate"),
                (global_resizing_status || isContinuousHorizontal) && (reBuildDataForSlide($(SECTION_ACTIVE_SEL).find(SLIDE_ACTIVE_SEL)),
                    global_resizing_status = false),
                !_lafullpage_45) {
                var _lafullpage_5 = _getBgOffsetWidth(ContinuousHorizontalStatus)
                    , _lafullpage_6 = _lafullpage_5[global_bg_type]["offsetNormal"]
                    , _lafullpage_7 = $(SECTION_ACTIVE_SEL).find(SLIDE_ACTIVE_SEL)
                    , _lafullpage_8 = ContinuousHorizontalStatus ? _lafullpage_7.nextAll() : _lafullpage_7.prevAll();
                (global_bg_type === P_REVEAL && ContinuousHorizontalStatus || global_bg_type === P_COVER && !ContinuousHorizontalStatus) && _lafullpage_8.each(function () {
                    setDataToSlide($(this), _lafullpage_6, "silent")
                })
            }
        };

        _self.afterLoad = function () {
            if(!FPDataOptions.scrollBar || !FPDataOptions.autoScrolling || FPDataInternals.usingExtension("dragAndMove")){
                if((isContinuousVertical || isContinuousHorizontal)){
                    reBuildDataForSection();
                    isContinuousVertical = false;
                    if(!global_scrolling_status && _set_const() && _self.fp_fixed()){
                        var obj_offset = _getBgOffsetHeight(onGrabStatus),
                            offset_val = obj_offset[global_bg_type]["offsetNormal"],
                            $NotActiveSections = onGrabStatus ? $(SECTION_ACTIVE_SEL).nextAll() : $(SECTION_ACTIVE_SEL).prevAll();

                        if(global_bg_type === P_REVEAL && onGrabStatus || global_bg_type === P_COVER && !onGrabStatus){
                            $NotActiveSections.each(function () {
                                setDataToSection($(this), offset_val, "silent")
                            })
                        }
                    }
                }
            }
        };

        _self.c = FPDataInternals.c;

        return "complete" === document.readyState && _self.c("parallax"), $(window).on('load', function () {_self.c("parallax") }), _self
    }
}(jQuery);