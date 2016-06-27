<?php

//troque esse caminho pelo caminho pelo caminho do site
//no seu computador a partir da pasta raiz do servidor.
//
//Ex.: 
//    servidor:   C:\wamp64\www\
//    site:       C:\wamp64\www\cuberep\CubeSoftware\
//
//    resulta em: $local_path="/cuberep/CubeSoftware/";

$local_path = "/cuberep/CubeSoftware/";

function get_month($mn){
    $month="";
    switch($mn){
        case '1':
            $month= "Janeiro";
            break;
        case '2':
            $month= "Fevereiro";
            break;
        case '3':
            $month= "Março";
            break;
        case '4':
            $month= "Abril";
            break;
        case '5':
            $month= "Maio";
            break;
        case '6':
            $month= "Junho";
            break;
        case '7':
            $month= "Julho";
            break;
        case '8':
            $month= "Agosto";
            break;
        case '9':
            $month= "Setembro";
            break;
        case '10':
            $month= "Outubro";
            break;
        case '11':
            $month= "Novembro";
            break;
        case '12':
            $month= "Dezembro";
            break;
        default:
        }
    return $month;
}

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
                        $username="";
                        if(isset($_GET['detalhes'])) $username=$_GET['detalhes'];
                        elseif(isset($_GET['user'])) $username=$_GET['user'];
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
                    case 'complaints':
                        $param1=(string)$perfil->reclam;
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

function load_names(){

    $users=simplexml_load_file("../users/usuarios.xml");
    foreach($users as $user){
        $names[]=strval($user->nome);
    }
    $nameslist=json_encode($names);
    ?>
    <script> var names = <?php echo $nameslist; ?>; </script>
    <?php
}

function UserHasActiveBill(){
    $user=$_GET['user']; $name;
    $users=simplexml_load_file("usuarios.xml");
    foreach($users as $usr){
        if ($usr->usuario==$user){
            $name=$usr->nome;
            break;
        }
    }

    $bills=simplexml_load_file("../bills/bills.xml");
    foreach($bills as $bill){
        echo "<h1>".$bill->usuresp."</h1>";
        echo "<h1>".$name."</h1>";
        if (strval($bill->usuresp)==$name && 
            strval($bill->status=="Pendente")){
            return true;
        }
    }
    return false;
}

function FilterPass($crud,$entity){
    $S=true;
    switch($crud){
        case "bills":
            if(isset($_GET['respuser'])){
                if(strval($entity->usuresp)!=$_GET['respuser'])
                    $S=false;
            }
            if(isset($_GET['status'])){
                if(strval($entity->status)!=$_GET['status'])
                    $S=false;
            }
            if(isset($_GET['tipo'])){
                if(strcmp($_GET['tipo'],"Todos"))
                    if(strval($entity->tipo)!=$_GET['tipo'])
                        $S=false;
            }
            if(isset($_GET['start'])){
                $start=date_to_val($_GET['start']);
                $data=date_to_val($entity->vencimento);
                if($data<$start)
                    $S=false;
            }
            if(isset($_GET['end'])){
                if(strcmp($_GET['end'],"")){
                    $end=date_to_val($_GET['end']);
                    $data=date_to_val($entity->vencimento);
                    if($data>$end)
                        $S=false;
                }
            }
            break;
        case "tasks":
            if(isset($_GET['respuser'])){
                if(strval($entity->usuresp)!=$_GET['respuser']
                    && $_GET['respuser']!="")
                    $S=false;
            }
            if(isset($_GET['status'])){
                if(strval($entity->status)!=$_GET['status'])
                    $S=false;
            }
            if(isset($_GET['start'])){
                $start=10000*date_to_val($_GET['start']);
                $data=date_to_val($entity->cdata);
                if($data<$start)
                    $S=false;
            }
            if(isset($_GET['end'])){
                if(strcmp($_GET['end'],"")){
                    $end=10000*date_to_val($_GET['end']);
                    $data=date_to_val($entity->cdata);
                    if($data>$end)
                        $S=false;
                }
            }
            break;
        default:
        }
   return $S;
}

function date_to_val($date){
        
        $outputstr = substr(strval($date),6,4).
            substr(strval($date),3,2).
            substr(strval($date),0,2);
        if (strlen($date)>10){
            $outputstr.= substr(strval($date),11,2).
            substr(strval($date),14,2);
        }
        return intval($outputstr);
}

function datecmp($date1, $date2){
    if(strlen($date1)<11) $date1.=" 0000";
    if(strlen($date2)<11) $date2.=" 0000";
    $date1 = intval(date_to_val($date1));
    $date2 = intval(date_to_val($date2));
    return ($date2-$date1);
}

function fill_gaps(&$data){

    $atp=array();
    $previous=0;
    foreach($data as $d=>$v){
        if($previous==0){
            $previous=intval($d);
            continue;
        }
        $prev_year=floor($previous/100);
        $gap=12*(floor(intval($d)/100)-$prev_year)
            +intval($d)%100-$previous%100;
        if($gap>1){
            $em=$previous+1;
            if($em%100>=13)
                $em+=100-12;
            while($em<intval($d)){
                $atp[$em]=0.0;
                $em++;
                if($em%100>=13)
                    $em+=88;
            }
        }
        $previous=intval($d);
    }
    $data=$data+$atp;
    ksort($data);
}

function addhistory($user){

    $hist = simplexml_load_file('historys.xml');

    $newhistory=$hist->addChild('historico');
    $newhistory->addChild('usuario', $user);

    $newabstract=$newhistory->addChild('resumo');
    $newabstract->addChild('quarto', 0);
    $newabstract->addChild('contas', 0);
    $newabstract->addChild('tarefas', 0);
    $newabstract->addChild('reclam', 0);

    $newhistory->addChild('log');

    $hist->asXML('historys.xml');  

    echo "history added";
}

?>
