<?php


    $data = file_get_contents("php://input", "r");
    if($data !="")
    {    
        $mydata = array();
        $mydata = json_decode($data, true);
        if(isset($mydata["UIDMP"])  && ($mydata["UIDMP"]!="") )
        {       
            $p_UIDMP = $mydata["UIDMP"];

            // 連線資料庫
            require_once '../../conn.php';

            // 資料庫操作
            $sql = "SELECT ID, WebName, FullName, Mobile, Email, Age_ID, Photo, MemberType_ID, UIDMP FROM member WHERE UIDMP='$p_UIDMP'";

            $result = mysqli_query($conn, $sql);

            // 查詢到的資料數量
            // 金鑰只有一筆
            if(mysqli_num_rows($result)==1){  
                $mydata = array();
                $row= mysqli_fetch_assoc($result);                
                $mydata[] = $row;

                echo '{"state":true, "data":'.json_encode($mydata).', "message":"驗證成功"}';             
            }else{
                echo '{"state":false, "message":"驗證失敗"}';
            }    
            mysqli_close($conn);
        }else{
            echo '{"state" : false, "message" : "傳遞參數格式錯誤!"}';
        }
    }else{
        echo '{"state" : false, "message" : "未傳遞任何參數!"}';
    }

?>