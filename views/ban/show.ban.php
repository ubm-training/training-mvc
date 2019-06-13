<?php
include_once 'views/header.php';
?>
    <h3>hiển thị BAN đã chọn</h3>
    <?php if (!empty($data)) {?>
    <h4>ID = <?=$data['id']?></h4>
    <h4>Tên ban = <?=$data['ten_ban']?></h4>
    <?php } ?>
<?php
include_once 'views/footer.php';
?>