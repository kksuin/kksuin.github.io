<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <title>분리수거 앱 관리자 | 대시보드</title>
  
  <?php
    include $_SERVER["DOCUMENT_ROOT"]."/include/head.php"
  ?>

  <!-- chart js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.0/dist/chart.min.js"></script>
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
      <h2 class="container-title">요약</h2>
      <div class="container-wr">
        <div class="contents-wr">
          <h4 class="contents-title">최근 일주일 앱 접속 횟수</h4>
          <canvas id="index-chart" class="chart"></canvas>
        </div>
        <div class="contents-wr">
          <h4 class="contents-title">고객센터 문의 현황</h4>
          <table class="table-list">
            <colgroup>
              <col width="5%">
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
            <tbody id="support-list-tbody"></tbody>
          </table>
        </div>
      </div>
      <!-- //container-wr -->
    </div>
    <!-- //container -->
    
  </main>

  <script>

  $(function(){
    loadQna()
  })
    function loadQna(){
      $.ajax({
        url: "./json/qna_test.json", 
        type: "GET",                             
        dataType: "json"                         
      }).done(function(res) {
        makeTable(res);
      })
    }

    function makeTable(res){
      for(let i = 0; i<5; i++){
        let state;
        if(res[i].state==0){
          state = `<td class="text-primary text-sm">미답변</td>`
        }
        else if (res[i].state==1){
          state = `<td class="text-sub text-sm">답변완료</td>`
        }

        html = '';
        html += `
          <tr>
            <td class="text-sm">${i}</td>
            <td class="text-left">${res[i].category}</td>
            <td class="text-left">${res[i].title}</td>
            <td class="text-sm">${res[i].date}</td>
            <td>
              <button type="button"
              class="btn-default btn-xs"
              onclick="location.href='/post_list/support_edit.php?id=${i}'">
              조회
              </button>
            </td>
            ${state}
          </tr>
          
        `;

        $('#support-list-tbody').append(html)
      }
      
    }


    let labels = [];
    let data = [];

    loadData()

    function loadData(){
      $.ajax({
        url: "/json/chart_test.json", 
        type: "GET",                             
        dataType: "json"                         
      }).done(function(res) {
        for(let i =0; i<7; i++){
          labels.push(res[i].date)
          data.push(res[i].total)
        }
        makeChart(labels,data);
        
      })
    } 

    function makeChart(res){
      const ctx = document.getElementById('index-chart').getContext('2d');

    const myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: labels,
        datasets: [{
            label:'앱 접속 횟수',
            data: data,
            backgroundColor: [
              '#7868E6'
            ],
            borderColor: [
              '#7868E6'
            ],
            borderWidth: 1
        }]
      },
      options: {
        datalabels: {
          display: false,
        },
          scales: {
            x:{
                min:0,
                max:6
              },
            y: {
                  beginAtZero: true,
              }
          }
      }
    });
  }
    
</script>
  
</body>
</html>