<?php
namespace mcanan\app\controllers;

class Home extends \mcanan\framework\BasicController 
{
	function __construct()
    {
		parent::__construct('./app/views/layout.php');
        $this->set('title',  'Index');

        $current_user = $this->getSecurity()->getUser();
        $this->set('usuario', $current_user);
	}

	public function index()
    {
        $this->render('');
    }
    
    public function logout()
    {
        $this->getSecurity()->logout();
        header('Location: /login');
    }
}
?>
