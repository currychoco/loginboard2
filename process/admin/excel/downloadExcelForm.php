<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';

    $dir_path = ROOT_PATH . '/';
    $file_name = 'excelForm.xlsx';
    $file_path = $dir_path.$file_name;
    $file_size = filesize($file_path);

    if (file_exists($file_path)) {
        header('Content-Type:application/octet-stream');
        header("Content-Disposition:attachment;filename={$file_name}");
        header('Content-Transfer-Encoding:binary');
        header("Content-Length:{$file_size}");
        header('Cache-Control:cache,must-revalidate');
        header('Pragma:no-cache');
        header('Expires:0');
     
        $fp = fopen($file_path, 'r');
     
        while(!feof($fp)) {
            $buf = fread($fp, $file_size);
            $read = strlen($buf);
            print($buf);
            flush();
        }
     
        fclose($fp);

    } else {
        die('다운로드 실패');
    }