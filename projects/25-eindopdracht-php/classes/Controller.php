<?php
    class Controller{
        private $userModel;
        private articleController $articleController;
        private $twig;
       
        public function __construct($userModel, $twig, $articleController){
            $this->userModel = $userModel;
            $this->articleController = $articleController;
            $this->twig = $twig;
            $lastVisit = $_COOKIE['lastVisit'] ?? null;
            $username = $_SESSION['username'] ?? null;
            $this->twig->addGlobal('lastVisit', $lastVisit);
            $this->twig->addGlobal('username', $username);
        }

        public function loginPage(array $errors = [], string $successMessage = ''): void{
            echo $this->twig->render('login.html', [
                'errors' => $errors,
                'success' => $successMessage,
            ]);
        }

        public function registerPage(array $errors = []): void{
            echo $this->twig->render('register.html', [
                'errors' => $errors,
            ]);
        }

        public function logout(): void {
            session_start();
            session_destroy();
            header('Location: ./home');
            // $this->articleController->home();
            exit;
        }

        protected function requireLogin(): void {
            if (!isset($_SESSION['username'])) {
                header('Location: ./home');
                exit;
            }
        }

        public function login(): void{
            if(isset($_POST['login'])){
                $errors = [];
                $username = $_POST['username'] ?? '';
                $password = $_POST['password'] ?? '';
                if (empty($username)) $errors[] = 'Username is required';
                if (empty($password)) $errors[] = 'Password is required';
                if(empty($errors)){
                    if($this->userModel->verifyUser($username, $password)) {
                        $_SESSION['username'] = $username;
                        header('Location: ./home');
                        exit;
                    }
                    else{
                        $errors[] = 'Wrong username or password';
                    }
                }
            }
            $this->loginPage($errors);
        }

        public function addUser(): void{
            $userCredentials = [];
            $errors = [];
            
            if(empty($_POST['email'])){
                $errors[] = 'Email is required.';
            }
            elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                $errors[] = 'Invalid email.';
            }
            else{
                $userCredentials['email'] = $_POST['email'];
            }
            if(!empty($_POST['username'])){
                $userCredentials['username'] = $_POST['username'];
            }
            else{
                $errors[] = 'Username is required.';
            }
            if(!empty($_POST['password'])){
                $userCredentials['password'] = $_POST['password'];
            }
            else{
                $errors[] = 'Password is required.';
            }
            if(empty($errors)){
                $this->userModel->addUserToXML($userCredentials);
                $this->loginPage([], 'Account created successfully!');
            }
            else{
                $this->registerPage($errors);
            }
        }
    }
?>