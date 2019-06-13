<?php include_once 'views/header.php'; ?>
    <table style="width:100%">
        <tr>
            <th>DANH SÁCH BAN</th>
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
            <th style="width:20%">ID</th>
            <th>Tên Ban</th>
            <th style="width:30%">Thao tác</th>
        </tr>
        <?php
        if (!empty($data)) {
            foreach ($data as $item) {
                ?>
                <tr>
                    <td style="text-align: center;"><?=$item['id']?></td>
                    <td><?=$item['ten_ban']?></td>
                    <td>
                        <table style="width:100%; border: 0;">
                            <tr>
                                <td><a href="<?=route('GET_BAN_SHOW',$item['id'])?>">Xem</a></td>
                                <td><a href="<?=route('GET_BAN_EDIT',$item['id'])?>">Sửa</a></td>
                                <td>
                                    <form action="<?=route('POST_BAN_DELETE')?>" method="post">
                                        <input type="hidden" name="page" value="ban">
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