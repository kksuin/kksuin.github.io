let url = "/json/chart_test.json";

$(function(){
    loadData()
})

let labels = [];
let values = [];

function loadData(){
  $.ajax({
  url: url, 
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

  const plastic = {
    label:'plastic',
    data:[10,8,6,5,12,7,12,4,5,78,95,65,4,1,2,35,7,8,5,6,9,4,5,7,7],
    backgroundColor:'#7868E6',
    borderColor:'#7868E6',
    borderWidth:1
  }
  const paper = {
      label:'paper',
      data:[5,10,5,3,4,2,,9,41,2,35,4,23,5,48,12,35,7,81,9,96,4,8,2],
      backgroundColor:'#9386EB',
      borderColor:'#9386EB',
      borderWidth:1
  }

  const can = {
      label:'can',
      data:[0,9,6,8,5,7,20,1,53,24,8,2,48,2,46,9,5,12,35,7,8,6,8,42,3,4],
      backgroundColor:'#E4E1FA',
      borderColor:'#E4E1FA',
      borderWidth:1
  }
  const pet = {
      label:'pet',
      data:[10,4,6,8,7,6,1,23,54,,2,38,95,1,24,,52,3,78,6,25,98,1,23,],
      backgroundColor:'#C9C3F5',
      borderColor:'#C9C3F5',
      borderWidth:1
  }

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

  let data;
  let chartType;
  let hash = $(location).attr('pathname').split('/').pop()
  let chartLabel = $.trim($('.lnb-li.on').text());
  
  if(hash=="recycle_count.php"){
    chartType = "bar"
    data= {
      label:'분리수거 횟수',
      labels: labels,
      datasets: [plastic, paper, can, pet]
    }
  }
  else{
    chartType = "line";
    data= {
      labels: labels,
      datasets: [{
        label: chartLabel,
        data: values,
        backgroundColor: [
          '#7868E6'
        ],
        borderColor: [
          '#7868E6'
        ],
        borderWidth: 1
      }]
    }
  }
  // config
  const config = {
    type: chartType,
    data,
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