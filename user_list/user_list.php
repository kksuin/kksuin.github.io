<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>분리수거 앱 관리자 | 사용자 목록</title>

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
      <h2 class="container-title">사용자 목록</h2>
      <div class="container-wr">
        <div class="search-wr flex-row gap-sm">
          <ion-icon name="search-outline"></ion-icon>
          <input type="text" class="input-fill"
          placeholder="검색하려는 기기 MAC 주소를 입력해주세요">
          <button type="button"
          class="btn-submit btn-sm"
          id="btn-search">
            검색
          </button>
        </div>
        

        <div class="contents-wr">
          <table class="table-list">
            <colgroup>
              <col width="4.5%">
              <col width="10%">
              <col>
              <col>
              <col>
              <col>
              <col width="5%">
              <col width="7.5%">
            </colgroup>
            <thead class="thead-list">
              <th>번호</th>
              <th>기기 MAC 주소</th>
              <th>사용자</th>
              <th>앱 접속 횟수</th>
              <th>최초 접속일시</th>
              <th>마지막 접속일시</th>
              <th>알림설정</th>
              <th>차단여부</th>
          </thead>
          <tbody id="user-list-tbody"></tbody>
          </table>
        </div>
        <!-- //contents-wr -->
        <div class="pagination-container">
          <ul class="pagination-wr"></ul>
          <ul class="search-wr">
            <input type="number"
            class="input-line"
            id="input-linkPage">
            <button type="button"
            class="btn-default btn-xs"
            id="btn-goPage">GO</button>
          </ul>
        </div>
        <!-- //pagination-container -->
      </div>
      <!-- //container-wr -->
    </div>
    <!-- //container -->
    
  </main>
  <script src="/js/paging.js"></script>

  <script>
    $('#btn-search').off('click').on('click',function(){
      _serarch()
    })

    function _search(){
      let serachValue = $('.input-fill').val();

      if(serachValue.length<1){
        alert('검색어를 입력해주세요')
      }
      else{
        makeTable(serachValue)
      }
    }
    
    function makeTable(page,res){
      $('#user-list-tbody').empty()
      for(let i=5; i>=1; i--){
        // Level2, Level1: 조회만 가능
        let _isDisabled
        if($.cookie('level')=='Level1'){
          _isDisabled = 'disabled';
        }
        html='';
        html += `
          <tr>
            <td rowspan="5" class="rowspanned">${page+res[i].id}</td>
            <td rowspan="5" class="rowspanned">${res[i].mac_addr}</td>
          </tr>`
          for(let j=0; j<4; j++){
            if(res[i].family[j].notifi==1){
              notifi = "ON"
            }
            else{
              notifi = "OFF"
            }
            html += `
              <tr colspan="6" class="tr">
              <td>${res[i].family[j].name}</td>
              <td>${res[i].family[j].count}</td>                    
              <td>${res[i].family[j].first_enter}</td>
              <td>${res[i].family[j].last_enter}</td>
              <td>${notifi}</td>
              <td>
                  <button class="btn-sm btn-default btn-delete"
                  ${_isDisabled}>
                    차단하기
                  </button>
              </td>
            </tr>
            `
          }
        $('#user-list-tbody').append(html)
      }       
    }

    function setAddClass(){
      $('tr').each(function(i,item){
        if($(this).hasClass('tr-blocked')){
          $(this).children('td button').addClass('btn-blocked')
        }
      }
     )}

     $(document).on('click','.btn-blocked',function(){
      if(confirm('해당 사용자 차단을 해제하시겠습니까?')){
        $(this).removeClass('btn-blocked');
        $(this).addClass('btn-default btn-delete')
        $(this).parents('tr').removeClass('tr-blocked')
        $(this).text('차단하기')
        alert('차단이 해제되었습니다.')
      }
     })

     $(document).on('click','.btn-delete',function(){
      if(confirm('해당 사용자를 차단하시겠습니까?')){
        $(this).addClass('btn-blocked');
        $(this).removeClass('btn-default btn-delete')
        $(this).text('차단해제')
        $(this).parents('tr').addClass('tr-blocked')
        alert('해당 사용자를 차단하였습니다.')
      }
     })
      
  </script>    
</body>
</html>