<?php
namespace TrainingMvc;

class Ban
{
    public $id;
    public $ten_ban;
    private $table = 'bans';
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
            $oldBan = Ban::find($this->id);
            if (null != $oldBan && null != $this->ten_ban) {
                $returnValue = $this->saveForUpdate($oldBan);
            }
        } else {
            if (null != $this->ten_ban) $returnValue = $this->saveForInsert();
        }
        return $returnValue;
    }

    public function delete() {
        $returnValue = null;
        $current = Ban::find($this->id);
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
        $tableName = (new Ban())->getTableName();
        $query = "SELECT * FROM ".$tableName." WHERE id =".$id;
        if ($result = $dbConnection->query($query)) {
            while ($row = $result->fetch_assoc()) {
                $newObj = new Ban();
                $newObj->id = $row['id'];
                $newObj->ten_ban = $row['ten_ban'];
                break;
            }
            $result->free();
        }
        return $newObj;
    }

    public static function all() {
        global $dbConnection;
        $newArray = null;
        $tableName = (new Ban())->getTableName();
        $query = "SELECT * FROM ".$tableName;
        if ($result = $dbConnection->query($query)) {
            while ($row = $result->fetch_assoc()) {
                $newObj = new Ban();
                $newObj->id = $row['id'];
                $newObj->ten_ban = $row['ten_ban'];
                $newArray[] = $newObj;
            }
            $result->free();
        }
        return $newArray;
    }

    private function saveForInsert() {
        $sql = "INSERT INTO ".$this->table." (ten_ban) VALUES (?)";
        $stmt = $this->dbConn->prepare($sql);
        if(!$stmt) return null;
        $stmt->bind_param('s',$this->ten_ban);
        $stmt->execute();
        $newItemId = $stmt->insert_id;
        $stmt->close();
        return $newItemId;
    }

    private function saveForUpdate($old) {
        $sql = "UPDATE ".$this->table." set ten_ban = ? where id = ?";
        $stmt = $this->dbConn->prepare($sql);
        if(!$stmt) return null;
        $stmt->bind_param('si',$this->ten_ban,$old->id);
        $stmt->execute();
        $stmt->close();
        return $this->id;
    }
}