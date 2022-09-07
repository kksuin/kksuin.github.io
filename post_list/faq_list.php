<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>분리수거 앱 관리자 | 자주 묻는 질문 목록</title>

    <?php
        include $_SERVER["DOCUMENT_ROOT"]."/include/head.php"
    ?>

    <!-- 페이지네이션 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.5/pagination.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.5/pagination.css">
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
        <div class="flex-row-end">
            <button type="btn-link"
            class="btn-submit btn-sm"
            id="go_to_newpost">
              신규등록
            </button>
          </div>
        </div>
        <div class="contents-wr">
          <table class="table-list">
            <colgroup>
              <col width="4%">
              <col width="7.5%">
              <col>
              <col>
              <col width="10%">
              <col width="7.5%">
              <col width="5%">
              <col width="7.5%">
              <col width="7.5%">
            </colgroup>
            <thead class="thead-list">
              <th>번호</th>
              <th>항목</th>
              <th>제목</th>
              <th>답변</th>
              <th>작성일</th>
              <th>조회수</th>
              <th>노출</th>
              <th>게시글 수정</th>
              <th>게시글 삭제</th>
          </thead>
          <tbody id="user-list-tbody"></tbody>
          </table>
        </div>
        <!-- //contents-wr -->
        <div class="pagination-container">
          <ul class="pagination-wr"></ul>
          <ul class="search-wr">
            <input type="number"
            class="input-line">
            <button type="button"
            class="btn-default btn-xs">GO</button>
          </ul>
        </div>
        <!-- //pagination-container -->
      </div>
      <!-- //container-wr -->
    </div>
    <!-- //container -->
  </main>
  <script src="/js/paging.js"></script>
  <script src="/js/post_list.js"></script>
  <script>
    
    // 테이블생성
    function makeTable(page,res){
      $('#user-list-tbody').empty()

      for(let i=10; i>=1; i--){
        // Level2: 조회만 가능
        let _isDisabled
        if($.cookie('level')=='Level2'){
          _isDisabled = 'disabled';
        }
        // 알림 상태
        let state;
        if(res[i].state==0){
          state=`<td class="text-sm">OFF</td>`
        }
        else{
          state=`<td class="text-primary text-sm">ON</td>`
        }

        let view
        if(res[i].view>1000){
          view = addComma(res[i].view)
        }
        else{
          view = res[i].view
        }
        html='';
        html += `
        <tr data-id="${res[i].id}">            
            <td class="text-sm">${res[i].id}</td>    
            <td>기기</td>
            <td class="text-left ellipsis-1">${res[i].title}</td>
            <td class="text-left ellipsis-1">답변내용미리보기는최대한줄까지보입니다답변내용미리보기는최대한줄까지보입니다답변내용미리보기는최대한줄까지보입니다</td>
            <td class="text-sm">${res[i].date}</td>
            <td class="text-sm">${view}</td>
            ${state}
            <td>
              <button type="button"
              class="btn-default btn-xs edit"
              ${_isDisabled}>
                수정
              </button>
            </td>
            <td>
              <button type="button"
              class="btn-default btn-delete btn-xs delete"
              ${_isDisabled}>
                삭제
              </button>
            </td>
          </tr>
        `
        $('#user-list-tbody').append(html)
      } 
    }

    // 천자리 콤마 
    function addComma(num){
      var regexp = /\B(?=(\d{3})+(?!\d))/g;
      return num.toString().replace(regexp, ',');
    }

  </script>    
</body>
</html>