<header class="header">
    <div class="flex-row-between header-container">
        <button type="button"
        class="btn-primary"
        id="btn-fold">
            <ion-icon name="caret-back"></ion-icon>
        </button>
        <a id="admin-logo"
        href="/index.php">
            administrator 
        </a>
        <div class="flex-row">
            <p class="text-sm text-bg">
                <span
                class="text-semi_medium"
                id="admin-name">
                    admin
                </span>
                님
            </p>
            <button type="button"
            class="btn-primary btn-sm"
            id="admin-logout">로그아웃</button>
        </div>
    </div>
    
</header>

<script>
    $('#admin-logout').off('click').on('click',function(){
        if(confirm('로그아웃하시겠습니까?')){
            $.removeCookie('admin',{path: '/'})
            $.removeCookie('level',{path: '/'})
            location.href="/login.php"
        }
    })

    $('#admin-name').text($.cookie('admin'))

    $('#btn-fold').off('click').on('click',function(){
        let ion = $('#btn-fold ion-icon')
        let ionName = ion.attr('name')

        ionName == "caret-back" ?
        ion.attr('name',"caret-forward") :
        ion.attr('name',"caret-back")

        $('.gnb-wrapper').toggleClass('hide')
        $('#admin-logo').toggleClass('hide')
        $('main .container').toggleClass('hide')
        
    })
</script>