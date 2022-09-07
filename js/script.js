$(function(){
  loadDatePicker()
  chkAdminLevel()
  getPath()
})

// url 추출
function getPath(){
  let directory = $(location).attr('pathname').split('.').shift().split('/')[1];
  let path = $(location).attr('pathname').split('.').shift().split('/').pop().split('_').shift();
  
  
  let goListUrl = `/${directory}/${path}`
  return goListUrl
}

// 관리자 권한 체크
function chkAdminLevel(){
  let loginPage = $(location).attr('href').split('/').pop().split('.').shift();      

  if($.cookie('admin') == undefined && loginPage != "login"){
    alert("로그인을 해주세요")
      location.href = '/login.php'
  }

  let level = $.cookie('level')
  // 레벨 체크 - nav 숨기기
  switch(level){
    case 'master':
      break;
    case 'Level1':
      $('.lnb-li[data-location="admin_list"').hide()
      $('#nav-notice_list').hide()
      $('#nav-chart_list').hide()
      $('#nav-setting').hide()
      break;
    case 'Level2':
      break;
    case 'Level3':
      break;
  }
  
  let path = $(location).attr('pathname').split('/').pop()
  // 에디트 페이지일 경우
  if(path.includes('edit')){
    if(path=="support_edit.php" || path == "policy_edit.php"){
      return false
    }
    else{
      switch(level){
        case 'master':
          break;
        case 'Level1':
          alert('권한이 없습니다.')
          location.href=`${goListUrl}_list.php`
          break;
        case 'Level2':
          alert('권한이 없습니다.')
          location.href=`${goListUrl}_list.php`
          break;
        case 'Level3':
          break;
      }
    }
  }
  // 리스트 페이지일 경우
  else if(path.includes('list')){
    if(path != "user_list.php"){
      switch(level){
        case 'master':
          break;
        case 'Level1':
          alert('권한이 없습니다.')
          location.back()
          break;
        case 'Level2':
          $('.btn-submit').hide();
          break;
        case 'Level3':
          break;
      }
    }
  }
}

// datepicker
function loadDatePicker(){
  if($('.datepicker').length < 1){
    return false;
  }
  else{ 
    $.datepicker.setDefaults({
      dateFormat: 'yy-mm-dd',
      showOtherMonths: true,
      showMonthAfterYear:true,
      changeYear: true,
      changeMonth: true,
      yearSuffix: "년",
      monthNamesShort: ['1','2','3','4','5','6','7','8','9','10','11','12'],
      monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
      dayNamesMin: ['일','월','화','수','목','금','토'],
      dayNames: ['일요일','월요일','화요일','수요일','목요일','금요일','토요일'],
      minDate: "-1Y",
      maxDate: "today"                  
    });
  
    $('#date-from').datepicker();
    $('#date-to').datepicker();
  
  
    $('#date-from').datepicker('setDate', '-15D');
    $('#date-to').datepicker('setDate', 'today');
  }
  
}

