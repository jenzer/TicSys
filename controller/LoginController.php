<?php

include_once "{$_SERVER['DOCUMENT_ROOT']}/controller/FormController.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/model/Customer.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/view/login/LoginInitView.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/view/login/LoginConfirmationView.php";
include_once "{$_SERVER['DOCUMENT_ROOT']}/lib/MysqlAdapter.php";

class LoginController extends FormController {
    
    /**
     * @override
     */
    public function route() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $this->init();
                break;
            case 'POST':
                $this->create();
                break;
            default:
                break;
        }
    }

    protected function init() {
        $view = new LoginInitView();
        $view->notification = $this->notification;
        $view->loginUri = URI_LOGIN;
        $view->validatedUserName = $this->validate('username', true);
        $view->validatedPassword = $this->validate('password', true);
        $view->display();
    }

    protected function create() {
        $log = new \Katzgrau\KLogger\Logger($_SERVER['DOCUMENT_ROOT'] . '/logs/', Psr\Log\LogLevel::INFO);
        if ((!empty($_POST['login'])) && (empty($_POST['name']))) {
            // Form submitted by human
            // validate form
            $valid = true;
            $valid &=!empty($_POST['username']);
            $valid &=!empty($_POST['password']);

            if ($valid) {
                if (preg_match("/" . Customer::USERNAME_REGEX . "/", $_POST['username'])) {
                    $mysqlAdapter = new MysqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                    $customer = $mysqlAdapter->getUserByUsername($_POST['username']);
                    if (($customer instanceof Customer) && ($customer->isPasswordValid($_POST['password']))) {
                        $_SESSION['user_name'] = $customer->getUserName();
                        $_SESSION['customer_name'] = $customer->getFirstName() . " " . $customer->getLastName();
                        setcookie('user_name', $customer->getUserName(), time() + 60 * 60 * 24 * 90, '/');
                        
                        $log->info("Customer successfully logged in: $customer");
                        echo "success";
                        exit();
                    } else {
                        $this->notification = "Benutzername oder Passwort ist falsch.";
                    }
                } else {
                    $this->notification = "Der Benutzername enthält unerlaubte Zeichen.";
                }
            } else {
                $this->notification = "Bitte füllen Sie alle markierten Felder aus.";
            }
            $this->init();
        }
    }

    protected function index() {
        if (preg_match('@/success$@i', $_SERVER['REQUEST_URI'])) {
            // show confirmation page
            $view = new LoginConfirmationView();
            $view->display();
        }
    }

}

