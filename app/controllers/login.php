<?php
namespace mcanan\app\controllers;

class Login extends \mcanan\framework\BasicController 
{
    function __construct()
    {
        parent::__construct('./app/views/layout_vacia.php');
        $this->set('titulo',  'Login');
    }

    public function index()
    {
        $this->loadModel(['Users']);

        $username = null;
        $password = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if(!empty($_POST['u']) && !empty($_POST['p'])) {
                $username = $_POST['u'];
                $password = $_POST['p'];

                if($this->Users->checkPassword($username, $password)) {
                    $this->getSecurity()->login($username);
                    header('Location: /home');
                } else {
                    header('Location: /login');
                }
            } else {
                header('Location: /login');
            }
        } else {
            $this->render('./app/views/login.php');
        }
    }
}
?>
