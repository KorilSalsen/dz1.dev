<?php
session_start( session_name('admin') );

unset($_SESSION['auth']);
session_destroy();
header("Location: ".$_SERVER['HTTP_REFERER']);
exit;