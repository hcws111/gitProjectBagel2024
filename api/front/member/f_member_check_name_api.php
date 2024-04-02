<?php
    $data = file_get_contents("php://input", "r");
    if($data !="")
    {    
        $mydata = array();
        $mydata = json_decode($data, true);
        if(isset($mydata["WebName"])  && ($mydata["WebName"]!="") )
        {       
   
            $p_WebName = $mydata["WebName"];

            // 連線資料庫
            require_once '../../conn.php';

            // 資料庫操作
            $sql = "SELECT WebName, Email FROM member WHERE WebName='$p_WebName'";

            $result = mysqli_query($conn, $sql);

            // 查詢到的資料數量
            if(mysqli_num_rows($result)==0){
                echo '{"state":true, "message":"帳號不存在, 可以使用!"}';              
            }else{
                echo '{"state":false, "message":"帳號已存在, 不可以使用!"}';
            }    
            mysqli_close($conn);
        }else{
            echo '{"state" : false, "message" : "傳遞參數格式錯誤!"}';
        }
    }else{
        echo '{"state" : false, "message" : "未傳遞任何參數!"}';
    }
?>