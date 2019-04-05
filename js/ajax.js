ajaxhttp=new XMLHttpRequest();
articlesDiv=document.getElementById("articles");
userDiv=document.getElementById("userinfo");
ajaxhttp.onreadystatechange=function(){
    if (ajaxhttp.readyState==4 && ajaxhttp.status==200){
        data=JSON.parse(ajaxhttp.responseText);
        userDiv.innerHTML='<h3><i class="iconfont icon-author"></i>'+data["user"]["username"]+'</h3>';
        var output='';
        for (var i = 0; i < data["articles"].length; i++) {  
            preoutput='<div class="article" onclick="window.location.href=\'thread.html?id='+data["articles"][i]["threadid"]+'\'""><h2>'+data["articles"][i]["title"]+'</h2><h4 class="leftinfo"><i class="iconfont icon-author"></i>'+data["articles"][i]["author"]+'</h4><h4 class="rightinfo"><i class="iconfont icon-starmarkhighligh"></i>'+data["articles"][i]["stars"]+'&nbsp;<i class="iconfont icon-shijian"></i>'+data["articles"][i]["time"]+'</h4><div class="lineofarticle"></div></div>';
            output=output+preoutput;
        }
        articlesDiv.innerHTML=output;
    }
}
ajaxhttp.open("GET","./apis/indexload.php",true);
ajaxhttp.send();