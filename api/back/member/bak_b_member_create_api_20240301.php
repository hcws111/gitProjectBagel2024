<?php


    $data = file_get_contents("php://input", "r");
    if($data !=""){
        $mydata = array();
        $mydata = json_decode($data, true);
        if(isset($mydata["WebName"]) && 
            isset($mydata["Pwd"]) &&
            isset($mydata["FullName"]) &&
            isset($mydata["Mobile"]) &&
            isset($mydata["Email"]) &&
            isset($mydata["Age_ID"]) &&
            isset($mydata["Photo"]) &&
            isset($mydata["MemberType_ID"]) &&
            isset($mydata["Active"]) &&
            ($mydata["WebName"]!="") && 
            ($mydata["Pwd"]!="") && 
            ($mydata["FullName"]!="") && 
            ($mydata["Mobile"]!="") && 
            ($mydata["Email"]!="") && 
            ($mydata["Age_ID"]!="") && 
            ($mydata["Photo"]!="") && 
            ($mydata["MemberType_ID"]!="") && 
            ($mydata["Active"]!="")){
                $p_WebName = $mydata["WebName"];
                $p_Pwd = $mydata["Pwd"];
                $p_FullName = $mydata["FullName"];
                $p_Mobile = $mydata["Mobile"];
                $p_Email = $mydata["Email"];
                $p_AgeID = $mydata["Age_ID"];
                $p_Photo = $mydata["Photo"];
                $p_TypeID = $mydata["MemberType_ID"];
                $p_Active = $mydata["Active"];

                //  /   根目錄
                //  ./  目前所在目錄
                //  ../ 跳到上一層              
                require_once '../../conn.php';
            
                // 資料庫查詢
                $sql = "INSERT INTO member(WebName, Pwd, FullName, Mobile, Email, Age_ID, Photo, MemberType_ID, UID01, Active) VALUES ('$p_WebName', '$p_Pwd', '$p_FullName', '$p_Mobile', '$p_Email', '$p_AgeID', '$p_Photo', '$p_TypeID', '', '$p_Active')";
                
                if(mysqli_query($conn, $sql)){
                    echo '{"state":true, "message":"新增會員成功"}';
                }else{
                    echo '{"state":false, "message":"新增會員失敗'.$sql.'"}';
                }
                mysqli_close($conn);
            }else{
                echo '{"state" : false, "message" : "傳遞參數格式錯誤!"}';
            }
    }else{
        echo '{"state":false, "message":"未傳遞任何參數"}';
    }

   

    
?>
