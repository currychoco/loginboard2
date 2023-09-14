<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/DAO/user/User.DAO.php';

    $dao = new UserDAO();

    $dao->getUser(33, 'qwer7777');