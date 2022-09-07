<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>분리수거 앱 관리자 | 약관 관리</title>

    <?php
        include $_SERVER["DOCUMENT_ROOT"]."/include/head.php"
    ?>

    <!-- editor -->
    <link rel="stylesheet" href="/lib/seededitor/seededitor.min.css" />
    <script type="text/javascript" src="/lib/seededitor/seededitor.min.js"></script>
    
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
      <h2 class="container-title">약관 관리</h2>
      <div class="container-wr">
        
        <div class="contents-wr">
          <table class="table-edit">
            <colspan>
              <col width="7.5%">
              <col>
            </colspan>
            <tbody id="support-customer">
              <tr>
                <td class="thead-edit">제목</td>
                <td id="policy_title_wrap">
                  <input type="text"
                  class="input-table"
                  id="edit-title"
                  maxlength="50"
                  placeholder="제목을 입력해주세요">
                </td>
              </tr>
              <tr>
                <td class="thead-edit vertical-top">내용</td>
                <td id="policy_desc_wrap">
                  <textarea
                  id="edit-desc"
                  class="textarea-table"
                  rows="29"
                  maxlength="5000"></textarea>
                  <p class="text-right" id="text_max_length"><span id="text_length">0</span> / 5,000</p>

                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="contents-wr">
          <div class="flex-row-end">
            <button type="btn-link"
            class="btn-submit btn-sm"
            id="btn-submit">
              작성
          </button>
        </div>
        <!-- //contets-wr -->
      </div>
      <!-- //container-wr -->
    </div>
    <!-- //container -->
  </main>
  <script src="/js/post_edit.js"></script>
  <script>
    loadData()

    function loadData(){
      if($.cookie('policy_desc')){
        $('#edit-title').val($.cookie('policy_title'))
        $('#edit-desc').val($.cookie('policy_desc'))
      }

      // 레벨2일 경우
      if($.cookie('level') == "Level2"){
        $('.btn-submit').hide()

        // 제목
        $('#policy_title_wrap').empty();
        $('#policy_desc_wrap').text($.cookie('policy_title'))

        // 내용
        $('#policy_desc_wrap').empty().addClass('td-big');
        $('#policy_desc_wrap').text($.cookie('policy_desc'))
      }
    }

    $('#btn-submit').on('click',function(){
      let title = $('#edit-title').val()
      let desc = $('#edit-desc').val()
      
      if(title.length<1){
        alert('제목을 입력해주세요')
        return false;
      }
      else if(desc.length<1){
        alert('내용을 입력해주세요')
        return false;
      }
      else{
        submitData(title,desc)
      }
    })
    

    function submitData(title,desc){
      desc = desc.substring(0,180)
      $.cookie('policy_title',title);
      $.cookie('policy_desc',desc)
      
      alert('성공적으로 등록되었습니다.')
      // location.reload()
    }
  </script>    
</body>
</html>