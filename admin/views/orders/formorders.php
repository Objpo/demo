<h2>Thêm đơn hàng</h2>
<?php 
$userModel = new User();
$users = $userModel->getAll(1, 9999);
?>
<form method="POST">
    <label>User ID:</label>
    <select name="user_id" required>
        <?php while ($user = mysqli_fetch_assoc($users)) { ?>
            <option value="<?php echo $user['id']; ?>">
                <?php echo $user['email']; ?>
            </option>
        <?php } ?>
    </select><br>
    <label>Tổng tiền:</label>
    <input type="number" step="0.01" name="total" required><br>
    <label>Trạng thái:</label>
    <select name="status" required>
        <option value="pending" selected>Pending</option>
        <option value="completed">Completed</option>
    </select><br>
    <button type="submit" name="add_order">Thêm đơn hàng</button>
</form>
<a href="index.php?url=orders">Quay lại danh sách đơn hàng</a>