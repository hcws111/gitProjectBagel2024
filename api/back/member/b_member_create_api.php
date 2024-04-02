<?php
    $data = file_get_contents("php://input", "r");
    if($data !=""){
        $mydata = array();
        $mydata = json_decode($data, true);
        if(isset($mydata["WebName"]) && 
            isset($mydata["Pwd"]) &&
            isset($mydata["MemberType_ID"]) &&
            ($mydata["WebName"]!="") && 
            ($mydata["Pwd"]!="") &&  
            ($mydata["MemberType_ID"]!="")){
                $p_WebName = $mydata["WebName"];
                $p_Pwd = password_hash($mydata["Pwd"], PASSWORD_DEFAULT);
                $p_FullName = $mydata["FullName"];
                $p_Mobile = $mydata["Mobile"];
                $p_Email = $mydata["Email"];
                $p_AgeID = $mydata["Age_ID"];
                $p_Photo = $mydata["Photo"];
                $p_TypeID = $mydata["MemberType_ID"];
                $p_Active = "Y";
                $p_UID01 ="";
   
                //  /   根目錄
                //  ./  目前所在目錄
                //  ../ 跳到上一層              
                require_once '../../conn.php';
            
                // 資料庫查詢
                // $sql = "INSERT INTO member(WebName, Pwd, FullName, Mobile, Email, Age_ID, Photo, MemberType_ID, UID01, Active) VALUES ('$p_WebName', '$p_Pwd', '$p_FullName', '$p_Mobile', '$p_Email', '$p_AgeID', '$p_Photo', '$p_TypeID', '', '$p_Active')";

                $sql = "INSERT INTO member(WebName, Pwd, FullName, Mobile, Email, Age_ID, Photo, MemberType_ID, UIDMP, Active) VALUES (?,?,?,?,?,?,?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssssisiss", $p_WebName, $p_Pwd, $p_FullName, $p_Mobile, $p_Email, $p_AgeID, $p_Photo, $p_TypeID, $p_UID01, $p_Active);
                
                if($stmt->execute()){
                    echo '{"state":true, "message":"新增會員成功"}';
                }else{
                    echo '{"state":false, "message":"新增會員失敗'.$sql.'"}';
                }
                $stmt->close();
                mysqli_close($conn);
            }else{
                echo '{"state" : false, "message" : "傳遞參數格式錯誤!"}';
            }
    }else{
        echo '{"state":false, "message":"未傳遞任何參數"}';
    }

   

    
?>
