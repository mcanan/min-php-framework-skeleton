<?php
namespace mcanan\app\controllers;

class Users extends \mcanan\framework\BasicController 
{
	function __construct()
    {
		parent::__construct('./app/views/layout.php');
        $this->set('title',  'Work with users');

        $current_user = $this->getSecurity()->getUser();
        $this->set('usuario', $current_user);
	}

    private function setMensaje($error, $mensaje){
        if (!isset($_SESSION)){
            session_start();
        }
        $_SESSION['message']=$mensaje;
        $_SESSION['error']=$error;
    }

	public function index()
    {
        $this->loadModel(['Users']);
        $users =  $this->Users->getAll();

        $this->set('items', $users);
        $this->set('titulo', 'Work with users');
        
        $this->set('item_attributes',
                   	[['attribute'=>'id', 'header'=>'Id', 'tdclass'=>'col-md-1'],
             		 ['attribute'=>'name', 'header'=>'Name', 'tdclass'=>'col-md-4']]
        );
        
		$this->set('item_actions',
            		[["href"=>$this->getFullUrl("/users/view/{id}"),
            		  "description"=>'<i class="fa fa-eye"></i>',
            		  "tdclass"=>"col-md-1"],
            		 ["href"=>$this->getFullUrl("/users/update/{id}"),
            		  "description"=>'<i class="fa fa-pen"></i>',
            		  "tdclass"=>"col-md-1"],
            		 ["href"=>$this->getFullUrl("/users/delete/{id}"),
            		  "description"=>'<i class="fa fa-trash"></i>',
            		  "tdclass"=>"col-md-1",
             		  "onclick"=>"return confirm(\'Remove user with Id \' + {id} + \'?\')"]]
        );

        $this->render_work_with();
    }
    
    public function view($id)
    {
        $this->loadModel(["Users"]);
        $u = $this->Users->getById($id);
        
        $atributos = [];
        $atributos[] = ["type"=>"input", "id"=>"id", "label"=>"Id", "value"=>$u['id']];
        $atributos[] = ["type"=>"input", "id"=>"name", "label"=>"Name", "value"=>$u['name']];

        $this->set('items', $atributos);
            $this->set('breadcrumb', array(
                array("href"=>$this->getFullUrl("/users/"),"description"=>"Users"),
                array("description"=>"View ".$u['name'])
            ));
        $this->set('titulo','View '.$u['name']);

        $this->render_crud_readonly();
    }

    public function new()
    {
        $this->loadModel(["Utils"]);
        $alta = $this->getRequestParameter('alta',false);

        $atributos = [];
        $atributos[] = ["type"=>"input", "id"=>"id", "label"=>"Id"];
        $atributos[] = ["type"=>"input", "id"=>"name", "label"=>"Name"];
        
        $this->set('breadcrumb', array(
            array("href"=>$this->getFullUrl("/users/"),"description"=>"Users"),
            array("description"=>"Add user")
        ));
        $this->set('titulo','Add user');
        $this->set('formActionAceptar',$this->getFullUrl("/users/new"));
        $this->set('formActionCancelar',$this->getFullUrl("/users/"));

        if ($alta){
            $ne = $this->getRequestParameter('id','');
            $da = $this->getRequestParameter('name','');
            
            $ret = $this->Users->insert($id, $name);
            $this->setMensaje(!$ret, $this->Users->error);
            header('Location: /users/');
        } else {
            $this->setMensaje(false, "");
            $this->render_crud();
        }
    }

    public function update($id)
    {
        $modificacion = $this->getRequestParameter('modificacion',false);

        $this->loadModel(["Users"]);
        $u = $this->Users->getById($id);
        
        if ($modificacion){
            $name = $this->getRequestParameter('name','');

            $ret = $this->Users->update($id, $name);
            $this->setMensaje(!$ret, $this->Users->error);
            header('Location: /users/');
        } else {
            $u = $this->Users->getById($id);
            
            $atributos = [];
            $atributos[] = array("type"=>"input", "id"=>"id", "label"=>"Id", "value"=>$u['id']);
            $atributos[] = array("type"=>"input", "id"=>"ne", "label"=>"Name", "value"=>$u['name']);
            $atributos[] = array("type"=>"hidden","id"=>"modificacion", "value"=>"true");

            $this->set('items', $atributos);
            $this->set('breadcrumb', array(
                array("href"=>$this->getFullUrl("/users/"),"description"=>"Users"),
                array("description"=>"Update user")
            ));
            
            $this->set('titulo','Update '.$u['name']);
            $this->set('formActionAceptar',$this->getFullUrl("/users/update/$id"));
            $this->set('formActionCancelar',$this->getFullUrl("/users/"));
            $this->setMensaje(false, "");
            $this->render_crud();
        }
    }
    
    public function delete($id)
    {
        $this->loadModel(array("Users"));
        $ret = $this->Users->delete($id);
        $this->setMensaje(!$ret, $this->Users->error);

        header('Location: /users/');
    }
}
?>
