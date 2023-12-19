#Lista prodotti che visualizzano i prodotti del database 
#$_SESSION[user] :variabilke di sessione utente per identificare l'utente
#$_REQUEST['carrello'] variabile di sessione che aggiorna secondo la richiesta dell' url in shop-detail gli elementi del carrello dato come stringa e separati da virgola ed 
#ogni elemento del carrello dato come sequenza separato da *(vedi product detail

<?
session_start();
?>
<?


if($_REQUEST['elem']) $_SESSION['elem']=$_REQUEST['elem'];


$_SESSION[righe]=1;
if($_REQUEST['codice'])
$_SESSION['codice']=$_REQUEST['codice'];
if($_REQUEST['carrello']) $_SESSION['carrello']=$_REQUEST['carrello'];
$_SESSION['user']=$_REQUEST['user']; 
if($_REQUEST['categoria'])
$_SESSION['categoria']=$_REQUEST['categoria'];else $_SESSION['categoria']="";

if($_REQUEST['nome_articolo'])
$_SESSION['nome_articolo']=$_REQUEST['nome_articolo'];

if(!$_REQUEST['user']){
$user=mt_rand(99999,150000);

$_SESSION['user']=$user;
 
}

?>


<?
 $sqlsel = " SELECT *  FROM  Prodotti";
   



           $dbhost = 'localhost';
   $dbuser = 'user_db';
   $dbpass = 'pass_db';
 //  $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
   $con = mysqli_connect($dbhost, $dbuser, $dbpass);
//$conn = @mysqli_connect($host, $user, $pass, $db) 
        
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
mysqli_select_db($con,'my_db');
$result=@mysqli_query($con,$sqlsel);
while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
  {
  


      ?> 
                                       

                        <div >
                            <div class="product__item">
                                <div class="product__item__pic " data-setbg="<?=$row['dir_immagine'];?>">
                                    
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="shop-details.php?user=<?=$_SESSION[user];?>&codice=<?=$row[codice_articolo];?>&categoria_articolo=<?=$row[categoria_articolo];?>&carrello=<?=$_SESSION[carrello];?>"><?=$row[categoria_articolo];?>:<br><?=$row[nome_articolo];?>"></a></h6>
                                    <h5><?=$row[prezzo_articolo];?></h5>
                                </div>
                            </div>
                        </div>
<?}?>
