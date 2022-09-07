$(function(){
    getScrollTop()
    createScrollTop()
    
})

let headerHeight = $('.header').height();

$(window).on('scroll', function(event){
    createScrollTop()

    if (event.originalEvent.wheelDelta > 0 || event.originalEvent.detail < 0) {
        // scroll up
        return false;
    }
    else {
        // scroll down
        $('.header').addClass('scrolled')
        
    }
    getScrollTop()
});

function createScrollTop(){
    if(document.documentElement.scrollTop>$(window).height()){
        $('#btn-top').fadeIn(200);
    }
    else{
        $('#btn-top').fadeOut(200);
    }
}


function getScrollTop(){
    let scrollTop = document.documentElement.scrollTop;
    let url = $(location).attr('pathname')

    // INDEX (첫페이지)일 경우
    if(url == "/" || url == "/index.html"){
        $('.header').removeClass('sub').addClass('white');
    }
    // 서브페이지 (2DEPTH~) 일 경우
    else{
        $('.header').addClass('sub');

        // 서브 페이지 배경화면 영역으로 들어간 경우
        if(scrollTop>=headerHeight){
            // console.log('scrollTop>headerHeight')
            $('.header').addClass('scrolled').addClass('white')

            let subHeaderBg = $('.sub-header__bg');
           
            // 서브페이지 배경 이미지가 있는 경우
            if(subHeaderBg.length>0){
                changeHeaderImg(subHeaderBg)
            }
        }
        else{
            // console.log('else')
            changeHeaderImg()
        }
    }
        
    
}

function changeHeaderImg(subHeaderBg){
    let subNav = $('.sub-header__tab-wrap')
    // 스크롤탑이 헤더 높이보다 내려갔으면 (영상/이미지 구간이면) 로고를 흰색으로 변경
    if ($(window).scrollTop() >= headerHeight) {
        $('.header').addClass('white');
        $('.header__logo-img').attr('src','./img/logo-white.png');

        // 이미지(영상) 구간을 넘긴 경우 로고를 블랙(기본) 변경 + 서브 페이지 내비게이션 고정
        if ( $(window).scrollTop() > subHeaderBg.height() ){
            $('.header').removeClass('white');
            $('.header__logo-img').attr('src','/img/logo.png');
            subNav.addClass('fixed').addClass('scrolled')
        }
        else{
            subNav.removeClass('fixed').addClass('scrolled')
        }
    }
    // 스크롤탑이 헤더 높이보다 높음
    else{
        $('.header').removeClass('white');
        $('.header__logo-img').attr('src','/img/logo.png')
    }
}

