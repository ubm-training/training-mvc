<?php include_once 'views/header.php'; ?>
    <h3>sửa chữa BAN đã chọn</h3>
<?php
if (!empty($data)) {
    $editBanId = $data['id'];
    $editTenBan = $data['ten_ban'];
?>
    <form action="<?=route('POST_BAN_UPDATE') ?>" method="post">
        <input type="hidden" name="page" value="ban" />
        <input type="hidden" name="action" value="update" />
        <input type="hidden" name="id" value="<?=$editBanId?>" />
        <label for="ten_ban">Tên ban:</label>
        <input id="ten_ban" name="ten_ban" value="<?=$editTenBan?>" placeholder="nhập tên Ban" required />
        <button type="submit">Lưu</button>
    </form>
<?php } else {?>
    <h2>Lỗi sai ID</h2>
<?php }?>
<?php include_once 'views/footer.php'; ?>