<h2><?php echo isset($product) ? 'Sửa sản phẩm' : 'Thêm sản phẩm'; ?></h2>
<form method="POST">
    <label>Tên sản phẩm:</label>
    <input type="text" name="name" value="<?php echo isset($product) ? $product['name'] : ''; ?>" required><br>
    <label>Giá:</label>
    <input type="number" name="price" value="<?php echo isset($product) ? $product['price'] : ''; ?>" required><br>
    <?php if (isset($product)) { ?>
        <button type="submit" name="update_product">Cập nhật</button>
    <?php } else { ?>
        <button type="submit" name="add_product">Thêm sản phẩm</button>
    <?php } ?>
</form>
<a href="index.php?url=products">Quay lại danh sách sản phẩm</a>