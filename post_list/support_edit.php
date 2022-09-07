<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>분리수거 앱 관리자 | 문의관리 등록/수정</title>
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
      <h2 class="container-title">문의 관리</h2>
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
                <td id="customer_title"></td>
              </tr>
              <tr>
                <td class="thead-edit">이메일</td>
                <td id="customer_mail"></td>
              </tr>
              <tr>
                <td class="thead-edit">문의내용</td>
                <td class="td-big" id="customer_desc"></td>
              </tr>
              <tr>
                <td class="thead-edit">첨부파일</td>
                <td id="customer_file">없음</td>
              </tr>
            </tbody>
          </table>
          <table class="table-edit">
            <colspan>
              <col width="7.5%">
              <col>
            </colspan>
            <tbody id="support-admin">
              <tr>
                <td class="thead-edit vertical-top">답변내용</td>
                <td id="admin_answer_wrap">
                  <!-- <div id="editorjs"></div> -->
                  <textarea class="textarea-table"
                  rows="10"
                  maxlength="5000"
                  placeholder="아직 작성된 답변이 없습니다."
                  id="support_answer"></textarea>
                  <p class="text-right" id="text_max_length"><span id="text_length">0</span> / 5,000</p>
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
              메일 발송하기
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
    // nav setting
    lnb = $('.lnb-li[data-location=support_list]')
    lnb.parents('.gnb-li').addClass('on')
    lnb.addClass('on');

    /* 
      
    */

    let urlSearch = new URLSearchParams(location.search)
    let post_id = urlSearch.get('id')

    function loadData(){
      $.ajax({
        url: "/json/post_test.json", 
        type: "GET",                             
        dataType: "json"                         
      }).done(function(res) {
        // 더미데이터
        id = Math.floor(Math.random()*10)
        // 제목
        $('#customer_title').text(res[id].category)
        // 이메일
        $('#customer_mail').text(res[id].mail)
        // 문의내용
        $('#customer_desc').text(res[id].desc)

        // 전송한 경우
        if($.cookie('submited') && $.cookie('post_id') == post_id){
          // 버튼 변경
          $('#btn-submit').hide();
          $('#btn-cancel').text('목록');
          // textarea 삭제 후 td class 추가
          $('#admin_answer_wrap').empty().addClass('td-big')
          // td 내용 추가
          $('#admin_answer_wrap').text($.cookie('submited_answer'))
        }
        // 전송 안한 경우
        else{
          if($.cookie('level') == 'Level2' || $.cookie('level') == 'Level1'){
            alert('권한이 없습니다.')
            location.href='/post_list/support_list.php'
          }
        }

      })
    }

    loadData();

    // ajax 추가
     $('#btn-submit').off('click').on('click',function(){
      const desc = $('#support_answer').val()
      if(desc.length < 1){
        alert('답변 내용을 작성해주세요')
        return false;
      }
      else if(desc.length > 5000){
        alert('답변은 5,000자 이내로 작성해주세요')
        return false;
      }
      else{
        if(confirm('메일을 발송하시겠습니까? 답변내용이 올바르게 작성되었는지 한번 더 확인해주세요.')){
          submitData(desc,post_id)
        }
      }
    })

    
    function submitData(desc,post_id){
      console.log(post_id)
      alert('성공적으로 등록하였습니다.')
      location.href="/post_list/support_list.php"

      // ajax 연결 후 지워주세요
      $.cookie('submited',true);
      $.cookie('submited_answer',desc)
      $.cookie('post_id',post_id)
    }
    
    </script>    

   
      
</body>
</html>