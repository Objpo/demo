<h2>Quản lý đơn hàng</h2>
<a href="index.php?url=orders/add" class="add-btn">Thêm đơn hàng mới</a>
<table>
    <tr>
        <th>ID</th>
        <th>User ID</th>
        <th>Total</th>
        <th>Status</th>
        <th>Hành động</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($orders)) { ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['user_id']; ?></td>
        <td><?php echo number_format($row['total'], 0, ',', '.') . ' VNĐ'; ?></td>
        <td>
            <form method="POST" action="index.php?url=orders/update/<?php echo $row['id']; ?>">
                <select name="status" onchange="this.form.submit()">
                    <option value="pending" <?php if ($row['status'] == 'pending') echo 'selected'; ?>>Pending</option>
                    <option value="completed" <?php if ($row['status'] == 'completed') echo 'selected'; ?>>Completed</option>
                </select>
            </form>
        </td>
        <td>
            <a href="index.php?url=orders/delete/<?php echo $row['id']; ?>" class="delete-btn">Xóa</a>
        </td>
    </tr>
    <?php } ?>
</table>
<div class="pagination">
    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
        <a href="index.php?url=orders&page=<?php echo $i; ?>" <?php if ($i == $page) echo 'class="active"'; ?>><?php echo $i; ?></a>
    <?php } ?>
</div>