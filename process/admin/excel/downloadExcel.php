<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/lib/vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
    require_once ROOT_PATH . '/common/autoload.php';
    
    // 엑셀 파일 생성
    $utility = new Utility();

    $boardDao = new DanawaBoardList();
    $boardList = $boardDao->getBoardListForExcel();

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $column = 'A';
    $headers = ['id', 'title', 'content', 'user_no', 'reg_date', 'mod_date', 'view_count', 'menu_id'];

    foreach($headers as $header) {
        $sheet->setCellValue($column++ . '1', $header);
    }

    $column = 'A';
    $rowNum = 2;
    foreach($boardList as $board) {
        for($i = 0; $i < count($headers); $i++) {
            if($i != count($headers) - 1) {
                $sheet->setCellValue($column++ . $rowNum, $board[$headers[$i]]);
            }
            else {
                $sheet->setCellValue($column . $rowNum++, $board[$headers[$i]]);

                $column = 'A';
            }
        }
    }    

    $file_name = $utility->getUUID() . '.xlsx';
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save(ROOT_PATH . '/' . $file_name);


    // 엑셀 파일 다운로드
    $dir_path = ROOT_PATH . '/';
    $file_path = $dir_path . $file_name;
    $file_size = filesize($file_path);

    if (file_exists($file_path)) {
        header('Content-Type:application/octet-stream');
        header('Content-Disposition:attachment;filename=boardList.xlsx');
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

    unlink($file_path);