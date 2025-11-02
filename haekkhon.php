<?php // haekkhon.php

/**
 * Haekkhon PHP Framework
 * Framework บางๆ ที่ทำงานด้วยฟังก์ชัน
 */

// ตัวแปรเก็บเส้นทางทั้งหมดที่ผู้ใช้กำหนด
$routes = [];

/**
 * ฟังก์ชันสำหรับกำหนดเส้นทาง (Route)
 *
 * @param string $uri       URL ที่ต้องการ (เช่น '/', '/hello')
 * @param callable $handler ฟังก์ชันที่จะทำงานเมื่อเรียก URL นี้
 */
function route(string $uri, callable $handler)
{
    global $routes;
    // ตัด / ท้ายสุดออกเพื่อความสม่ำเสมอ เช่น /hello/ จะกลายเป็น /hello
    $uri = $uri !== '/' ? rtrim($uri, '/') : $uri;
    $routes[$uri] = $handler;
}

/**
 * ฟังก์ชันสำหรับเริ่มต้นการทำงานของ Router
 * จะตรวจสอบ URL ปัจจุบันและเรียกฟังก์ชันที่ตรงกัน
 */
function dispatch()
{
    global $routes;

    // --- เริ่มตรวจสอบ Base Path ---
    // หา Base Path จากตำแหน่งของไฟล์ index.php
    // dirname($_SERVER['PHP_SELF']) จะได้ /haekkhong-framework/public
    $basePath = rtrim(dirname($_SERVER['PHP_SELF']), '/');

    // ดึง URI ปัจจุบันแบบเต็มๆ
    $fullUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    // ตัด Base Path ออกจาก Full URI
    $uri = str_replace($basePath, '', $fullUri);
    // --- สิ้นสุดการตรวจสอบ Base Path ---

    // ตัด / ท้ายสุดออกเพื่อความสม่ำเสมอ
    $uri = rtrim($uri, '/');

    // ถ้า $uri ว่างเปล่า (เช่นเข้าโฟลเดอร์หลัก) ให้เป็น /
    if ($uri === '') {
        $uri = '/';
    }

    // ตรวจสอบว่ามีเส้นทางนี้ใน $routes หรือไม่
    if (array_key_exists($uri, $routes)) {
        // ถ้ามี ให้เรียกฟังก์ชันที่กำหนดไว้
        $handler = $routes[$uri];
        call_user_func($handler);
    } else {
        // ถ้าไม่มี แสดงหน้า 404 Not Found
        http_response_code(404);
        // ให้ include ไฟล์ 404.php แทน
        require __DIR__.'/public/404.php';
    }
}
