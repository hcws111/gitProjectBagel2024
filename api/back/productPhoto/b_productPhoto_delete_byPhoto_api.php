<?php
    $data = file_get_contents("php://input", "r");
    if($data !=""){
        $mydata = array();
        $mydata = json_decode($data, true);
        if(isset($mydata["Photo"]) && ($mydata["Photo"]!="")){
                $p_Photo = $mydata["Photo"];

                //  /   根目錄
                //  ./  目前所在目錄
                //  ../ 跳到上一層              
                require_once '../../conn.php';

                // 照片不是空白的  
                $sql = "SELECT Photo FROM productPhoto WHERE Photo='$p_Photo'";
                $result = mysqli_query($conn, $sql);    
                if(mysqli_num_rows($result) > 0){
                    while($row = $result->fetch_assoc()){
                        if($row["Photo"]!="")
                        {
                            $p_folderPath = "/var/www/html/ProjectBagel/upload/images/product";
                            $filename = $p_folderPath."/".$row["Photo"];
                            if (file_exists($filename)) 
                                unlink($filename);
                        }
                    }  

                    // 資料庫查詢
                    $sql = "DELETE FROM productPhoto WHERE Photo='$p_Photo'";
                    
                    if(mysqli_query($conn, $sql)){
                        echo '{"state":true, "message":"刪除產品圖片成功"}';
                    }else{
                        echo '{"state":false, "message":"刪除產品圖片失敗"}';
                    }

                }else{
                    echo '{"state":false, "message":"刪除產品圖片失敗, 找不到檔案"}';
                }               
                mysqli_close($conn);
            }else{
                echo '{"state" : false, "message" : "傳遞參數格式錯誤!"}';
            }
    }else{
        echo '{"state":false, "message":"未傳遞任何參數"}';
    }
?>
