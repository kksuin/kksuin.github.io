<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>분리수거 앱 관리자 | 배너 작성/수정</title>

    <?php
        include $_SERVER["DOCUMENT_ROOT"]."/include/head.php"
    ?>
    
</head>
<body>
    <!-- header -->
  <?php
    include $_SERVER["DOCUMENT_ROOT"]."/include/header.php"
  ?>
  <!-- aside -->
  <?php
    include $_SERVER["DOCUMENT_ROOT"]."/include/nav.php"
  ?>
  <main>
    <div class="container">
      <h2 class="container-title">배너 관리</h2>

      <div class="container-wr">
        <div class="contents-wr">
          <table class="table-edit">
            <colspan>
              <col width="7.5%">
              <col>
            </colspan>
          <tbody id="notice-edit-tbody">
            <tr>
              <td class="thead-edit">제목</td>
              <td>
                <input type="text"
                class="input-table"
                id="input-title"
                maxlength="30"
                placeholder="제목을 입력해주세요">
              </td>
            </tr>
            <tr>
              <td class="thead-edit">노출</td>
              <td>
                <input type="checkbox"
                id="input-view"
                class="admin-chkbox">
                <label for="input-view"></label>
              </td>
            </tr>
            <tr>
              <td class="thead-edit">파일업로드</td>
              <td>
                <input type="file"
                id="input-file"
                accept="image/jpeg, image/jpg, image/png">
                <label for="input-file"></label>
              </td>
            </tr>
          </tbody>
          </table>
        </div>
        <div class="contents-wr">
          <div class="flex-row-end">
            <button type="button"
              class="btn-default btn-sm"
              id="btn-cancel">
                취소
              </button>
              <button type="btn-link"
              class="btn-submit btn-sm"
              id="btn-submit">
                확인
            </button>
          </div>
        </div>
      </div>
      <!-- //container-wr -->
    </div>
    <!-- //container -->

    
  </main>
  
  <script src="/js/post_edit.js"></script>
  <script>
    lnb = $('.lnb-li[data-location=banner_list]')
    lnb.parents('.gnb-li').addClass('on')
    lnb.addClass('on');

    $(function(){
      const urlParams = new URL(location.href).searchParams;
      let id = urlParams.get('id');
      if(id){
        loadData()
      }
    })
 
    function loadData(){
      // 합칠 경우를 대비해서 남긴 코드
      // const urlParams = new URL(location.href).searchParams;
      // let id = urlParams.get('id');

      $.ajax({
        url: "/json/post_test.json", 
        type: "GET",                             
        dataType: "json"                         
      }).done(function(res) {
        // 더미데이터
        id = Math.floor(Math.random()*10)

        // 제목
        $('#input-title').val(res[id].desc.substring(0,30))
        
        // 노출 체크박스
        if(res[id].view==1){
          $('#input-view').prop('checked',true)
        }

        // 파일
      })
    }
    $('#btn-cancel').off('click').on('click',function(){
      if(confirm('목록으로 돌아가시겠습니까? 작성하신 내용은 삭제됩니다.')){
        location.href="/post_list/banner_list.php"
      }
    })
    // ajax 추가
    $('#btn-submit').off('click').on('click',function(){
      alert('성공적으로 등록되었습니다.')
      location.href="/post_list/banner_list.php"
    })

    function submitData(){
      alert('성공적으로 등록하였습니다.')
      location.href="/post_list/banner_list.php"
    }

      
  </script>    
</body>
</html>