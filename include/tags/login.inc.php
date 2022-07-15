<?php 
    class login extends taglibrary {
        
        //funzione imposrtatnte
        function injectStyle(){}

        public function login_icon($name,$data,$pars){
            $main=new Template("dhtml/webarch/login-icon.html");
            if(isset($_SESSION['auth']) && isset($_SESSION['user'])){
                if($_SESSION['auth']){
                    $main->setContent("link","logout.php");
                    $main->setContent("login","logout");
                }
            }
            $main->setContent("link","login.php");
            $main->setContent("login","login");
            return $main->get();
        }
    }
?>