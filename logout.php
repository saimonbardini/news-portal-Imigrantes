<?php
session_start();
// Destrói todas as informações de segurança ativas no momento
session_destroy();

header("Location: index.php");
exit;