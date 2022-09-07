<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>분리수거 앱 관리자 | 관리자 목록</title>

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
      <h2 class="container-title">관리자 목록</h2>
      <div class="container-wr">
        <div class="contents-wr">
          <table class="table-list">
            <colgroup>
              <col width="4%">
              <col width="7.5%">
              <col>
              <col width="10%">
              <col width="10%">
              <col width="7.5%">
              <col width="7.5%">
            </colgroup>
            <thead class="thead-list">
              <th>번호</th>
              <th>성명</th>
              <th>이메일</th>
              <th>최초 접속일시</th>
              <th>마지막 접속일시</th>
              <th>읽기</th>
              <th>수정/작성/삭제</th>
          </thead>
          <tbody id="admin-list-tbody"></tbody>
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
      <!-- //container wr -->
    </div>
    <!-- //container -->
    
  </main>
  <script src="/js/paging.js"></script>
    <script>
    
    // 테이블생성
    function makeTable(page){
      $('#admin-list-tbody').empty()

      for(let i=10; i>=1; i--){
        html='';
        html += `
          <tr>            
            <td>${page+i}</td>    
            <td>ghdrlfehd</td>
            <td class="text-left">seoreu@seoreu.com</td>
            <td>2022-01-01 10:10</td>
            <td>2022-01-01 10:10</td>
            <td class="switch-td">
              <input type="checkbox"
              id="read-${page+i}"
              data-type="read" data-id="${page+i}" 
              class="switch-chkbox read">
              <label for="read-${page+i}" class="switch-label">
                <span class="switch-btn"></span>
              </label>
            </td>
            <td class="switch-td">
              <input type="checkbox"
              id="delete-${page+i}"
              data-type="del" data-id="${page+i}"
              class="switch-chkbox delete">
              <label for="delete-${page+i}"  class="switch-label">
                <span class="switch-btn"></span>
              </label>
            </td>
          </tr>
        `
        $('#admin-list-tbody').append(html)
      } 
    }

    $(document).on('click','.switch-chkbox',function(e){
      let type = $(this).attr('data-type')
      let admin_id = $(this).attr('data-id')
      let state; 

      if($.cookie('level')=="Level2"){
        alert('권한이 없습니다.')
        return false;
      }
      if(e.target.checked){
        state = "true";
      }
      else{
        state = "false"
      }
    
    })
    
    </script>
</body>

</html>