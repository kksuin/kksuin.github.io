<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>분리수거 앱 관리자 | 자주 묻는 질문 작성/수정</title>

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
      <h2 class="container-title">자주 묻는 질문 관리</h2>

      <div class="container-wr">
        
        <div class="contents-wr">
          <table class="table-edit">
            <colspan>
              <col width="7.5%">
              <col>
            </colspan>
            <tbody id="notice-edit-tbody">
              <tr>
                <td class="thead-edit">항목</td>
                <td>
                  <select class="input-line"
                  id="edit-select">
                    <option value="machine">기기 고장</option>
                    <option value="app">앱 오류</option>
                    <option value="complain">건의사항</option>
                    <option value="others">기타</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td class="thead-edit">상단고정</td>
                <td>
                  <input type="checkbox"
                  class="admin-chkbox"
                  id="input-fix">
                  <label for="input-fix"></label>

                </td>
              </tr>
              <tr>
                <td class="thead-edit">노출</td>
                <td>
                  <input type="checkbox"
                  class="admin-chkbox"
                  id="input-view">
                  <label for="input-view"></label>
                </td>
              </tr>
              <tr>
                <td class="thead-edit vertical-top"> 질문</td>
                <td>
                  <input type="text"
                  class="input-table"
                  id="edit-title"
                  maxlength="30"
                  placeholder="질문을 입력해주세요"
                  require>
                </td>
              </tr>
              <tr>
                <td class="thead-edit vertical-top">내용</td>
                <td class="">
                  <textarea
                  id="edit-desc"
                  class="textarea-table"
                  rows="10"
                  maxlength="1000"
                  require></textarea>
                  <p class="text-right" id="text_max_length"><span id="text_length">0</span> / 1,000</p>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="contents-wr">
          <div class="flex-row-end">
            <button type="button"
              class="btn-default btn-sm">
                취소
              </button>
              <button type="btn-link"
              class="btn-submit btn-sm">
                저장
            </button>
          </div>
          
        </div>
      </div>
      <!-- //container-wr -->
    </div>
    <!-- //container -->
    
    
  </main>
  <!-- smartEditor2 -->
  <script src="/lib/smarteditor2/workspace/static/js/service/HuskyEZCreator.js"></script>
  <script src="/js/post_edit.js"></script>
  <script>
    lnb = $('.lnb-li[data-location=faq_list]')
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

      $.ajax({
        url: "/json/post_test.json", 
        type: "GET",                             
        dataType: "json"                         
      }).done(function(res) {
        // 더미데이터
        id = Math.floor(Math.random()*10)

        let selectOption;
        switch(res[id].category){
          case '기기 고장':
            selectOption = "machine";
            break;
          case '앱 오류':
            selectOption = "app";
            break;
          case '건의사항':
            selectOption = "complain";
            break;
          case '기타':
            selectOption = "others";
            break;
        }
        // 항목
        console.log(selectOption)
        $('#edit-select').val(selectOption)

        // 제목
        $('#edit-title').val(res[id].desc.substring(0,30))
        
        // 상단고정 체크박스
        if(res[id].fix==1){
          $('#input-fix').prop('checked',true)
        }

        // 노출 체크박스
        if(res[id].view==1){
          $('#input-view').prop('checked',true)
        }

        // 내용
        $('#edit-desc').val(res[id].desc)
      })
    }
      
  </script>    
</body>
</html>