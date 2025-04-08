<?php
class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
        if (!isset($_SESSION['admin'])) {
            header("Location: index.php?url=auth/login");
        }
    }

    public function index() {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = 5;
        $users = $this->userModel->getAll($page, $limit);
        $total_users = $this->userModel->getTotal();
        $total_pages = ceil($total_users / $limit);
        require_once "views/layouts/header.php";
        require_once "views/users/indexusers.php";
        require_once "views/layouts/footer.php";
    }

    public function add() {
        $error = "";
        if (isset($_POST['add_user'])) {
            $db = new Database();
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];
            
            $hashedPassword = $db->hashPassword($password);
            if ($this->userModel->add($email, $hashedPassword, $role)) {
                header("Location: index.php?url=users");
                exit();
            } else {
                $error = "Không thể thêm người dùng. Email có thể đã tồn tại!";
            }
        }
        require_once "views/layouts/header.php";
        require_once "views/users/formusers.php";
        require_once "views/layouts/footer.php";
    }

    public function delete($id) {
        $this->userModel->delete($id);
        header("Location: index.php?url=users");
    }
}
?>