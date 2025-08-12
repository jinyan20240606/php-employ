<?php

include './MemcacheSession.php';

$_SESSION['aaa'] = '你好世界';

echo $_SESSION['aaa'];