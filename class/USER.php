<?php
class USER{
    static public function init(){
        session_start();
        session_name("user");
        if(isset($_SESSION['dados'])) USER::loginVerify();
    }
    
    static public function loginVerify(){
        $login = USER::login($_SESSION['dados']['usuario_s'], $_SESSION['dados']['senha_s']);
        if(!$login) USER::logout();
    }
    
    static public function logout(){
        unset($_SESSION['dados']);
    }
    
    static public function login($user, $senha){
        
        $uservar = REST::PrepareSQL($user);
        $password = REST::CryptPassword($uservar, REST::PrepareSQL($senha));
        
        $model = new Model;
        $model->consultarBanco("usuarios", " WHERE uservar='".$uservar."' AND senha='".$password."' ");
        $dados = $model->verDados();
        
        if(empty($dados['usuarios'])) return 0;
        else{
            $_SESSION['dados'] = $dados['usuarios'];
            $_SESSION['dados']['usuario_s'] = $uservar;
            $_SESSION['dados']['senha_s'] = $senha;
            return 1;
        }
    }
    
    static public function register($user, $nome, $email, $token, $senha){
        
        $tk = 10;
        $uservar = REST::PrepareSQL($user);
        $email = REST::PrepareSQL($email);
        $nome = REST::PrepareSQL($nome);
        $password = REST::CryptPassword($uservar, REST::PrepareSQL($senha));
        if($token != $tk) REST::Message(0, "Token de segurança inválido.".$token);
        
        $model = new Model;
        $model->consultarBanco("usuarios", " WHERE uservar='".$uservar."' ");
        $dados = $model->verDados();
        if(!empty($dados['usuarios'])) REST::Message(0, "Usuário indisponível");
        
        $model = new Model;
        $model->consultarBanco("usuarios", " WHERE email='".$email."' ");
        $dados = $model->verDados();
        if(!empty($dados['usuarios'])) REST::Message(0, "E-mail já cadastrado");
        
        $form = Array(
            "uservar" => $uservar,
            "criadoem" => time(),
            "ativo" => 1,
            "nome" => $nome,
            "email" => $email,
            "senha" => $password
        );
        
        $model = new Model;
        $model->inserirTabela("usuarios", $form, true);
        
        $login = USER::login($uservar, $senha);
        return $login;
    }
    
    static public function GET($id){
        return $_SESSION['dados'][$id];
    }
    
}
?>