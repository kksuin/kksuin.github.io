<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>분리수거 앱 관리자 | 문의 관리 목록</title>

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
      <h2 class="container-title">문의 관리</h2>
      <div class="container-wr">
        <div class="contents-wr">
          <table class="table-list">
            <colgroup>
              <col width="4%">
              <col width="7.5%">
              <col>
              <col width="10%">
              <col width="7.5%">
              <col width="7.5%">
            </colgroup>
            <thead class="thead-list">
              <th>번호</th>
              <th>문의유형</th>
              <th>내용</th>
              <th>작성일</th>
              <th>상세보기</th>
              <th>상태</th>
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
  <script src="/js/post_list.js"></script>
  <script src="/js/paging.js"></script>

  <script>

    // 테이블생성
    function makeTable(page,res){
      $('#user-list-tbody').empty()
      for(let i=10; i>=1; i--){
        html='';

        let state;
        if(res[i].state==0){
          state = `<td class="text-primary text-sm">미답변</td>`
        }
        else{
          state = `<td class="text-sub text-sm">답변완료</td>`
        }
        
        html += `
        <tr>            
            <td class="text-sm">${page+i}</td>    
            <td>${res[i].category}</td>
            <td class="text-left ellipsis-1">${res[i].title}</td>
            <td class="text-sm">${res[i].date}</td>
            <td>
              <button type="button"
              class="btn-default btn-xs"
              onclick="location.href='/post_list/support_edit.php?id=${page+i}'">상세보기</button>
            </td>
            ${state}            
          </tr>
        `
        $('#user-list-tbody').append(html)
      }
    }

      
  </script>    
</body>
</html>