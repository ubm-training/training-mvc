<?php
namespace TrainingMvc;
require_once 'models/User.php';
class UserController
{
    public function index() {
        $all = User::all();
        $data = null;
        if ($all != null) {
            foreach ($all as $item) {
                $data[$item->id]['id'] = $item->id;
                $data[$item->id]['ma_nhan_vien'] = $item->ma_nhan_vien;
                $data[$item->id]['ho_ten'] = $item->ho_ten;
                $data[$item->id]['so_dien_thoai'] = $item->so_dien_thoai;
                $data[$item->id]['nam_sinh'] = $item->nam_sinh;
                $data[$item->id]['email'] = $item->email;
                $data[$item->id]['ban'] = '';
                if ($item->ban_id != null) {
                    $ban = Ban::find($item->ban_id);
                    if ($ban != null) $data[$item->id]['ban'] = $ban->ten_ban;
                }
            }
        }
        include 'views/user/index.user.php';
    }
    
    public function create() {
        $dataBan = null;
        $allBan = Ban::all();
        if ($allBan != null) {
            foreach ($allBan as $item) {
                $dataBan[$item->id]['id'] = $item->id;
                $dataBan[$item->id]['ten_ban'] = $item->ten_ban;
            }
        }
        include 'views/user/create.user.php';
    }

    public function store($request) {
        if (!empty($request['ma_nhan_vien']) && !empty($request['ho_ten'])) {
            $newUser = new User();
            $newUser->ma_nhan_vien = $request['ma_nhan_vien'];
            $newUser->ho_ten = $request['ho_ten'];
            $newUser->so_dien_thoai = (empty($request['so_dien_thoai']))?'':$request['so_dien_thoai'];
            $newUser->nam_sinh = (empty($request['nam_sinh']))?'':$request['nam_sinh'];
            $newUser->email = (empty($request['email']))?'':$request['email'];
            $newUser->ban_id = (empty($request['ban_id']))?'':$request['ban_id'];
            $newUser->save();
        }
        redirect('GET_USER_INDEX');
    }

    public function show($request) {
        $data = null;
        $item = User::find($request['id']);
        if ($item != null) {
            $data['id'] = $item->id;
            $data['ma_nhan_vien'] = $item->ma_nhan_vien;
            $data['ho_ten'] = $item->ho_ten;
            $data['ban'] = '';
            $data['so_dien_thoai'] = $item->so_dien_thoai;
            $data['nam_sinh'] = $item->nam_sinh;
            $data['email'] = $item->email;
            if ($item->ban_id != null) {
                $ban = Ban::find($item->ban_id);
                if ($ban != null) $data['ban']  = $ban->ten_ban;
            }
        }
        include 'views/user/show.user.php';
    }

    public function edit($request) {
        $data = null;
        $item = User::find($request['id']);
        if ($item != null) {
            $data['id'] = $item->id;
            $data['ma_nhan_vien'] = $item->ma_nhan_vien;
            $data['ho_ten'] = $item->ho_ten;
            $data['so_dien_thoai'] = $item->so_dien_thoai;
            $data['nam_sinh'] = $item->nam_sinh;
            $data['email'] = $item->email;
            $data['ban_id'] = $item->ban_id;
        }
        $dataBan = null;
        $allBan = Ban::all();
        if ($allBan != null) {
            foreach ($allBan as $item) {
                $dataBan[$item->id]['id'] = $item->id;
                $dataBan[$item->id]['ten_ban'] = $item->ten_ban;
            }
        }
        include 'views/user/edit.user.php';
    }

    public function update($request) {
        if (!empty($request['ho_ten']) && !empty($request['ma_nhan_vien']) && !empty($request['id'])) {
            $item = User::find($request['id']);
            if ($item != null) {
                $item->ma_nhan_vien = $request['ma_nhan_vien'];
                $item->ho_ten = $request['ho_ten'];
                $item->so_dien_thoai = (empty($request['so_dien_thoai']))?'':$request['so_dien_thoai'];
                $item->nam_sinh = (empty($request['nam_sinh']))?'':$request['nam_sinh'];
                $item->email = (empty($request['email']))?'':$request['email'];
                $item->ban_id = (empty($request['ban_id']))?'':$request['ban_id'];
                $item->save();
            }
        }
        redirect('GET_USER_INDEX');
    }

    public function destroy($request) {
        if (!empty($request['id'])) {
            $item = User::find($request['id']);
            if ($item != null) {
                $item->delete();
            }
        }
        redirect('GET_USER_INDEX');
    }
}