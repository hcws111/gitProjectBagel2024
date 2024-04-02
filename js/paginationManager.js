var pm_dataSrc = [];
var pm_dataItem=[];
var pm_show_num = 10;
var pl_total=0;
var pl_nowIdx=0;  


$("#pm_pageList").on("click", "#pl_prev", function () {        
      if(pl_nowIdx>0)                
          drawTable(pl_nowIdx-1);       
  });

  
  $("#pm_pageList").on("click", "#pl_next", function () {   
      if(pl_nowIdx<pl_total-1)            
          drawTable(pl_nowIdx+1);                
  });

  function pm_setShowDataNum(num){
    pm_show_num = num;
  }


  function pm_drawPageList(key){
    var data = pm_dataSrc[key];

   
    data.forEach(function(item, key){
        if(key % pm_show_num ==0){
            pm_dataItem.push([]);
            pl_total++;
        }
        var page = parseInt(key/pm_show_num);
        pm_dataItem[page].push(item);
     });

    //  console.log("--pm_dataItem--");
    //  console.log(pm_dataItem);


    // 產生頁碼
    $("#pm_pageList").empty();
    var prev = '<li class="page-item disabled" id="pl_prev"><span class="page-link">前一頁</span></li>';
    $("#pm_pageList").append(prev);
    pm_dataItem.forEach(function(item, key){
        var thisPage= key+1;
        var strHtml = '<li class="page-item" data-key="'+key+'"><a class="page-link" id="pl_link_'+key+'" href="#" onclick="drawTable('+key+')">'+thisPage+'</a></li>';
        $("#pm_pageList").append(strHtml);
    });
    var next = '<li class="page-item" id="pl_next"><a class="page-link" href="#">下一頁</a></li>';
    $("#pm_pageList").append(next);
    drawTable(pl_nowIdx);
}

function pm_resetData(){
    // 清空狀態
    pm_dataItem.forEach(function(item, idx){
        while(item.length > 0) {
            pm_dataItem[idx].pop();
        }
    });
    pm_dataItem=[];
    pl_total = 0;
    pl_nowIdx = 0;
}

function drawTable(page){

    $('.page-link.active').removeClass('active');

    // 顯示當前分頁
    var pageId = "#pl_link_"+page;
    $(pageId).addClass("active"); 

    pl_nowIdx = page;
    $("#pl_prev").removeClass("disabled");
    $("#pl_next").removeClass("disabled");
    if(page==0)
        $("#pl_prev").addClass("disabled");

    if(page == (pl_total-1))
        $("#pl_next").addClass("disabled");

    var data = pm_dataItem[page];

    pm_callback(data);
    
}