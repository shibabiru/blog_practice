<?php

require_once('env.php');

Class Dbc
{
    protected $table_name;

    protected function dbConnect() {
        $host   = DB_HOST;
        $dbname = DB_NAME;
        $user   = DB_USER;
        $pass   = DB_PASS;
        $dsn    = "mysql:host=$host;dbname=$dbname;charset=utf8";
    try {
        $dbh = new \PDO($dsn,$user,$pass,[
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        ]);
        } catch(PDOException $e) {
        echo '接続失敗'. $e->getMessage();
        exit();
        };
        return $dbh;
    }

    public function getAll() {
        $dbh = $this->dbConnect();
        $sql = "SELECT * FROM $this->table_name";
        $stmt = $dbh->query($sql);
        $result = $stmt->fetchall(\PDO::FETCH_ASSOC);
        return $result;
        $dbh = null;
    }

    

    public function getById($id) {
        if(empty($id)) {
        exit('IDが不正です。');
    }
    
        $dbh = $this->dbConnect();
    
        $stmt = $dbh->prepare("SELECT * FROM $this->table_name Where id = :id");
        $stmt->bindValue(':id',(int)$id,\PDO::PARAM_INT);
    
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
    
        if(!$result) {
        exit('ブログがありません。');
    }
        return $result;
    }

    public function delete($id) {
        if(empty($id)) {
            exit('IDが不正です。');
        }
        
            $dbh = $this->dbConnect();
        
            $stmt = $dbh->prepare("DELETE FROM $this->table_name Where id = :id");
            $stmt->bindValue(':id',(int)$id,\PDO::PARAM_INT);
        
            $stmt->execute();
            echo'ブログを削除しました！';
            return $result; 
    }
    
}
?>
