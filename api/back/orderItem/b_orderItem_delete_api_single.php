<?php
    $data = file_get_contents("php://input", "r");
    if($data !=""){
        $mydata = array();
        $mydata = json_decode($data, true);
        if(isset($mydata["PoNo"]) && ($mydata["PoNo"]!="")){
            $p_PoNo = $mydata["PoNo"];
            $p_PNO = $mydata["PNO"];

                //  /   根目錄
                //  ./  目前所在目錄
                //  ../ 跳到上一層              
                require_once '../../conn.php';
            
                // 資料庫查詢
                $sql = "DELETE FROM orderItem WHERE PoNo='$p_PoNo' AND PNO='$p_PNO'";
                
                if(mysqli_query($conn, $sql)){
                    echo '{"state":true, "message":"刪除指定訂單項目成功"}';
                }else{
                    echo '{"state":false, "message":"刪除指定訂單項目失敗"}';
                }
                mysqli_close($conn);
            }else{
                echo '{"state" : false, "message" : "傳遞參數格式錯誤!"}';
            }
    }else{
        echo '{"state":false, "message":"未傳遞任何參數"}';
    }
?>
