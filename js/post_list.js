// goEditUrl 추출 (각 에디터로 들어가기)

let goEditUrl;
function getPath(){
  let path = $(location).attr('pathname').split('.').shift().split('/').pop().split('_').shift();

  let directory = $(location).attr('pathname').split('.').shift().split('/')[1];

  goEditUrl = `/${directory}/${path}`

  return goEditUrl
}
getPath()


// 테이블 상단 버튼 이벤트
$('.btn-submit').on('click',function(){
  location.href=`${goEditUrl}_edit.php`
})

// 게시글 수정 클릭
$(document).on('click','td .edit',function(){
  let dataId =$(this).parents('tr').attr('data-id');
  location.href=`${goEditUrl}_edit.php?id=${dataId}`
})

// 게시글 삭제
$(document).on('click','td .delete',function(){
  let dataId =$(this).parents('tr').attr('data-id');
  if(confirm(`게시글 ${dataId}번을 정말 삭제하시겠습니까?`)){
    alert('정상적으로 삭제하였습니다')
    $(this).parents('tr').remove()
  }
})
