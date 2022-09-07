<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>분리수거 앱 관리자 | 공지사항 작성/수정</title>

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
      <h2 class="container-title">공지사항 관리</h2>

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
                id="edit-title"
                maxlength="30"
                placeholder="제목을 입력해주세요">
              </td>
            </tr>
            <tr>
              <td class="thead-edit">상단고정</td>
              <td>
              <input type="checkbox"
                id="input-fix"
                class="admin-chkbox">
                <label for="input-fix"></label>
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
              <td class="thead-edit vertical-top">내용</td>
              <td class="">
                <textarea
                id="edit-desc"
                class="textarea-table"
                rows="10"
                maxlength="1000"></textarea>
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
    lnb = $('.lnb-li[data-location=notice_list]')
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
        useSmartEditor(res,id)
      })
    }

    // smartEditor
  function useSmartEditor(res,id){
    var oEditors = [];
    nhn.husky.EZCreator.createInIFrame({
    oAppRef: oEditors,
    elPlaceHolder: "edit-desc",
    sSkinURI: "/lib/smarteditor2/workspace/static/SmartEditor2Skin.html",
    fCreator: "createSEditor2",
    htParams : {
        // 툴바 사용 여부 (true:사용/ false:사용하지 않음)
        bUseToolbar: true,             
        // 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
        bUseVerticalResizer: true,    
        //  모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
        bUseModeChanger: false,
      }, 
      fOnAppLoad : function(){
        // Editor 에 값 셋팅
        oEditors.getById["edit-desc"].exec("PASTE_HTML", [res[id].desc]);
      },
    });

  // 스마트에디터 글자수 (1,000자 고정)
  setTimeout(function() {
		let smartEditorArea = document.querySelector("iframe").contentWindow.document.querySelector("iframe").contentWindow.document.querySelector(".se2_inputarea");

    document.querySelector("#text_length").innerHTML = smartEditorArea.innerText.length;

		smartEditorArea.addEventListener("keyup", function(e) {
			let text = this.innerText;
      let len = text.length;
			document.querySelector("#text_length").innerHTML = len;
			
			if(len >= 1000) {
        if($('text_max_length').css('color') != 'red'){
          $('#text_max_length').css({'color':'red'});
        }
			}
      else{
        $('#text_max_length').css({'color':'inherit'});
      }
		});	
	}, 1000)   
}
      
  </script>    
</body>
</html>