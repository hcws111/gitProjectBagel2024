<?php
    $data = file_get_contents("php://input", "r");
    if($data !=""){
        $mydata = array();
        $mydata = json_decode($data, true);
        if(isset($mydata["WebName"]) && ($mydata["WebName"]!="")){
            $p_WebName = $mydata["WebName"];

                //  /   根目錄
                //  ./  目前所在目錄
                //  ../ 跳到上一層              
                require_once '../../conn.php';
            
                // 資料庫查詢
                $sql = "DELETE FROM cart WHERE WebName='$p_WebName'";
                
                if(mysqli_query($conn, $sql)){
                    echo '{"state":true, "message":"刪除購物車成功"}';
                }else{
                    echo '{"state":false, "message":"刪除購物車失敗"}';
                }
                mysqli_close($conn);
            }else{
                echo '{"state" : false, "message" : "傳遞參數格式錯誤!"}';
            }
    }else{
        echo '{"state":false, "message":"未傳遞任何參數"}';
    }
?>
