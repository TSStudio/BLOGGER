function getQueryVariable(variable)
{
       var query = window.location.search.substring(1);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){return pair[1];}
       }
       return(false);
}
ajaxhttp=new XMLHttpRequest();
userDiv=document.getElementById("userinfo");
authorDiv=document.getElementById("authorPlace");
timeDiv=document.getElementById("timePlace");
starDiv=document.getElementById("starPlace");
contentDiv=document.getElementById("contentarti");
titleDiv=document.getElementById("artitle");
ajaxhttp.onreadystatechange=function(){
    if (ajaxhttp.readyState==4 && ajaxhttp.status==200){
        data=JSON.parse(ajaxhttp.responseText);
        authorDiv.innerText=data["author"];
        timeDiv.innerHTML='<i class="iconfont icon-shijian"></i>'+data["time"];
        starDiv.innerHTML='<i class="iconfont icon-starmarkhighligh"></i>'+data["stars"];
        authorDiv.innerText=data["author"];
        userDiv.innerHTML='<h3><i class="iconfont icon-author"></i>'+data["username"]+'</h3>';
        contentDiv.innerHTML=data["content"];
        titleDiv.innerText=data["title"];
    }
}
ajaxhttp.open("GET","./apis/getcontent.php?threadid="+getQueryVariable("id"),true);
ajaxhttp.send();