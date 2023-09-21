<?php
    function image_view() {

        $IMAGE_PATH = $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/img/20230920/04f1bcad-ff36-459c-832b-bf598f7ceea7.jpg';

        $IMAGE_SIZE = getimagesize($IMAGE_PATH);
    
        if($IMAGE_SIZE) {
    
            $FILENAME = 'download.'.strtolower(substr($IMAGE_PATH,strlen($IMAGE_PATH)-3,3));
    
            header("Content-Type: ".$IMAGE_SIZE['mime']);
    
            header("Content-Disposition: inline;filename=$FILENAME");
    
            header("Content-Length: ".filesize($IMAGE_PATH));
    
            readfile($IMAGE_PATH);
    
        }
    
    }

    function image_down() {

        $IMAGE_PATH = $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/img/20230920/04f1bcad-ff36-459c-832b-bf598f7ceea7.jpg';
    
        $IMAGE_SIZE = getimagesize($IMAGE_PATH);
    
        if($IMAGE_SIZE) {
    
            $FILENAME = 'download.'.strtolower(substr($IMAGE_PATH,strlen($IMAGE_PATH)-3,3));
    
            header("Content-Type: ".$IMAGE_SIZE['mime']);
    
            header("Content-Disposition: attachment;filename=$FILENAME");
    
            header("Content-Length: ".filesize($IMAGE_PATH));
    
            readfile($IMAGE_PATH);
    
        }
    
    }

    image_down();