<?php
// ฟังก์ชันเล็กๆ เพื่อหาว่าเราอยู่หน้าไหนอยู่ เพื่อเพิ่มคลาส active
$current_uri = str_replace(rtrim(dirname($_SERVER['PHP_SELF']), '/'), '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$current_uri = rtrim($current_uri, '/');
if ($current_uri === '') {
    $current_uri = '/';
}

?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haekkhon PHP Framework</title>
    <meta name="description" content="Haekkhon PHP Framework - เบา บาง และเข้าใจง่ายที่สุด สร้างขึ้นมาเพื่อให้คุณเข้าใจหลักการทำงานของ Framework แบบพื้นฐานที่สุด ไม่มีอะไรซับซ้อน ไม่มี Magic ที่ซ่อนอยู่">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="layout">
      <div class="wrapper">
        <nav class="navbar">
            <div class="container">
                <a href=".">Haekkhon Framework</a>
                <div class="nav-links">
                    <a href="." class="<?=$current_uri === '/' ? 'active' : '';?>">หน้าแรก</a>
                    <a href="docs" class="<?=$current_uri === '/docs' ? 'active' : '';?>">Docs</a>
                    <a href="features" class="<?=$current_uri === '/features' ? 'active' : '';?>">Features</a>
                    <a href="demo" class="<?=$current_uri === '/demo' ? 'active' : '';?>">Demo</a>
                </div>
            </div>
        </nav>
