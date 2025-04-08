<?php
class ProductController {
    private $productModel;

    public function __construct() {
        $this->productModel = new Product();
        if (!isset($_SESSION['admin'])) {
            header("Location: index.php?url=auth/login");
        }
    }

    public function index() {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = 5;
        $products = $this->productModel->getAll($page, $limit);
        $total_products = $this->productModel->getTotal();
        $total_pages = ceil($total_products / $limit);
        require_once "views/layouts/header.php";
        require_once "views/products/indexproducts.php";
        require_once "views/layouts/footer.php";
    }

    public function add() {
        if (isset($_POST['add_product'])) {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $this->productModel->add($name, $price);
            header("Location: index.php?url=products");
        }
        require_once "views/layouts/header.php";
        require_once "views/products/formproducts.php";
        require_once "views/layouts/footer.php";
    }

    public function edit($id) {
        if (isset($_POST['update_product'])) {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $this->productModel->update($id, $name, $price);
            header("Location: index.php?url=products");
        }
        $product = $this->productModel->getById($id);
        require_once "views/layouts/header.php";
        require_once "views/products/formproducts.php";
        require_once "views/layouts/footer.php";
    }

    public function delete($id) {
        $this->productModel->delete($id);
        header("Location: index.php?url=products");
    }
}
?>