<?php
    $data = file_get_contents("php://input", "r");
    if($data !=""){
        $mydata = array();
        $mydata = json_decode($data, true);
        if(isset($mydata["PNO"]) && ($mydata["PNO"]!="")){
                $p_PNO = $mydata["PNO"];
        
                //  /   根目錄
                //  ./  目前所在目錄
                //  ../ 跳到上一層              
                require_once '../../conn.php';
            
                // 資料庫查詢
                $sql = "SELECT * FROM productPhoto WHERE PNO='$p_PNO' ORDER BY ID";
                
                $result = mysqli_query($conn, $sql);    
                if(mysqli_num_rows($result)>0){
                    $mydata = array();
                    while($row = mysqli_fetch_assoc($result)){
                        $mydata[] = $row;
                    }
                    echo '{"state":true, "data":'.json_encode($mydata).', "message":讀取產品詳細圖片成功!"}';
                }else{
                    echo '{"state":false, "message":"讀取產品詳細圖片失敗"}';
                }
                mysqli_close($conn);
            }else{
                echo '{"state" : false, "message" : "傳遞參數格式錯誤!"}';
            }
    }else{
        echo '{"state":false, "message":"未傳遞任何參數"}';
    }
?>
