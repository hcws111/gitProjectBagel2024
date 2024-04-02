<?php
    $data = file_get_contents("php://input", "r");
    if($data !="")
    {    
        $mydata = array();
        $mydata = json_decode($data, true);
        if(isset($mydata["PNO"])  && ($mydata["PNO"]!="") )
        {       
   
            $p_PNO = $mydata["PNO"];

            // 連線資料庫
            require_once '../../conn.php';

            // 資料庫操作
            $sql = "SELECT * FROM product WHERE PNO='$p_PNO'";

            $result = mysqli_query($conn, $sql);

            // 查詢到的資料數量
            if(mysqli_num_rows($result)==0){
                echo '{"state":true, "message":"編號不存在, 可以使用!"}';              
            }else{
                echo '{"state":false, "message":"編號已存在, 不可以使用!"}';
            }    
            mysqli_close($conn);
        }else{
            echo '{"state" : false, "message" : "傳遞參數格式錯誤!"}';
        }
    }else{
        echo '{"state" : false, "message" : "未傳遞任何參數!"}';
    }
?>