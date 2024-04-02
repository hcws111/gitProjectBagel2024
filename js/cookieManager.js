function checkCookieUser(name)
{
    let pathOrg = location.href;

    const myArray = pathOrg.split("/");
    // console.log("--checkCookieUser--");
    // console.log(pathOrg);
    // console.log(myArray);
    var pathAPI = myArray[0]+"//"+myArray[2]+"/"+myArray[3]+"/api/front/member/f_member_check_cookie_api.php";
    // console.log(pathAPI);

    if(getCookie(name)!=""){
        // UID01存在, 傳遞至後端api判斷是否合法
        var dataJSONCookie={};
        dataJSONCookie["UIDMP"] = getCookie(name);
        // console.log(JSON.stringify(dataJSONCookie));
        $.ajax({
            type:"POST",
            url:pathAPI,
            data: JSON.stringify(dataJSONCookie),   
            dataType:"json",    
            async:false,         
            success:function(data){
                checkCookieUser_callback(data);
            },
            error:function(){
                alert("error: f_member_check_cookie_api.php");
            }
        }); 
    }
}


function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    let expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
        c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
        }
    }
    return "";
}



