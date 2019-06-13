<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Quản Lý Nhân Sự Tổng Trạm</title>
</head>
<body>
<table style="width:100%; border: 0;">
    <tr>
        <th style="width:20%;"><h2>Tổng Trạm<br > HOÀNG HOA THÁM</h2></th>
        <th style="width:80%;"><h2>QUẢN LÝ NHÂN SỰ TỔNG TRẠM</h2></th>
    </tr>
    <tr>
        <td style="height:650px; vertical-align: top;">
            <h3>Menu</h3>
            <ul style="list-style-type:circle;">
                <li><a href="<?=route('GET_BAN_INDEX')?>">Danh sách Ban</a></li>
                <li><a href="<?=route('GET_BAN_CREATE')?>">Tạo thêm Ban</a></li>
                <li>--------</li>
                <li><a href="<?=route('GET_USER_INDEX')?>">Danh sách nhân viên</a></li>
                <li><a href="<?=route('GET_USER_CREATE')?>">Thêm nhân viên</a></li>
            </ul>
        </td>
        <td style="vertical-align: top;">

