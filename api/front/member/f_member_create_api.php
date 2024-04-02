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
            ($mydata["WebName"]!="") && 
            ($mydata["Pwd"]!="") && 
            ($mydata["FullName"]!="") && 
            ($mydata["Mobile"]!="") && 
            ($mydata["Email"]!="" &&
            ($mydata["Age_ID"]!=""))){
                $p_WebName = $mydata["WebName"];
                $p_Pwd = password_hash($mydata["Pwd"], PASSWORD_DEFAULT);
                $p_Email = $mydata["Email"];
                $p_FullName = $mydata["FullName"];
                $p_Mobile = $mydata["Mobile"];
                $p_AgeID = $mydata["Age_ID"];
                $p_UIDMP = substr(hash(("sha256"), uniqid(time())), 10, 80);   
                $p_Active ="Y";
                $p_Photo = $mydata["Photo"];
                $p_MemberTypeID = "6";

                //  /   根目錄
                //  ./  目前所在目錄
                //  ../ 跳到上一層         
                // 連線資料庫     
                require_once '../../conn.php';
            
                // echo ($p_UIDMP);
                // 資料庫操作
                $sql = "INSERT INTO member(WebName, Pwd, FullName, Mobile, Email, Age_ID, Photo, MemberType_ID, UIDMP, Active) VALUES (?,?,?,?,?,?,?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssssisiss", $p_WebName, $p_Pwd, $p_FullName, $p_Mobile, $p_Email, $p_AgeID, $p_Photo, $p_MemberTypeID, $p_UIDMP, $p_Active);
                
                // echo("1");
                if($stmt->execute()){
                //     $outoutData = array();
                //     // echo('webName: '. $p_WebName);
                //     // echo("UID: ".$p_UIDMP);
                //      $outoutData["WebName"] = $p_WebName;
                //      $outoutData["UIDMP"] = $p_UIDMP;
                //    echo '{"state":true "data":'.json_encode($outoutData).', "message":"新增會員成功"}';
                    echo '{"state":true, "message":"新增會員成功"}';
                }else{
                    echo '{"state":false, "message":"新增會員失敗"}';
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
