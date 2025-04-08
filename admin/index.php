<?php
session_start();

// Đăng ký autoload
spl_autoload_register(function ($class_name) {
    $dirs = ['models', 'controllers'];
    foreach ($dirs as $dir) {
        $file = "$dir/$class_name.php";
        if (file_exists($file)) {
            require_once $file;
        }
    }
});

// Phân tích URL
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'auth/login';
$url = explode('/', $url);

// Khởi tạo controller và action mặc định
$controller = $url[0];
$action = isset($url[1]) ? $url[1] : 'index';
$params = array_slice($url, 2);

// Điều hướng đến controller phù hợp
switch ($controller) {
    case 'auth':
        $authController = new AuthController();
        if ($action == 'login') {
            $authController->login();
        } elseif ($action == 'logout') {
            $authController->logout();
        }
        break;
    case 'products':
        $productController = new ProductController();
        if ($action == 'index') {
            $productController->index();
        } elseif ($action == 'add') {
            $productController->add();
        } elseif ($action == 'edit' && isset($params[0])) {
            $productController->edit($params[0]);
        } elseif ($action == 'delete' && isset($params[0])) {
            $productController->delete($params[0]);
        }
        break;
    case 'orders':
        $orderController = new OrderController();
        if ($action == 'index') {
            $orderController->index();
        } elseif ($action == 'add') {
            $orderController->add();
        } elseif ($action == 'update' && isset($params[0])) {
            $orderController->update($params[0]);
        } elseif ($action == 'delete' && isset($params[0])) {
            $orderController->delete($params[0]);
        }
        break;
    case 'users':
        $userController = new UserController();
        if ($action == 'index') {
            $userController->index();
        } elseif ($action == 'add') {
            $userController->add();
        } elseif ($action == 'delete' && isset($params[0])) {
            $userController->delete($params[0]);
        }
        break;
    case 'dashboard':
        if (!isset($_SESSION['admin'])) {
            header("Location: index.php?url=auth/login");
        }
        require_once "views/dashboard.php";
        break;
    default:
        echo "404 - Trang không tồn tại!";
}
?>