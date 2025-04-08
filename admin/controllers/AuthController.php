<?php
class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function login() {
        $error = "";
        if (isset($_POST['login'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = $this->userModel->getByEmail($email);

            if ($user) {
                $db = new Database();
                if ($db->verifyPassword($password, $user['password']) && $user['role'] == 'admin') {
                    $_SESSION['admin'] = $email;
                    header("Location: index.php?url=dashboard");
                    exit();
                } else {
                    $error = "Đăng nhập thất bại! Vui lòng kiểm tra email/mật khẩu hoặc quyền truy cập.";
                }
            } else {
                $error = "Email không tồn tại!";
            }
        }
        require_once "views/login.php";
    }

    public function logout() {
        session_destroy();
        header("Location: index.php?url=auth/login");
    }
}
?>