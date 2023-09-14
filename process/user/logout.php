<script src="/loginboard2/js/user/user.js"></script>
<?php
    session_start();
    session_unset();
    session_destroy();

    echo '<script>logout()</script>';
