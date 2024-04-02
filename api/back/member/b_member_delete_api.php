<?php
    $data = file_get_contents("php://input", "r");
    if($data !=""){
        $mydata = array();
        $mydata = json_decode($data, true);
        if(isset($mydata["ID"]) && ($mydata["ID"]!="")){
                $p_ID = $mydata["ID"];

                //  /   根目錄
                //  ./  目前所在目錄
                //  ../ 跳到上一層              
                require_once '../../conn.php';
            
                // 資料庫查詢
                $sql = "DELETE FROM member WHERE ID='$p_ID'";
                
                if(mysqli_query($conn, $sql)){
                    echo '{"state":true, "message":"刪除會員成功"}';
                }else{
                    echo '{"state":false, "message":"刪除會員失敗"}';
                }
                mysqli_close($conn);
            }else{
                echo '{"state" : false, "message" : "傳遞參數格式錯誤!"}';
            }
    }else{
        echo '{"state":false, "message":"未傳遞任何參數"}';
    }
?>
