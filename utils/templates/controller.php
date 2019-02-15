<?php
$result_file = $project_dir."/app/controllers/".strtolower($controller).".php";
$class_name = ucfirst(strtolower($controller));
$model = ucfirst(strtolower($model));
$controller = ucfirst(strtolower($controller));
$controller_lowercase = strtolower($controller);
$controller_singular = ucfirst(strtolower($controller_singular));
$key_var = "\$$id";
$key = $id;
$security = ($auth==1);
?>
namespace mcanan\app\controllers;

class <?= $class_name ?> extends <?= $extends ?> 
{
    function __construct()
    {
        parent::__construct("./app/views/layout.php");
        $this->set('titulo',  'Gestión de <?= $controller ?>');
    }

    public function gestion()
    {
        $this->loadModel([("<?= $model ?>")]);
        $this->set('titulo', 'Gestión de <?= $controller ?>');
<?php if ($security) { ?>
        $user = $this->getSecurity()->getUser();
<?php } ?>

        $this->loadLibrary([("Pagination")]);
        $p = $this->getRequestParameter('p','1');
        $cntPorPagina = 20;
        $offset = ($p-1)*$cntPorPagina;
        $cnt = $this-><?= $model ?>->getCnt();
        $this->Pagination->init($cntPorPagina, $p, $cnt, "/<?= $controller_lowercase ?>/gestion");
        $this->set('Pagination', $this->Pagination);

        $this->set('items',  $this-><?= $model ?>->getAll(, $cntPorPagina, $offset));

        $this->set('breadcrumb', [
            ["href"=>"/<?= $controller_lowercase ?>/gestion","description"=>"<?= $controller ?>"]
        ]);

        $this->set('item_attributes', [
            ["attribute"=>"descripcion"]
        ]);

        // actions: href, class, description
        $this->set('actions', [
            ["href"=>$this->getFullUrl("/<?= $controller_lowercase ?>/alta"),
            "description"=>"Nuevo", 
            "class"=>"btn btn-primary btn-sm active"]
        ]);

        // pagination

        // item_actions: href, class, onclick, description
        $this->set('item_actions', [
            ["href"=>$this->getFullUrl("/<?= $controller_lowercase ?>/modificacion/{<?= $key ?>}"),
            "description"=>'<i class="glyphicon glyphicon-pencil"></i>',
            "td-class"=>"col-md-1"],
            ["href"=>$this->getFullUrl("/<?= $controller_lowercase ?>/baja/{<?= $key ?>}"),
            "description"=>'<i class="glyphicon glyphicon-trash"></i>',
            "td-class"=>"col-md-1"]
        ]);
        
        $this->render_work_with();
    }

