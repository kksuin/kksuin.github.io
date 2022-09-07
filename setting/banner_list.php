<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>관리자 | 배너 관리</title>

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
      <h2 class="container-title">팝업 관리</h2>

      <div class="container-wr">
        <div class="contents-wr">
          <div class="flex-row-end">
            <button type="button"
            class="btn-submit btn-sm"
            id="go_to_newpost">
              신규등록
            </button>
          </div>
        </div>
        <div class="contents-wr">
          <table class="table-list">
            <colgroup>
              <col width="6%">
              <col>
              <col width="6%">
              <col width="6%">
              <col width="6%">
            </colgroup>
            <thead class="thead-list">
              <th>번호</th>
              <th>제목</th>
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
            class="btn-default btn-xs"
            id="btn-goPage">GO</button>
          </ul>
        </div>
        <!-- //pagination-container -->
      </div>
      <!-- //container-wr -->
    <!-- //container -->
    
  </main>
  <script src="/js/post_list.js"></script>
  <script src="/js/paging.js"></script>

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
        html=''
        html += `
          <tr data-id="${res[i].id}">            
            <td class="text-sm">${res[i].id}</td>    
            <td class="text-left">${res[i].title}
            </td>
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

  </script>    
</body>
</html>