<?php
    $data = file_get_contents("php://input", "r");
    if($data !=""){
        $mydata = array();
        $mydata = json_decode($data, true);
        if(isset($mydata["ID"]) && isset($mydata["Name"]) && ($mydata["ID"]!="") && ($mydata["Name"]!="")){
                $p_ID = $mydata["ID"];
                $p_Name = $mydata["Name"];

                //  /   根目錄
                //  ./  目前所在目錄
                //  ../ 跳到上一層              
                require_once '../../conn.php';
            
                // 資料庫查詢
                $sql = "UPDATE pay SET Name='$p_Name' WHERE ID='$p_ID'";
                
                if(mysqli_query($conn, $sql)){
                    echo '{"state":true, "message":"更新付款方式成功"}';
                }else{
                    echo '{"state":false, "message":"更新付款方式失敗"}';
                }
                mysqli_close($conn);
            }else{
                echo '{"state" : false, "message" : "傳遞參數格式錯誤!"}';
            }
    }else{
        echo '{"state":false, "message":"未傳遞任何參數"}';
    }
?>
