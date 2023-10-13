<?php

    require $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/lib/vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
    use PHPOffice\PhpSpreadsheet\Reader\Xls;

    $tmpName = $_FILES['excelFile']['tmp_name'];

    $reader = new Xlsx();

    $spreadsheet = $reader->load($tmpName);

    $spreadData = $spreadsheet->getActiveSheet()->toArray();

    

    print_r($spreadData);