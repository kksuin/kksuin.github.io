$(function(){
  loadData()
})
function loadData(){
  $.ajax({
    url: "/json/post_test.json", 
    type: "GET",                             
    dataType: "json"                         
  }).done(function(res) {
    // 더미데이터
    const id = Math.floor(Math.random()*10)
    $('#post_desc').text(res[id].desc)
  })
}
