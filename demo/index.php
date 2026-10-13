<?php
header('Content-Type: text/html; charset=utf-8');
$name = $_GET['name'] ?? '同学';
$safeName = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
?>
<h1>你好，<?= $safeName ?>！</h1>
<p>这是我们自己的 Web 服务。</p>
