<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <title>분리수거 앱 관리자 | 목록 변경 횟수</title>

  
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
      <h2 class="container-title">목록 변경 횟수</h2>
      <div class="container-wr">
        <div class="contents-wr">
          <div class="chart-wr">
            <canvas
              class="chart"
              id="index-chart">
            </canvas>
          </div>
          <!-- //chart-wr -->
      </div>
      <!-- /contents-wr -->
    </div>
    <!-- //container-wr -->
  </div>
  <!-- //container -->
  
  </main>

  <script>

    loadData()

    function loadData(){
      $.ajax({
        url: "/json/chart_test.json", 
        type: "GET",                             
        dataType: "json"                         
      }).done(function(res) {
        makeChart(res);
      })
    }

    function makeChart(res){
      const label = ['plastic', 'can', 'pet', 'paper']
      const data = [10,20,16,24]
      const backgroundColor = ['#7868E6','#9386EB','#E4E1FA','#C9C3F5',]
      const ctx = document.getElementById('index-chart').getContext('2d');
      const config = {
        type: 'doughnut',
        data: {
          labels: label,
          datasets: [{
            label:'# of Votes',
            data:data,
            backgroundColor:backgroundColor
          }]
        },
        options: {
          scales: {
            y: {
                beginAtZero: true,
                display:false,
            }
          }
        }
      };

      const myChart = new Chart(ctx, config)
    }
    
</script>
  
</body>
</html>