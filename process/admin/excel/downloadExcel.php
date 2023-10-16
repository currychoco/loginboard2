<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/lib/vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
    
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // 엑셀의 헤더 생성
    $column = 'A';
    $headers = ['title', 'content', 'user_no', 'menu_id'];

    foreach($headers as $header) {
        $sheet->setCellValue($column++ . '1', $header);
    }

    $column = 'A';
    $rowNum = 2;
    $values = [
        ['title' => 'testTitle1', 'content' => 'testContent1', 'user_no' => 40, 'menu_id' => 32],
        ['title' => 'testTitle1', 'content' => 'testContent1', 'user_no' => 40, 'menu_id' => 32],
        ['title' => 'testTitle1', 'content' => 'testContent1', 'user_no' => 40, 'menu_id' => 32],
    ];

    foreach ($values as $value) {
        $sheet->setCellValue($column++ . $rowNum, $value['title']);
        $sheet->setCellValue($column++ . $rowNum, $value['content']);
        $sheet->setCellValue($column++ . $rowNum, $value['user_no']);
        $sheet->setCellValue($column . $rowNum++, $value['menu_id']);

        $column = 'A';
    }

    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save(ROOT_PATH . '/excelFormDownloadTest.xlsx');