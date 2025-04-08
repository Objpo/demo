<h2>Quản lý người dùng</h2>
<a href="index.php?url=users/add" class="add-btn">Thêm người dùng mới</a>
<table>
    <tr>
        <th>ID</th>
        <th>Email</th>
        <th>Role</th>
        <th>Hành động</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($users)) { ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['role']; ?></td>
        <td>
            <a href="index.php?url=users/delete/<?php echo $row['id']; ?>" class="delete-btn">Xóa</a>
        </td>
    </tr>
    <?php } ?>
</table>
<div class="pagination">
    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
        <a href="index.php?url=users&page=<?php echo $i; ?>" <?php if ($i == $page) echo 'class="active"'; ?>><?php echo $i; ?></a>
    <?php } ?>
</div>