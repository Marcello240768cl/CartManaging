b#S_SESSION[elem] variabile che aggiorna la stringa elemento aggiunto nel product-cart.php dato come stringa:
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
if($_POST['ins_conf_submit'])
{
$_SESSION['elem']=$_POST['art_']."*".$_POST['prezzo_']."*".$_POST['img_']."*".$_POST['cat_']."*".$_POST['cod_']."*".$_POST['quantity'];
//if($_REQUEST['carrello']) $_SESSION['carrello']=$_REQUEST['carrello'].",".$_SESSION['elem'];
$carrello=array();
$carrello=explode(",",$_SESSION['carrello']);
$righe_l=count($carrello);
#Se il carrello è vuoto
if($righe_l==0) {$_SESSION['carrello']=$_SESSION['elem'];header('Location:product-detail.php?user='.$_REQUEST[user].'&carrello='.$_SESSION[carrello]);}
#altrimenti
else{
      $fatto=false;

      foreach($carrello as $carr)
        {

                      $elemento=explode("*",$carr);
                      $nome_articolo=$elemento[0];
                      $prezzo=$elemento[1];
                      $dir_img=$elemento[2];
                      $categoria=$elemento[3];
                      $cod=$elemento[4];
                      $quantita=$elemento[5];



            if($quantita!=0){


             #Se l'elemento del carrello ha codice diverso da quello dell' elemento da aggiungere
             if($cod!=$_POST['cod_']) 
              {
                #vai avanti nella scansione di tutti gli elemeneti del carrello
                $fatto=false;continue;
              }
             #se l'ha trovato esci dal loop for
             else { 
                $fatto=true;break;
                   }
                            }
         }
#Se l' elemento da aggiungere non fa parte del carrello
if($fatto==false){array_push($carrello,$_SESSION['elem']);$carrello=array_values($carrello);
$_SESSION['carrello']=implode(",",$carrello);//$_SESSION['carrello']=$_SESSION['carrello'].",".$_SESSION[elem];
header('location:product-detail.php?user='.$_SESSION[user].'&carrello='.$_SESSION[carrello]);}
#altrimenti
else{
$carr_elem="";
$quantita_elem=strval($_POST['quantity']+$elemento[5]);//$carr_elem=$carr;
$_SESSION[elem]=$_POST['art_']."*".$_POST['prezzo_']."*".$_POST['img_']."*".$_POST['cat_']."*".$_POST['cod_']."*".$quantita_elem."*".$_POST['peso_'];//."*".$_POST['sel_taglia_'];
$carrello=explode(",",$_SESSION['carrello']);
unset($carrello[array_search($carr,$carrello)]);
$carrello=array_values($carrello);
$_SESSION['carrello']=implode(",",$carrello);$_SESSION['carrello']=$_SESSION['carrello'].",".$_SESSION[elem];
#redireziona alla pagina corrente e aggiorna il carrello nella stringa  dati
header('location:product-detail.php?user='.$_SESSION[user].'&carrello='.$_SESSION[carrello]);

}


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
$connection2 = @mysqli_connect("localhost", "user_db", "");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
@mysqli_select_db($connection2,"my_db");
$sqlsel= "Select * from Prodotti where  codice_articolo='".$_SESSION[codice]."'";

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
