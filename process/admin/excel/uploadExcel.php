<?php

    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/lib/vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
    use PHPOffice\PhpSpreadsheet\Reader\Xls;
    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
    require_once DAO_PATH . '/admin/Excel.DAO.php';

    $fileName = $_FILES['excelFile']['name'];
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
   
    $reader = '';
    if($fileType == 'xlsx') {
        $reader = new Xlsx();
    }
    else if($fileType == 'xls'){
        $reader = new Xls();
    }
    else {
        echo ("
            <script>
                alert('엑셀 파일만 업로드가 가능합니다.');
                history.go(-1);
            </script>
        ");
    }

    $excelDao = new ExcelDAO();

    $tmpName = $_FILES['excelFile']['tmp_name'];

    $spreadsheet = $reader->load($tmpName);

    $spreadData = $spreadsheet->getActiveSheet()->toArray();

    $columList = $spreadData[0];

    $excelList = array();

    for($i = 1; $i < count($spreadData); $i++) {

        $list = $spreadData[$i];
        $tmpArr = array();

        for($j = 0; $j < count($list); $j++) {

            $tmpArr[$columList[$j]] = $list[$j];

        }

        array_push($excelList, $tmpArr);
    }

    $result = $excelDao->insertExcelInfo($excelList);

    if($result) {
        echo ("
            <script>
                alert('엑셀 파일 정보 저장에 성공하였습니다.');
                location.href = '/loginboard2/controller/admin/excel/ExcelUploadController.php';
            </script>
        ");
    }
    else {
        echo ("
            <script>
                alert('엑셀 파일 정보 저장에 실패하였습니다.');
                location.href = '/loginboard2/controller/admin/excel/ExcelUploadController.php';
            </script>
        ");
    }

    