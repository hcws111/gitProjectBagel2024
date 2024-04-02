<?php
       if(isset($_FILES['file']['name']) && $_FILES['file']['name']!=""){
        if($_FILES['file']['type']== "image/jpeg" || $_FILES['file']['type']=="image/png"){
            // 重新命名檔案, 傳遞至伺服器
            $nameArray = explode(".", $_FILES['file']['name']);
            $myfile = date("YmdHis").'.'.$nameArray[1]; 
            $p_folderPath = "/var/www/html/ProjectBagel/upload/images/product";
            $filename = $p_folderPath."/".$myfile;
            // echo($filename);
            if(move_uploaded_file($_FILES['file']['tmp_name'], $filename)){
                $datainfo = array();
                $datainfo["name"] = $_FILES['file']['name'];
                $datainfo["type"] = $_FILES['file']['type'];
                $datainfo["size"] = $_FILES['file']['size'];
                $datainfo["tmp_name"] = $_FILES['file']['tmp_name'];
                $datainfo["error"] = $_FILES['file']['error'];
                $datainfo["folderPath"]=$p_folderPath;
                $datainfo["serverfilename"] = $myfile;
                echo '{"state":"true", "data":'.json_encode($datainfo).', "message":"檔案上傳成功!"}';
            }else{
                $errorinfo = array();
                $errorinfo["info"] = $_FILES['file']['error'];
                echo '{"state":"false", "data":'.json_encode($errorinfo).', "message":"檔案上傳錯誤!"}';
            }
        }else{
            echo '{"state":"false", "message":"檔案格式錯誤, 必須為jpeg或png"}';
        }
    }else{
        echo '{"state":"false", "message":"檔案不存在!!"}';
    }
?>