<?php

/*
MyApp
index.php controller
MyApp\Controller\Index
-> lib/Controller/Index.php
*/

/*
全体の名前空間を MyApp
Controller とか Model のクラスはサブ名前空間に配置
lib の中にサブ名前空間と同じフォルダを作り「クラス名.php」
*/

spl_autoload_register(function($class) {
  $prefix = 'MyApp\\';
  if (strpos($class, $prefix) === 0) {
    $className = substr($class, strlen($prefix));
    $classFilePath = __DIR__ . '/../lib/' . str_replace('\\', '/', $className) . '.php';
    if (file_exists($classFilePath)) {
      require $classFilePath;
    }
  }
});