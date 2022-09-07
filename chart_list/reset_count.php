<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <title>분리수거 앱 관리자 | 수거 초기화 횟수</title>
  
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
      <h2 class="container-title">수거 초기화 횟수</h2>
      <div class="container-wr">
        <div class="contents-wr">
          <div class="search-wr flex-row gap-sm">
            <label class="text-sm">
              날짜별 검색
            </label>
            <input type="text"
            class="input-line datepicker"
            id="date-from">
            <span>-</span>
            <input type="text"
            class="input-line datepicker"
            id="date-to">
            <button type="button"
            class="btn-submit btn-sm">
              검색
            </button>
            <button type="button"
            class="btn-default btn-sm">
              엑셀 다운로드
            </button>
          </div>
          <!-- //serach-wr -->
        </div>
        <!-- //contets-wr -->
        <div class="contents-wr">
          <div class="chart-wr">
            <canvas class="chart"
            id="index-chart"></canvas>
          </div>
        </div>
        <!-- /contets-wr -->
      </div>
      <!-- //container-wr -->
    </div>
    <!-- //container -->
    
  </main>
  
<script>
  loadData()

  let labels = [];
  let values = [];

  function loadData(){
    $.ajax({
      url: "/json/chart_test.json", 
      type: "GET",                             
      dataType: "json"                         
    }).done(function(res) {
      for(let i =0; i<res.length; i++){
        labels.push(res[i].date)
        values.push(res[i].total)
      }
      makeChart(labels,values);
    })
  }

  function makeChart(labels,values){
    const ctx = document.getElementById('index-chart');

    //  moveChart Plugin
    const moveChart = {
      id:'moveChart',
      afterEvent(chart,args){
        const {ctx, canvas, chartArea:{left,right,top,bottom,width,height}}=chart;

        canvas.addEventListener('mousemove',(event)=>{
          const x = args.event.x;
          const y = args.event.y;

          if(x>=left - 15
            && x <= left + 15
            && y >= height /2 + top - 15
            && y <= height /2 + top + 15){
            canvas.style.cursor='pointer'
          }
          else if(x>=right - 15
            && x <= right + 15
            && y >= height /2 + top - 15
            && y <= height /2 + top + 15){
            canvas.style.cursor='pointer'
          }
          else{
            canvas.style.cursor='default'
          }
        })
      },
      afterDraw(chart,args,pluginOptions){
        const {ctx, chartArea:{left,right,top,bottom,width,height}} = chart;

        class CircleChevron{
          draw(ctx,x1, pixel){
            const angle = Math.PI/180;
            ctx.beginPath();
            ctx.lineWidth = 3;
            ctx.strokeStyle = 'rgba(102,102,102,0.5)'
            ctx.fillStyle = 'white';
            ctx.arc(x1,height/2 + top, 15,angle * 0,angle * 360,false)
            ctx.stroke();
            ctx.fill();
            ctx.closePath()

            // chevron Arrow Left
            ctx.beginPath();
            ctx.linewidth=3;
            ctx.strokeStyle='#7868E6';
            ctx.moveTo(x1+pixel,height/2+top-7.5);
            ctx.lineTo(x1-pixel,height/2+top);
            ctx.lineTo(x1+pixel,height/2+top+7.5);
            ctx.stroke();
            ctx.closePath()
          }
        }

        let drawCircleLeft = new CircleChevron();
        drawCircleLeft.draw(ctx,left, 5);

        let drawCircleRight = new CircleChevron();
        drawCircleRight.draw(ctx,right,-5);



        // scrollbar
        ctx.beginPath();
        ctx.fillStyle ='#ffffff';
        ctx.rect(left + 8 ,bottom + 30, width - 8, 8)
        ctx.fill();
        ctx.closePath();

        ctx.beginPath();
        ctx.fillStyle ='#333';
        ctx.rect(left ,bottom + 30,8, 8)
        ctx.fill();
        ctx.closePath();

        ctx.beginPath();
        ctx.fillStyle ='#333';
        ctx.rect(right - 8 ,bottom + 30, 8, 8)
        ctx.fill();
        ctx.closePath();

        // movable bar
        const min = chart.options.scales.x.min;
        let startingPoint = left + 8 + width / myChart.data.labels.length*min;
        const barWidth = (width-30) / myChart.data.labels.length * 7;
        const totalwidth = startingPoint + barWidth;
        if(totalwidth > width){
          startingPoint = right - 8 - barWidth;
        }

        ctx.beginPath();
        ctx.fillStyle = '#7868E6';
        ctx.rect(startingPoint,bottom+30,barWidth,8)
        ctx.fill();
        ctx.closePath()
      }
    }

    // config
    const config = {
      type: 'line',
      data: {
        labels: labels,
        datasets: [{
            label: '수거 초기화 횟수',
            data: values,
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
        layout:{
          padding:{
            right:18,
            bottom:16
          }
        },
        scales: {
          x:{
            grid:{
              display: false,
            },
            min:0,
            max:6,
            stacked:true,
          },
          y: {
            grid:{
              display: false,
            },
            beginAtZero: true,
            stacked:true,
          },
          maintainAspectRatio :false,
        }
      },
      plugins:[moveChart]
    };
    // --config

    const myChart = new Chart(ctx,config)

    function moveScroll(){
      const {ctx, canvas, chartArea:{left,right,top,bottom,width,height}} = myChart;

      myChart.canvas.addEventListener('click',(event)=>{
        const rect = canvas.getBoundingClientRect();
        const x = event.clientX - rect.left;
        const y = event.clientY - rect.top;

        // 이전
          if(x>=left - 15
            && x <= left + 15
            && y >= height /2 + top - 15
            && y <= height /2 + top + 15){

              myChart.options.scales.x.min=myChart.options.scales.x.min-7;
              myChart.options.scales.x.max=myChart.options.scales.x.max-7;
              if(myChart.options.scales.x.max <=0){
                myChart.options.scales.x.min= 0;
                myChart.options.scales.x.max= 7;
              }
          }

          // 다음
          if(x>=right - 15
            && x <= right + 15
            && y >= height /2 + top - 15
            && y <= height /2 + top + 15){

              myChart.options.scales.x.min=myChart.options.scales.x.min+7;
              myChart.options.scales.x.max=myChart.options.scales.x.max+7;
              if(myChart.options.scales.x.max > myChart.data.labels.length){
                myChart.options.scales.x.min=myChart.data.labels.length-7;
                myChart.options.scales.x.max=myChart.data.labels.length;
              }
          }
        myChart.update()
      })
    }
    myChart.ctx.onclick=moveScroll()

    function scroller(scroll,chart){

      const dataLength = myChart.data.labels.length;

      // scrollDown
      if(scroll.deltaY > 0){
        myChart.config.options.scales.x.min = myChart.config.options.scales.x.min+7;
        myChart.config.options.scales.x.max = myChart.config.options.scales.x.max+7;
        
        if(myChart.config.options.scales.x.max > dataLength){
          myChart.config.options.scales.x.min = dataLength - 7;
          myChart.config.options.scales.x.max = dataLength;
        }
      }
      else if (scroll.deltaY < 0){
        myChart.config.options.scales.x.min = myChart.config.options.scales.x.min-7;
        myChart.config.options.scales.x.max = myChart.config.options.scales.x.max-7;

        if(myChart.config.options.scales.x.min <= 0){
          myChart.config.options.scales.x.min = 0;
          myChart.config.options.scales.x.max = 6;
        }
      }
      myChart.update();
    }
    // --scroller

    myChart.canvas.addEventListener('wheel',(e) => {
        scroller(e,myChart)
      })
  }

    

</script>
  
</body>
</html>