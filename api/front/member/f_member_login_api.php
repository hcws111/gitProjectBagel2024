<?php

    // {"UserName":"a003"}

    $data = file_get_contents("php://input", "r");
    if($data !="")
    {    
        $mydata = array();
        $mydata = json_decode($data, true);
        if(isset($mydata["WebName"]) && isset($mydata["Pwd"]) && $mydata["WebName"]  && ($mydata["Pwd"]!=""))
        {       
            $p_WebName = $mydata["WebName"];
            $p_Pwd = $mydata["Pwd"];

            // 連線資料庫
            require_once '../../conn.php';

            // 資料庫操作
            $sql = "SELECT WebName, Pwd FROM member WHERE WebName ='$p_WebName'";

            $result = mysqli_query($conn, $sql);

            // 查詢到的資料數量
            if(mysqli_num_rows($result)>0){
                // 確認帳號符合
                $row= mysqli_fetch_assoc($result);
                // 解密
                if(password_verify($p_Pwd, $row["Pwd"])){
                    // 密碼比對正確, 撈取不包含密碼的使用者資料
                    // $mydata = array($row["UserName"], $row["Email"]);

                    // 20240215, cookie
                    $uid = substr(hash(("sha256"), uniqid(time())), 10, 80);                    
                    // 更新資料庫
                    $sql = "UPDATE member SET UIDMP='$uid' WHERE WebName='$p_WebName'";
                    // echo $sql;
                    
                    if(mysqli_query($conn, $sql)){
                        $sql = "SELECT ID, WebName, FullName, Mobile, Email, Age_ID, Photo, MemberType_ID, UIDMP, Active FROM member WHERE WebName ='$p_WebName'";
                        $result = mysqli_query($conn, $sql);
                        $row= mysqli_fetch_assoc($result);
                        $row["Pwd"] = $p_Pwd;
                        $mydata = array();
                        $mydata[] = $row;
    
                        echo '{"state":true, "data":'.json_encode($mydata).', "message":"登入成功"}';  
                    }else{
                        // uid更新錯誤
                        echo '{"state":false, "message":"登入失敗! uid更新錯誤"}';
                    }
                }else{
                    // 密碼比對錯誤
                    echo '{"state":false, "message":"密碼錯誤, 登入失敗!"}';
                }            
            }else{
                // 確認帳號不符合
                echo '{"state":false, "message":"登入失敗!"}';
            }    
            mysqli_close($conn);
        }else{
            echo '{"state" : false, "message" : "傳遞參數格式錯誤!"}';
        }
    }else{
        echo '{"state" : false, "message" : "未傳遞任何參數!"}';
    }

?>