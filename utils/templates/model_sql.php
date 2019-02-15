<?php
$result_file = $project_dir."/app/models/".strtolower($model).".php";
$class_name = ucfirst(strtolower($model));
$key_var = "\$$id";
$key = $id;
?>
namespace mcanan\app\models;

class <?= $class_name ?> extends \mcanan\framework\Model
{
    public function getAll($cntPorPagina, $offset)
    {
        $consulta = "select * from <?= strtolower($model) ?> order by id limit $cntPorPagina offset $offset";
        return $this->db->consulta($consulta);
    }
    
    public function getCnt()
    {
        $consulta = "select count(*) from <?= strtolower($model) ?>";
        $ret=$this->db->consulta($consulta);
        return $ret[0][0];
    }

    public function getById(<?= $key_var ?>)
    {
        $consulta = "select * from <?= strtolower($model) ?> where <?= $key ?>='<?= $key_var ?>'";
        $ret = $this->db->consulta($consulta);
        return $ret[0];
    }

    public function insert($descripcion)
    {
        $consulta = "insert into <?= strtolower($model) ?>(descripcion) values ('$descripcion')";
        $res = $this->db->update($consulta);
        if (!$res){
            $this->error = $this->db->getError();
        }
        return $res;
    }

    public function update(<?= $key_var ?>, $descripcion)
    {
        $consulta = "update <?= strtolower($model) ?> set descripcion='$descripcion' where <?= $key ?>='<?= $key_var ?>'";
        $res = $this->db->update($consulta);
        if (!$res){
            $this->error = $this->db->getError();
        }
        return $res;
    }

    public function delete(<?= $key_var ?>)
    {
        $consulta = "delete from <?= strtolower($model) ?> where <?= $key ?>='<?= $key_var ?>'";
        $res = $this->db->update($consulta);
        if (!$res){
            $this->error = $this->db->getError();
        }
        return $res;
    }
}
