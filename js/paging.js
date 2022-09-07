$(function(){
    if($(location).attr('pathname').includes('user_list')){
        url = '/json/user_test.json';
    }
    else if($(location).attr('pathname').includes('list') && $(location).attr('pathname').includes('user_list')==false){
        url = '/json/qna_test.json';
    }
    else{
        url = '/json/chart_test.json';
    }
    let anchor =  $(location).attr('hash').replace('#','')
    if(anchor == "" || anchor == undefined || anchor == null){
        loadData(1,url)
    }
})

function loadData(page,url){
    $.ajax({
        url: url, 
        type: "GET",                             
        dataType: "json"                         
    }).done(function(res) {
        if(url = '/json/user_test.json'){
            url = '/json/user_test.json';
            getPageNumber(page,res)
        }
        else{
            res = Object.keys(res).map((key) => [String(key), res[key]]);
            getPageNumber(page,res)
        }
    })
}

function getPageNumber(page,res){
    makePages(page,res)
    makeTable(page,res)
}

function makePages(page,res){
    page = Number(page)

    /*
        전체 페이지: res 값 / 5 올림
        첫 페이지: res 값 / 5 올림 - 2 (단, 첫 페이지가 0 이하일 경우 1로 고정)
        마지막 페이지: res 값 / 5 올림 + 2 (단, 마지막 페이지가 5 미만일 경우 마지막 페이지 = 전체 페이지)
    */
    let totalPage = Math.ceil(res.length / 5);
    let firstPage = Math.ceil(res.length / 5) - 2;
    let lastPage = Math.ceil(res.length / 5) + 2;

    if(firstPage <= 0){
        firstPage = 1;
    }
    if(lastPage > totalPage){
        lastPage = totalPage
    }

    $('.pagination-wr').empty()
    
    let list = '';
    list += `<li id="btn-backPage">
                <a>
                    <ion-icon name="chevron-back"></ion-icon>  
                </a>                
            </li>`
    for(let i=firstPage; i<=lastPage; i++){
        if( i == page){
            list += `<li class="on">
                    <a href="#${i}"
                    >${i}</a>
                </li>`
        }
        else{
            list += `<li>
                    <a href="#${i}">${i}</a>
                </li>`
        }
    }    
    list += `<li class="not-link">
            <a class="not-link">
                <ion-icon name="ellipsis-horizontal"></ion-icon>
            </a>            
        </li>
        <li>
            <a>${totalPage}</a>
        </li>
        <li id="btn-goForward">
            <a>
                <ion-icon name="chevron-forward"></ion-icon>  
            </a>                
        </li>`
    $('.pagination-wr').append(list)
}

$('#btn-goPage').on('click',function(){
    let toGoPage = $('#input-linkPage').val();

    if(toGoPage.length<1){
        alert('페이지를 입력해주세요.')
        return false;
    }
    else{
        let pathname = $(location).attr('pathname');
        let hash = '#'+toGoPage

        location.assign(pathname+hash)
        makePages(toGoPage,res)
        makeTable(toGoPage,res)
    }
})

//페이지네이션 onoff
$(document).on('click','.pagination-wr li', function(e){
    e.preventDefault()
    
    let anchor = Number($(location).attr('hash').replace('#',''))
    let clickedPage = $.trim($(this).text())

    if($(this).attr('id')=="btn-goForward"){
        getPageNumber(anchor+1)
    }
    else if ($(this).attr('id')=="btn-backPage"){
        getPageNumber(anchor-1)
    }
    else{
        $('.pagination-wr li').removeClass('on')
        $(this).addClass('on')
    }
    
    loadData(clickedPage,url)
})