    public function ver(<?= $key_var ?>)
    {
        $this->loadModel(["<?= $model ?>"]);
        $entidad = $this-><?= $model ?>->getById(<?= $key_var ?>);
<?php if ($security) { ?>
        $user = $this->getSecurity()->getUser();
<?php } ?>

        $atributos = [];
        $atributos[] = ["type"=>"input","id"=>"d",
                             "label"=>"Descripción",
                             "placeholder"=>"descripción",
                             "size"=>"50",
                             "value"=>$entidad['descripcion']];

        $botones = [];
        $botones[] = ["action"=>$this->getFullUrl("/<?= $controller_lowercase ?>/modificacion/<?= $key_var ?>"),"label"=>"Modificar"];
                             
        $this->set('items', $atributos);
            $this->set('breadcrumb', [
                [("href"=>"/<?= $controller_lowercase ?>/gestion","description"=>"<?= $controller ?>"],
                [("description"=>"Ver ".$entidad['descripcion']]
            ]);
        $this->set('buttons', $botones);
        $this->set('titulo','Ver <?= $controller_singular ?>');

        $this->render_crud_readonly();
    }

    public function alta()
    {
        $alta = $this->getRequestParameter('alta',false);
        $d = $this->getRequestParameter('d','');
<?php if ($security) { ?>
        $user = $this->getSecurity()->getUser();
<?php } ?>

        // types: hidden, readonly, date, select, money, password, input
        $atributos = [];
        $atributos[] = ["type"=>"input", "id"=>"d", "label"=>"Descripción", "placeholder"=>"descripción", "size"=>"50", "maxlength"=>"50"];
        $atributos[] = ["type"=>"hidden","id"=>"alta", "value"=>"true"];

        $this->set('items', $atributos);
        $this->set('breadcrumb', [
            ["href"=>"/<?= $controller_lowercase ?>/gestion","description"=>"<?= $controller ?>"],
            ["description"=>"Alta de <?= $controller_singular ?>"]
        ]);
        $this->set('titulo','Agregar <?= $controller_singular ?>');
        $this->set('formActionAceptar',$this->getFullUrl("/<?= $controller_lowercase ?>/alta"));
        $this->set('formActionCancelar',$this->getFullUrl("/<?= $controller_lowercase ?>/gestion"));

        if ($alta){
            $this->loadModel("<?= $model ?>");
            $ret=$this-><?= $model ?>->insert($d);
            if ($ret==1){
                $this->setMensaje(false, "Se agregó <?= $controller_singular ?>.");
            } else {
                $this->setMensaje(true, "No se pudo agregar <?= $controller_singular ?>.<br><br>".$this-><?= $model ?>->error);
            }
        } else {
            $this->setMensaje(false, "");
        }
        $this->render_crud();
    }

    public function baja(<?= $key_var ?>)
    {
        if ($id!=''){
<?php if ($security) { ?>
            $user = $this->getSecurity()->getUser();
<?php } ?>
            $this->loadModel(["<?= $model ?>"]);
            $ret = $this-><?= $model ?>->delete(<?= $key_var ?>);
            if ($ret==1){
                $this->setMensaje(false, "Se borró <?= $controller_singular ?>.");
            } else {
                $this->setMensaje(true, "No se pudo borrar <?= $controller_singular ?>.<br>".$this-><?= $model ?>->error);
            }
        }
        $this->gestion();
    }

    public function modificacion(<?= $key_var ?>)
    {
        $modificacion = $this->getRequestParameter('modificacion',false);
        $descripcion = $this->getRequestParameter('d','');
        $this->loadModel(["<?= $model ?>"]);
<?php if ($security) { ?>
        $user = $this->getSecurity()->getUser();
<?php } ?>

        if ($modificacion){
            $ret = $this-><?= $model ?>->update(<?= $key_var ?>,$descripcion);
            if ($ret==1){
                $this->setMensaje(false, "Se modificó <?= $controller_singular ?>.");
            } else {
                $this->setMensaje(true, "No se pudo modificar <?= $controller_singular ?>.<br>".$this-><?= $model ?>->error);
            }
            $this->gestion();
        } else {
            $entidad = $this-><?= $model ?>->getById(<?= $key_var ?>);

            $atributos = [];
            $atributos[] = ["type"=>"input",
            "id"=>"d",
            "label"=>"Descripción", 
            "placeholder"=>"descripción",
            "value"=>$entidad['descripcion']];
            $atributos[] = ["type"=>"hidden",
            "id"=>"modificacion",
            "value"=>"true"];

            $this->set('items', $atributos);
            $this->set('breadcrumb', [
                ["href"=>"/<?= $controller_lowercase ?>/gestion","description"=>"<?= $controller ?>"],
                ["description"=>"Modificación de ".$entidad['descripcion']]
            ]);
            $this->set('titulo','Modificar <?= $controller ?>');
            $this->set('formActionAceptar',$this->getFullUrl("/<?= $controller_lowercase ?>/modificacion/<?= $key_var ?>"));
            $this->set('formActionCancelar',$this->getFullUrl("/<?= $controller_lowercase ?>/gestion"));
            $this->setMensaje(false, "");
            $this->render_crud();
        }
    }
}
