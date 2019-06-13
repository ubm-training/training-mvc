<?php include_once 'views/header.php'; ?>
    <h3>hiển thị NHÂN VIÊN đã chọn</h3>
<?php if (!empty($data)) {?>
    <h4>ID = <?=$data['id']?></h4>
    <h4>Mã nhân viên = <?=$data['ma_nhan_vien']?></h4>
    <h4>Tên nhân viên = <?=$data['ho_ten']?></h4>
    <h4>Ban = <?=$data['ban']?></h4>
    <h4>Số điện thoại = <?=$data['so_dien_thoai']?></h4>
    <h4>Năm sinh = <?=$data['nam_sinh']?></h4>
    <h4>Email = <?=$data['email']?></h4>
<?php } ?>
<?php include_once 'views/footer.php'; ?>