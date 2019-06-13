<?php include_once 'views/header.php'; ?>
    <table style="width:100%">
        <tr>
            <th>DANH SÁCH NHÂN VIÊN</th>
        </tr>
    </table>
    <style>
        #table_data table, #table_data th, #table_data td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
    <div id="table_data">
        <table style="width:100%;" >
            <tr>
                <th >ID</th>
                <th>Mã nhân viên</th>
                <th>Tên nhân viên</th>
                <th>Ban</th>
                <th>Số điện thoại</th>
                <th>Năm sinh</th>
                <th>Email</th>
                <th >Thao tác</th>
            </tr>
            <?php
            if (!empty($data)) {
                foreach ($data as $item) {
                    ?>
                    <tr>
                        <td style="text-align: center;"><?=$item['id']?></td>
                        <td style="text-align: center;"><?=$item['ma_nhan_vien']?></td>
                        <td style="text-align: center;"><?=$item['ho_ten']?></td>
                        <td style="text-align: center;"><?=$item['ban']?></td>
                        <td style="text-align: center;"><?=$item['so_dien_thoai']?></td>
                        <td style="text-align: center;"><?=$item['nam_sinh']?></td>
                        <td style="text-align: center;"><?=$item['email']?></td>
                        <td style="text-align: center;">
                            <table style="width:100%; border: 0;">
                                <tr>
                                    <td><a href="<?=route('GET_USER_SHOW',$item['id'])?>">Xem</a></td>
                                    <td><a href="<?=route('GET_USER_EDIT',$item['id'])?>">Sửa</a></td>
                                    <td>
                                        <form action="<?=route('POST_USER_DELETE')?>" method="post">
                                            <input type="hidden" name="page" value="user">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="id" value="<?=$item['id']?>">
                                            <button type="submit" >Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                <?php }}?>
        </table>
    </div>
<?php include_once 'views/footer.php'; ?>