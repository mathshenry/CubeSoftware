<?php
function Allowed($crud, $op){

    $users_path="../users/";
    $profiles_path="../profiles/";
    $bills_path="../bills/";
    $rooms_path="../rooms/";
    $tasks_path="../tasks/";
    $stocks_path="../stocks/";
    $historys_path="../historys/";
    switch($crud){
        case 'users':
            $users_path="";
            break;
        case 'profiles':
            $profiles_path="";
            break;
        case 'bills':
            $bills_path="";
            break;
        case 'rooms':
            $rooms_path="";
            break;
        case 'tasks':
            $tasks_path="";
            break;
        case 'stocks':
            $stocks_path="";
            break;
        case 'historys':
            $historys_path="";
            break;
        default:
    }
        
    $usr = simplexml_load_file($users_path."usuarios.xml");
    $profiles = simplexml_load_file($profiles_path."profiles.xml");

    $usrperfil;
    if (isset($_SESSION['login_user'])){
        foreach ($usr->usuario as $user) {
            if(!strcmp(strval($user->usuario),
                $_SESSION['login_user'])){
                $usrperfil=$user->perfil;
                break;
            }
        }
        foreach ($profiles->perfil as $perfil) {
            if(!strcmp(strval($perfil->nome), $usrperfil)){
                
                switch($crud){
                    case 'profiles':
                        $param1=(string)$perfil->perfis;
                        break;
                    case 'users':
                        if(isset($_GET['user'])) $username=$_GET['user'];
                        elseif(isset($_POST['user'])) $username=$_POST['user'];
                        if($_SESSION['login_user']==$username)
                            return true;
                        $param1=(string)$perfil->usuarios;
                        break;
                    case 'tasks':
                        $param1=(string)$perfil->tarefas;
                        break;
                    case 'bills':
                        $param1=(string)$perfil->contas;
                        break;
                    case 'rooms':
                        $param1=(string)$perfil->quartos;
                        break;
                    case 'stocks':
                        $param1=(string)$perfil->estoques;
                        break;
                    case 'historys':
                        $param1=(string)$perfil->historicos;
                        break;
                    default:
                        return false;
                }

                if($op=='write' || $op=='update') 
                    $param2='Escrita';
                elseif($op=='read') 
                    $param2='Leitura';

                if(strpos($param1,$param2)!==false)
                    return true;
                break;
            }
        }
    // Funcionalidades anônimas
    } else {
       if($crud=='users' && $op=='create') return true;
    }
    return false;
}
?>
