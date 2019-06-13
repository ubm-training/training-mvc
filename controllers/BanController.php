<?php
namespace TrainingMvc;
require_once 'models/Ban.php';
class BanController
{
    public function index() {
        $all = Ban::all();
        $data = null;
        if ($all != null) {
            foreach ($all as $item) {
                $data[$item->id]['id'] = $item->id;
                $data[$item->id]['ten_ban'] = $item->ten_ban;
            }
        }
        include 'views/ban/index.ban.php';
    }

    public function create() {
        include 'views/ban/create.ban.php';
    }

    public function store($request) {
        if (!empty($request['ten_ban'])) {
            $newBan = new Ban();
            $newBan->ten_ban = $request['ten_ban'];
            $newBan->save();
        }
        redirect('GET_BAN_INDEX');
    }

    public function show($request) {
        $data = null;
        $ban = Ban::find($request['id']);
        if ($ban != null) {
            $data['id'] = $ban->id;
            $data['ten_ban'] = $ban->ten_ban;
        }
        include 'views/ban/show.ban.php';
    }

    public function edit($request) {
        $data = null;
        $ban = Ban::find($request['id']);
        if ($ban != null) {
            $data['id'] = $ban->id;
            $data['ten_ban'] = $ban->ten_ban;
        }
        include 'views/ban/edit.ban.php';
    }

    public function update($request) {
        if (!empty($request['ten_ban']) && !empty($request['id'])) {
            $item = Ban::find($request['id']);
            if ($item != null) {
                $item->ten_ban = $request['ten_ban'];
                $item->save();
            }
        }
        redirect('GET_BAN_INDEX');
    }

    public function destroy($request) {
        if (!empty($request['id'])) {
            $item = Ban::find($request['id']);
            if ($item != null) {
                $item->delete();
            }
        }
        redirect('GET_BAN_INDEX');
    }
}