<?php
namespace mcanan\app\models;

class Users extends \mcanan\framework\Model
{
    private $users = [['id'=> 1, 'name'=>'admin', 'passwd'=>'admin'],
                      ['id'=> 2, 'name'=>"user1", 'passwd'=>'user1'],
                      ['id'=> 3, 'name'=>"user2", 'passwd'=>'user2']];

    public function getAll()
    {
        /*
        $consulta = "select * from users";
        return $this->db->consulta($consulta);
        */

        return $this->users;
    }
    
    public function getCnt($usuario)
    {
        
        /*
        $consulta = "select count(*) from users";
        $ret = $this->db->consulta($consulta);
        return $ret[0][0];
        */

        return count($this->users);
    }

    public function getById($id)
    {
        /*
        $consulta = "select * from users where id=$id";
        $ret = $this->db->consulta($consulta);
        return $ret[0];
         */

        foreach ($this->users as $u) {
            if ($u['id']==$id){
                return $u;
            }
        }
        return false;
    }

	public function insert($name)
    {
        /*
		$consulta = "insert into users(name) values ('$name')";
        $res = $this->db->update($consulta);
        if (!$res){
            $this->error = $this->db->getError();
        }
        return $res;
		*/

		$this->error = "Not implemented";
		return false;
    }

    public function update($id, $name)
    {
        /*
		$consulta = "update users set name='$name' where id=$id";
        $res = $this->db->update($consulta);
        if (!$res){
            $this->error = $this->db->getError();
        }
        return $res;
		*/

		$this->error = "Not implemented";
		return false;
    }

    public function delete($id)
    {
		/*
        $consulta = "delete from users where id=$id";
        $res = $this->db->update($consulta);
        if (!$res){
            $this->error = $this->db->getError();
        }
        return $res;
		*/

		$this->error = "Not implemented";
		return false;
    }

    public function checkPassword($username, $password)
    {
        if ($username=='admin' && $password=='admin') {
            return true;
        } else {
            return false;
        }
    }
}
?>
