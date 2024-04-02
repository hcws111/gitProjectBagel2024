<?php
    $data = file_get_contents("php://input", "r");
    if($data !=""){
        $mydata = array();
        $mydata = json_decode($data, true);
        if(isset($mydata["PoNo"]) && ($mydata["PoNo"]!="")){
            $p_PoNo = $mydata["PoNo"];
            $p_OrderState = $mydata["OrderState"];

                //  /   根目錄
                //  ./  目前所在目錄
                //  ../ 跳到上一層              
                require_once '../../conn.php';
            
                // 資料庫查詢
                $sql = "UPDATE orderP SET OrderState='$p_OrderState' WHERE PoNo='$p_PoNo'";
                
                if(mysqli_query($conn, $sql)){
                    echo '{"state":true, "message":"更新訂單資料成功"}';
                }else{
                    echo '{"state":false, "message":"更新訂單資料失敗"}';
                }
                mysqli_close($conn);
            }else{
                echo '{"state" : false, "message" : "傳遞參數格式錯誤!"}';
            }
    }else{
        echo '{"state":false, "message":"未傳遞任何參數"}';
    }
?>
