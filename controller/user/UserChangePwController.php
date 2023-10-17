<?php
     session_start();
     require_once $_SERVER['DOCUMENT_ROOT']."/loginboard2/conf.php";
     require_once DAO_PATH . '/user/User.DAO.php';
     require_once ROOT_PATH . '/common/Utility.php';
     require_once ROOT_PATH . "/common/Template.php";

     // 로그인 체크
     $userId = null;
     if(isset($_SESSION['userId'])) {
          $userId = $_SESSION['userId'];
     }

     $dao = new User();
     $utility = new Utility();

     $no = $utility->filter_SQL($_SESSION['no']);
     $userId = $utility->filter_SQL($_SESSION['userId']);

     $row = $dao->getUser($no, $userId);

     $oTemplate = new Template();
     $oTemplate->set('row', $row);

     $templateType = ROOT_PATH . '/tpl/user/userInfoView.tpl.php';

     echo $oTemplate->fetch($templateType);