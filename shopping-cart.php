<?
session_start();
?>
<?
//$_SESSION[]=array();
if($_REQUEST['carrello'])  $_SESSION['carrello']=$_REQUEST['carrello'];
if($_REQUEST['categoria'])
$_SESSION['categoria']=$_REQUEST['categoria'];
if($_REQUEST['codice'])
$_SESSION['codice']=$_REQUEST['codice'];
$_SESSION['this_page']=$_SERVER['REQUEST_URI'];
if($_REQUEST['page'])
$_SESSION['page']=$_REQUEST['page'];
$_SESSION[righe]=1;
if($_REQUEST['carrello'])
$_SESSION['carrello']=$_REQUEST['carrello'];
$_SESSION['user']=$_REQUEST['user'];
//$carrello=explode(",",$_SESSION['carrello']);}
$_SESSION['totale']=0;$_SESSION['amount']=0;
?>
<!--$_SESSION['elem']=$_POST['art_']."*".$_POST['prezzo_']."*".$_POST['cat_']."/".$_POST['img_']."*".$_POST['cat_']."*".$_POST['cod_']."*".$_POST['quantity'];-->



<?
if($_REQUEST['choice']=="conferma")
{
//echo $_POST['conferma'];
$x=0;$fatto=false;
$carrello=array();
//$_SESSION['carrello']="";
/*array_search($_SESSION['elem'],$carrello,true);*/
/*while(isset($_REQUEST['codice']))
{
array_push($carrello,$_POST['art_'.$x]."*".$_POST['prezzo_'.$x]."*".$_POST['img_'.$x]."*".$_POST['cat_'.$x]."*".$_POST['cod_'.$x]."*".$_POST[$_POST['cod_'.$x]]."*".$_POST['sel_taglia_'.$x]."*".$_POST['sel_colore_'.$x]);
$x++;
}*/

$elem_arr=array();
$carrello=explode(",",$_SESSION['carrello']);
array_search($carrello[$_REQUEST['conta']],$carrello,true);
$elem=$carrello[$_REQUEST['conta']-1];
$elem_arr=explode("*",$elem);
$elem_arr[5];
$_SESSION['elem']=implode("*",$elem);
$carrello[$_SESSION['conta']]=$_SESSION['elem'];
$carrello=array_values($carrello);
//$_SESSION['carrello']=implode(",",$carrello);
//$carrello= array_values($carrello);
$_SESSION['carrello']=implode(",",$carrello);//echo $_SESSION['carrello'];
header('Location:shopping-cart.php?user='.$_SESSION[user].'&carrello='.$_SESSION[carrello]);

}

?>
<?
if($_REQUEST['choice']=="cancella")
{
//$_SESSION['carrello']=$_REQUEST['carrello'];
//$forma=explode("?",$_SESSION['forma']);


$_SESSION['conta']=$_REQUEST['conta'];
//$_SESSION['elem']=$_SESSION['categoria']."-".$_SESSION['codice']."-".$_SESSION['quantita'];
//$elemento_da_agg=explode("-",$_SESSION['elem']);
//$categoria=$elemento_da_agg[0];
//$codice_agg=$elemento_da_agg[1];
//$quantita_agg=$elemento_da_agg[2];
//$_SESSION['carrello']=$forma[2];
$carrello=explode(",",$_SESSION['carrello']);
unset($carrello[$_SESSION['conta']-1]);
$carrello=array_values($carrello);
$_SESSION['carrello']=implode(",",$carrello);
header('location:shopping-cart.php?user='.$_REQUEST[user].'&carrello='.$_SESSION[carrello]);
}



?> 






<?
$totale=0;
$_SESSION[carrello]=$_REQUEST['carrello'];
$carrello=explode(",",$_SESSION[carrello]);
$conta_righe=0;
foreach($carrello as $carr){


$elemento=explode("*",$carr);
$nome_articolo=$elemento[0];
$prezzo=$elemento[1];
$dir_img=$elemento[2];
$categoria=$elemento[3];
$cod=$elemento[4];
$quantita=$elemento[5];
$conta_righe++;
$quantita=$elemento[5];
if($quantita!=0){
$sub_total=floatval($prezzo)*floatval($quantita);
$totale=$totale+$sub_total;$_SESSION[totale]=$totale;

$_SESSION[totale]=$totale;

?>
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src=<?=$dir_img;?> height="150" width="150" alt="">
                                        <h5><?=$nome_articolo;?></h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                       <?=$prezzo;?>
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="<?=$quantita;?>">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        <?=$totale;?>
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <span >
                                   <a href="shopping-cart.php?choice=cancella&user=<?=$_SESSION[user];?>&codice=<?=$_SESSION[codice];?>&categoria=<?=$_SESSION[categoria];?>&carrello=<?=$_SESSION[carrello];?>">X</a></span>
                               
                                    </td>
                                </tr>
<?}

}?>
