<?php
    $data = file_get_contents("php://input", "r");
    if($data !="")
    {
        $mydata = array();
        $mydata = json_decode($data, true);
        if(isset($mydata["ImageName"])  && ($mydata["ImageName"]!="") )
        {  
            $p_fileName = $mydata["ImageName"];
            $p_full = dirname(__FILE__);
            $p_uploadFolder = dirname(dirname($p_full));
            $p_folderPath = $p_uploadFolder."/upload/images/member";
        
            $filename = $p_folderPath."/".$p_fileName;
            // echo ($fileName);
            if (file_exists($filename)) {
                unlink($filename);
                echo '{"state":"true", "message":"圖片刪除成功!"}';
            }else{
                echo '{"state":"false", "message":"檔案不存在!"}';
            }

        }else{
            echo '{"state" : false, "message" : "傳遞參數格式錯誤!"}';
        }

    }else{
        echo '{"state" : false, "message" : "未傳遞任何參數!"}';
    }
?>