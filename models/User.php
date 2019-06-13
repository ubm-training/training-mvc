<?php
namespace TrainingMvc;

class User
{
    public $id;
    public $ma_nhan_vien;
    public $ho_ten;
    public $so_dien_thoai;
    public $nam_sinh;
    public $email;
    public $ban_id;
    private $table = 'users';
    private $dbConn;

    public function __construct() {
        global $dbConnection;
        $this->dbConn = $dbConnection;
    }

    public function getTableName() {
        return $this->table;
    }

    public function save() {
        $returnValue = null;
        if (null != $this->id && $this->id > 0) {
            $oldUser = User::find($this->id);
            if (null != $oldUser && null != $this->ma_nhan_vien && null != $this->ho_ten) {
                $returnValue = $this->saveForUpdate($oldUser);
            }
        } else {
            if (null != $this->ma_nhan_vien && null != $this->ho_ten) {
                $returnValue = $this->saveForInsert();
            }
        }
        return $returnValue;
    }

    public function delete() {
        $returnValue = null;
        $current = User::find($this->id);
        if (null != $current) {
            $sql = 'DELETE FROM '.$this->table.' WHERE id = ?';
            $stmt = $this->dbConn->prepare($sql);
            if(!$stmt) return null;
            $stmt->bind_param('i',$this->id);
            $stmt->execute();
            $stmt->close();
        }
        return $returnValue;
    }

    public static function find($id) {
        global $dbConnection;
        $newObj = null;
        $tableName = (new User())->getTableName();
        $query = "SELECT * FROM ".$tableName." WHERE id =".$id;
        if ($result = $dbConnection->query($query)) {
            while ($row = $result->fetch_assoc()) {
                $newObj = new User();
                $newObj->id = $row['id'];
                $newObj->ma_nhan_vien = $row['ma_nhan_vien'];
                $newObj->ho_ten = $row['ho_ten'];
                $newObj->so_dien_thoai = $row['so_dien_thoai'];
                $newObj->nam_sinh = $row['nam_sinh'];
                $newObj->email = $row['email'];
                $newObj->ban_id = $row['ban_id'];
                break;
            }
            $result->free();
        }
        return $newObj;
    }

    public static function all() {
        global $dbConnection;
        $newArray = null;
        $tableName = (new User())->getTableName();
        $query = "SELECT * FROM ".$tableName;
        if ($result = $dbConnection->query($query)) {
            while ($row = $result->fetch_assoc()) {
                $newObj = new User();
                $newObj->id = $row['id'];
                $newObj->ma_nhan_vien = $row['ma_nhan_vien'];
                $newObj->ho_ten = $row['ho_ten'];
                $newObj->so_dien_thoai = $row['so_dien_thoai'];
                $newObj->nam_sinh = $row['nam_sinh'];
                $newObj->email = $row['email'];
                $newObj->ban_id = $row['ban_id'];
                $newArray[] = $newObj;
            }
            $result->free();
        }
        return $newArray;
    }

    private function saveForInsert() {
        $fields = " (ma_nhan_vien,ho_ten,so_dien_thoai,nam_sinh,email,ban_id) ";
        $sql = "INSERT INTO ".$this->table.$fields." VALUES (?,?,?,?,?,?)";
        $stmt = $this->dbConn->prepare($sql);
        if(!$stmt) return null;
        $stmt->bind_param('sssssi',$this->ma_nhan_vien,$this->ho_ten,$this->so_dien_thoai,$this->nam_sinh,$this->email,$this->ban_id);
        $stmt->execute();
        $newItemId = $stmt->insert_id;
        $stmt->close();
        return $newItemId;
    }

    private function saveForUpdate($old) {
        $fields = " ma_nhan_vien=?,ho_ten=?,so_dien_thoai=?,nam_sinh=?,email=?,ban_id=? ";
        $soDienThoai = (null != $this->so_dien_thoai)?$this->so_dien_thoai:$old->so_dien_thoai;
        $namSinh = (null != $this->nam_sinh)?$this->nam_sinh:$old->nam_sinh;
        $email = (null != $this->email)?$this->email:$old->email;
        $banId = (null != $this->ban_id)?$this->ban_id:$old->ban_id;
        $sql = "UPDATE ".$this->table." set ".$fields." where id = ?";
        $stmt = $this->dbConn->prepare($sql);
        if(!$stmt) return null;
        $stmt->bind_param('sssssii',$this->ma_nhan_vien,$this->ho_ten,$soDienThoai,$namSinh,$email,$banId,$old->id);
        $stmt->execute();
        $stmt->close();
        return $this->id;
    }
}