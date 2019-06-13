<?php include_once 'views/header.php'; ?>
    <h3>TẠO THÊM BAN</h3>
    <form action="<?=route('POST_BAN_STORE') ?>" method="post">
        <input type="hidden" name="page" value="ban" />
        <input type="hidden" name="action" value="store" />

        <label for="ten_ban">Tên ban:</label>
        <input id="ten_ban" name="ten_ban" placeholder="nhập tên Ban cần thêm mới" required />
        <button type="submit">Thêm</button>
    </form>
<?php include_once 'views/footer.php'; ?>