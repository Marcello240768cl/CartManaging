#S_SESSION[elem] variabile che aggiorna la stringa elemento aggiunto nel product-cart.php dato come stringa:
#S_SESSION[elem]=$_POST['art_']."*".$_POST['prezzo_']."*".$_POST['img_']."*".$_POST['cat_']."*".$_POST['cod_']."*".$_POST['quantity']; secondo il form con action =post
#$_SESSION['carrello'] variabile che aggiorna il carrello $_SESSION['carrello']=$_REQUEST['carrello'].",".$_SESSION['elem'];
<?
session_start();//variabile che inizializza la sessione
?>

<?
if($_REQUEST['elem']) $_SESSION['elem']=$_REQUEST['elem'];


$_SESSION[righe]=1;
if($_REQUEST['codice'])
$_SESSION['codice']=$_REQUEST['codice'];
if($_REQUEST['carrello']) $_SESSION['carrello']=$_REQUEST['carrello'];
$_SESSION['user']=$_REQUEST['user']; 
if($_REQUEST['categoria'])
$_SESSION['categoria']=$_REQUEST['categoria'];

//if($_REQUEST['nome_articolo'])
$_SESSION['nome_articolo']=$_REQUEST['nome_articolo'];

if(!$_REQUEST['user']){
$user=mt_rand(99999,150000);

$_SESSION['user']=$user;
 
}
if($_REQUEST['codice']) $_SESSION['select']="select * from ".$_SESSION['categoria']."where codice_articolo='". $_SESSION[codice]."'";
else  $_SESSION['select']="select * from ".$_SESSION['categoria'];

?>
 

<?
#Se l' azione e' di inserimento elemento nel carrello trasmesso dal form con azione post
if($_POST['ins_conf_submit'])
{
$_SESSION['elem']=$_POST['art_']."*".$_POST['prezzo_']."*".$_POST['img_']."*".$_POST['cat_']."*".$_POST['cod_']."*".$_POST['quantity'];
if($_REQUEST['carrello']) $_SESSION['carrello']=$_REQUEST['carrello'].",".$_SESSION['elem'];
$carrello=array();
$carrello=explode(",",$_POST['carrello']);
$righe_l=count($carrello);


if(!in_array($_SESSION['elem'],$carrello))
{

#redirezioniamo la pagina con approprito url query aggionata
header('Location:'.$_SERVER[PHP_SELF].'?user='.$_SESSION[user].'&codice='.$_SESSION[codice].'&categoria='.$_SESSION[categoria].'&carrello='.$_SESSION[carrello]);
}

}






?>
 <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
<form  method="post" action='<?=$_SERVER[PHP_SELF];?>' enctype='multipart/form-data'>

<?
$connection2 = @mysqli_connect("localhost", "panificiotragnocl", "");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
@mysqli_select_db($connection2,"my_panificiotragnocl");
$sqlsel= "Select * from Prodotti_de_panificiotragnocl where  codice_articolo='".$_SESSION[codice]."'";

$result=@mysqli_query($connection2,$sqlsel);

if (($row=@mysqli_fetch_array($result,MYSQLI_ASSOC)))
  {

$id_num=$row['id_articolo'];
$prezzo = $row['prezzo_articolo'];
$descrizione = $row['immagine_descrizione'];
$dir_img=$row['dir_immagine'];
$nome_articolo=$row['nome_articolo'];
$codice_articolo=$row['codice_articolo'];
$marca_articolo=$row['marca_articolo'];
$categoria_articolo=$row['categoria_articolo'];
$quantita=$row['quantita'];
$_SESSION['elem']=$nome_articolo."*".$prezzo."*".$categoria_articolo."/".$dir_img."*".$categoria_articolo."*".$codice_articolo."*".$quantita;

?>
                            <img class="product__details__pic__item--large"
                                src="<?=$dir_img;?>" alt="">
                        </div>
              
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                 
                        <div class="product__details__price"><?=$prezzo;?></div>
                        <p><?=$descrizione;?></p>
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" name="quantity" value="<?=$quantita;?>">
                                </div>

               <input  type="hidden"   name='cod_' value='<?=$codice_articolo;?>' ><input  type="hidden"   name='prezzo_' value='<?=$prezzo;?>' ><input  type="hidden"   name='art_' value='<?=$nome_articolo;?>' ><input  type="hidden"   name='img_' value='<?=$dir_img;?>' ><input  type="hidden"   name='cat_' value='<?=$categoria_articolo;?>' ><input  type="hidden"   name='carrello' value='<?=$_SESSION['carrello'];?>,<?=$_SESSION['elem'];?>' >		

                                <input type="submit" name="ins_conf_submit"  class="primary-btn" value="Add to cart">
                            </div>
                        </div>
                    </form>   
                      <!--  <a href="#" class="primary-btn">ADD TO CARD</a>-->
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                      
<?}?>
                    </div>
                </div>