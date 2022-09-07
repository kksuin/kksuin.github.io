<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>분리수거 앱 관리자 | 로그인</title>

    <?php
        include $_SERVER["DOCUMENT_ROOT"]."/include/head.php"
    ?>
</head>
<body>
    <div class="container flex-col login">
        <h1 class="title login">관리자 로그인</h1>
        <form class="flex-col gap-lg" id="form-login">
            <div class="flex-col">
                <div class="flex-col-start gap-sm">
                    <label for="admin-mail">이메일</label>
                    <input type="email"
                    class="input-line"
                    id="admin-mail" require>
                </div>
                <div class="flex-col-start gap-sm">
                    <label for="admin-pwd">비밀번호</label>
                    <div class="pos-relative">
                        <input type="password"
                        class="input-line"
                        id="admin-pwd" require>
                        <ion-icon name="eye-outline"
                        id="toggle-pwd"></ion-icon>
                    </div>
                </div>
            </div>
            <button type="button"
            class="btn-primary"
            id="admin-login">
                로그인
            </button>
        </form>        
    </div>
    
</body>

<script>
    
    $(function(){
        pageLoginChk()
    })
    function pageLoginChk(){
        if($.cookie('admin') != undefined){
            alert('이미 로그인 된 계정입니다. 로그아웃 후 진행해주세요.')
            // location.href='index.php';
        }
    }
    $('#admin-mail').on('keyup',function(key){
        let mail = $('#admin-mail').val();
        let pwd = $('#admin-pwd').val();

        if(key.keyCode==13){
            adminLogin(mail,pwd)
        }
    })

    $('#admin-pwd').on('keyup',function(key){
        let mail = $('#admin-mail').val();
        let pwd = $('#admin-pwd').val();

        if(key.keyCode==13){
            adminLogin(mail,pwd)
        }
    })
    
    $('#admin-login').off('click').on('click', function(){
        let mail = $('#admin-mail').val();
        let pwd = $('#admin-pwd').val();

        adminLogin(mail,pwd)
    })

    function adminLogin(mail,pwd){
        const regex = /\d*[A-Za-z0-9_\.\-]*[@](seoreu.com)/g;

        if(mail.length<1){
            alert('메일을 입력해주세요')
        }
        else if(!regex.test(mail)){
            alert('이메일을 정확하게 입력해주세요')
        }
        else if(pwd.length<1){
            alert('비밀번호를 입력해주세요')
        }
        else{
            loginChk(mail,pwd)
        }
    }

    // ajax 넣어야함    
    function loginChk(mail,pwd){
        let demoMailArr = ["seoreu@seoreu.com","level1@seoreu.com","level2@seoreu.com","level3@seoreu.com"]
        let demoPwd = "sr0302";

        if(demoMailArr.includes(mail)==false
        || pwd != demoPwd){
            alert(`아이디 또는 비밀번호를 확인해주세요`);
        }
        else{
            $.cookie('admin',mail,{
                path:'/',
                expires:30,
            });
            if(mail=="seoreu@seoreu.com"){
                $.cookie('level','master',{
                    path:'/',
                    expires:30,
                })
            }
            else if(mail=="level1@seoreu.com"){
                $.cookie('level','Level1',{
                    path:'/',
                    expires:30,
                })
            }
            else if(mail=="level2@seoreu.com"){
                $.cookie('level','Level2',{
                    path:'/',
                    expires:30,
                })
            }
            else if(mail=="level3@seoreu.com"){
                $.cookie('level','Level3',{
                    path:'/',
                    expires:30,
                })
            }
            alert(`반갑습니다 ${mail}님`);
            location.href="/index.php"
        }

    }

    $('#toggle-pwd').off('click').on('click',function(){
        if($('#admin-pwd').prop('type')=="password"){
            $('#admin-pwd').prop('type','text');
            $('#toggle-pwd').prop('name','eye-off-outline');
        }
        else{
            $('#admin-pwd').prop('type','password');
            $('#toggle-pwd').prop('name','eye-outline');
        }
    })
</script>
</html>