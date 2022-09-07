<nav id="gnb">
    <ul class="gnb-ul">
        <!-- dashboard -->
        <li class="gnb-li" id="nav-dashboard">
            <button type="button">
                <ion-icon name="flag"></ion-icon>
            </button>
            <div class="gnb-wrapper">
                <h3 class="lnb-title">대시보드</h3>
                <ul class="lnb-ul">
                    <li class="lnb-li"
                    data-location="index">
                        <a href="/index.php">요약</a>
                    </li>
                </ul>                
            </div>
        </li>
        <!-- userList -->
        <li class="gnb-li" id="nav-user_list">
            <button type="button">
                <ion-icon name="person"></ion-icon>
            </button>
            <div class="gnb-wrapper">
                <h3 class="lnb-title">사용자 관리</h3>
                <ul class="lnb-ul">
                    <li class="lnb-li"
                    data-location="user_list">
                        <a href="/user_list/user_list.php"
                        >사용자 목록</a>
                    </li>
                    <li class="lnb-li"
                    data-location="admin_list">
                        <a href="/user_list/admin_list.php">
                            관리자 목록</a>
                    </li>
                </ul>                
            </div>
        </li>
        <!-- noticeList -->
        <li class="gnb-li" id="nav-notice_list">
            <button type="button">
                <ion-icon name="list"></ion-icon>
            </button>
            <div class="gnb-wrapper">
                <h3 class="lnb-title">게시글관리</h3>
                <ul class="lnb-ul">
                    <li class="lnb-li"
                    data-location="notice_list">
                        <a href="/post_list/notice_list.php">공지사항 관리</a>
                    </li>
                    <li class="lnb-li"
                    data-location="faq_list">
                       <a href="/post_list/faq_list.php">자주 묻는 질문 관리</a>
                    </li>
                    <li class="lnb-li"
                    data-location="support_list">
                        <a href="/post_list/support_list.php">
                            문의 관리
                            <span class="gnb-badge">9+</span>
                        </a>
                    </li>
                </ul>                
            </div>
        </li>
        <!-- chartList -->
        <li class="gnb-li" id="nav-chart_list">
            <button type="button">
                <ion-icon name="bar-chart"></ion-icon>
            </button>
            <div class="gnb-wrapper">
                <h3 class="lnb-title">통계</h3>
                <ul class="lnb-ul">
                    <li class="lnb-li"
                    data-location="recycle_count">
                        <a href="/chart_list/recycle_count.php">
                            분리수거 횟수
                        </a>
                    </li>
                    <li class="lnb-li"
                    data-location="app_use">
                        <a href="/chart_list/app_use.php">
                            앱 접속 횟수
                        </a>
                    </li>
                    <li class="lnb-li"
                    data-location="category_change">
                        <a href="/chart_list/category_change.php">
                            목록 변경 횟수
                        </a>
                    </li>
                    <li class="lnb-li"
                    data-location="reset_count">
                        <a href="/chart_list/reset_count.php">
                            수거 초기화 횟수
                        </a>
                    </li>
                    <li class="lnb-li"
                    data-location="device_error_count">
                        <a href="/chart_list/device_error_count.php">
                            기기 연결오류 횟수
                        </a>
                    </li>
                </ul>                
            </div>
        </li>
        <!-- setting -->
        <li class="gnb-li" id="nav-setting">
            <button type="button">
                <ion-icon name="settings"></ion-icon>
            </button>
            <div class="gnb-wrapper">
                <h3 class="lnb-title">환경설정</h3>
                <ul class="lnb-ul">
                    <li class="lnb-li"
                    data-location="banner_list">
                        <a href="/setting/banner_list.php">
                            배너 관리
                        </a>
                    </li>
                    <li class="lnb-li"
                    data-location="policy_edit">
                        <a href="/setting/policy_edit.php">
                            약관 관리
                        </a>
                    </li>
                </ul>                
            </div>
        </li>
    </ul>
</nav>

<script>

    hashChk()

    //클릭이벤트
    $('.gnb-li button').off('click').on('click',function(e){
        $('.gnb-wrapper').hide();
        $('.gnb-li').removeClass('on');
        $(this).parents('.gnb-li').addClass('on');
        $(this).siblings('.gnb-wrapper').show();
    })

    // nav 페이지인식
    function hashChk(){
        let hash = $(location).attr('href').split('/').pop().split('.').shift(); 
        if(hash==""){
            hash = "index"
        }
        gnbChk(hash)
    }

    function gnbChk(hash){
        $('.gnb-li').removeClass('on');
        let lnb = $('.lnb-ul').find(`[data-location=${hash}]`);

        lnb.parents('.gnb-li').addClass('on')
        lnb.addClass('on');

        $('#page-title').text(
            $('.lnb-ul').find(`li[class="lnb-li on"]`).text()
        )
    } 

    

</script>