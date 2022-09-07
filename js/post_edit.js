// 버튼 단어 추출
function buttonTextExport(button){
  buttonText = $.trim(button.text())
  return buttonText
}



// goListUrl 추출 (각 에디터의 목록으로 돌아가기)
let goListUrl;
function getPath(){
  let directory = $(location).attr('pathname').split('.').shift().split('/')[1];
  let path = $(location).attr('pathname').split('.').shift().split('/').pop().split('_').shift();
  
  
  goListUrl = `/${directory}/${path}`
  return goListUrl
}

getPath()

// 취소 (또는 목록)을 클릭한 경우
$('.btn-default').off('click').on('click',function(){
  buttonTextExport($('.btn-default'))

  if(buttonText == "목록"){
    location.href=`${goListUrl}_list.php`
  }
  else if(buttonText=="취소"){
    if(confirm('작성하신 내용은 삭제됩니다.')){
      location.href=`${goListUrl}_list.php`
    }
  }
})

// 글자수초과이벤트 - textarea
function chkTextLength(){
  // 글자숫 세는 html 있는지 확인
  if($('#text_max_length').length > 0){
    if($('#text_max_length').siblings('textarea').val().length > 0){
      $("#text_length").text($('textarea').val().length);
    }
    else if($('#text_max_length').siblings('textarea').val().length > 0){
      $("#text_length").text($('input').val().length);
    }
  }
}

// setTiemout으로 ajax 연동 후 갱신
setTimeout(chkTextLength, 500);

// 글자수초과이벤트 - input
$("input").keyup(function () {
  // 입력한 값이 최대 입력 가능보다 클 경우
  if (this.value.length >= this.maxLength) {
    // 경고 태그 생성
    if($(this).siblings('.tag-error').length <1){
      html='';
      html+=`<span class="tag-error"><ion-icon name="warning-outline"></ion-icon>최대 ${this.maxLength}자까지 작성 가능합니다.</span>`
      $(this).after(html)
      
      return false;
    }
  }
  // 입력한 값이줄어들 경우 태그 삭제
  else if($(this).siblings('.tag-error').length>0){
    $('.tag-error').remove()
  }
});

$("textarea").keyup(function () {
  let text = this.value
  $("#text_length").text(this.value.length);
  // 입력한 값이 최대 설정 값보다 크면
  if (text.length >= this.maxLength) {
      $('#text_max_length').css({'color':'red'});
      $(this).css({'border':'1px solid red'})
  }
});

