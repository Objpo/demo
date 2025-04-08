<h2>Quản lý sản phẩm</h2>
<a href="index.php?url=products/add">Thêm sản phẩm mới</a>
<table>
    <tr>
        <th>ID</th>
        <th>Tên</th>
        <th>Giá</th>
        <th>Hành động</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($products)) { ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo number_format($row['price'], 0, ',', '.') . ' VNĐ'; ?></td>
        <td>
            <a href="index.php?url=products/edit/<?php echo $row['id']; ?>" class="edit-btn">Sửa</a>
            <a href="index.php?url=products/delete/<?php echo $row['id']; ?>" class="delete-btn">Xóa</a>
        </td>
    </tr>
    <?php } ?>
</table>
<div class="pagination">
    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
        <a href="index.php?url=products&page=<?php echo $i; ?>" <?php if ($i == $page) echo 'class="active"'; ?>><?php echo $i; ?></a>
    <?php } ?>
</div>