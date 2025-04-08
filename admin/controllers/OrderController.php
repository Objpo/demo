<?php
class OrderController {
    private $orderModel;

    public function __construct() {
        $this->orderModel = new Order();
        if (!isset($_SESSION['admin'])) {
            header("Location: index.php?url=auth/login");
        }
    }

    public function index() {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = 5;
        $orders = $this->orderModel->getAll($page, $limit);
        $total_orders = $this->orderModel->getTotal();
        $total_pages = ceil($total_orders / $limit);
        require_once "views/layouts/header.php";
        require_once "views/orders/indexorders.php";
        require_once "views/layouts/footer.php";
    }

    public function add() {
        if (isset($_POST['add_order'])) {
            $user_id = $_POST['user_id'];
            $total = $_POST['total'];
            $status = $_POST['status'];
            $this->orderModel->add($user_id, $total, $status);
            header("Location: index.php?url=orders");
            exit();
        }
        require_once "views/layouts/header.php";
        require_once "views/orders/formorders.php";
        require_once "views/layouts/footer.php";
    }

    public function update($id) {
        if (isset($_POST['status'])) {
            $status = $_POST['status'];
            $this->orderModel->updateStatus($id, $status);
        }
        header("Location: index.php?url=orders");
    }

    public function delete($id) {
        $this->orderModel->delete($id);
        header("Location: index.php?url=orders");
    }
}
?>