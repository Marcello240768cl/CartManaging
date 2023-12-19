  <form method='post' action='insert-product.php' enctype='multipart/form-data'>


<br>
<input type="radio" name="menu" value="Prodotti">Prodotti  <input type="radio" name="menu" value="Materieprime">Materie prime
  <!-- CASELLE DI TESTO -->
  Nome articolo
<div id="demo"></div>
 <!-- <input type="text" name="nome">-->
<br>
<?
$codice=mt_rand(999,1000000);
?>
  Codice
  <input type="text" name="codice" value="<?=$codice;?>"><br>

Modello
  <input type="text" name="modello"><br>
 Marca
  <input type="text" name="marca"><br>
Prezzo
  <input type="text" name="prezzo"><br>
Quantita
  <!--<input type="text" name="quantita_articolo"><br>-->
<select name="articolo" ><option value="Prodotto1" >1</option>
<option value="Prootto2" >2</option>
<option value="Prodotto3" >3 </option>
<option value="Prodotto4" >4</option>

</select>
<textarea name="descrizione" cols=9 rows= 7></textarea>
  Immagine
     

 <label>Carica il tuo file Immagine:</label>
          Immagine <input type='file' name='image'>
         


<input type='submit' name="sub_Invio" value='Carica online' />

  







    
          
            
<?php






//define('UPLOAD_DIR', './uploads/');





$upload_dir_img="";

           $dbhost = 'localhost';
   $dbuser = 'db_user;
   $dbpass = 'db_pass';
   $con = mysqli_connect($dbhost, $dbuser, $dbpass);
//$conn = @mysqli_connect($host, $user, $pass, $db) 
        
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

   
if(isset($_POST['sub_Invio']))
{
                $dbhost = 'localhost';
   $dbuser = 'user_db';
   $dbpass = 'pass_db';
   $con = mysqli_connect($dbhost, $dbuser, $dbpass);
        
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

   
         echo 'Connected successfully<br />';
if(isset($_POST['menu'])){
$upload_dir_img="";

           $dbhost = 'localhost';
   $dbuser = 'user_db';
   $dbpass = 'pass_db';
   $con = mysqli_connect($dbhost, $dbuser, $dbpass);
  $menu=$_POST['menu'];echo $menu;
//  if( isset ($_POST[$menu]))
if(($_POST['menu']=="Prodotti")||($_POST['menu']=="Materieprime")){
 $table=$_POST['articolo'];//$_POST[$menu];   
 echo $table; $promo_sub=$menu."/".$table.'/';
         $sql_prodotti = "CREATE TABLE IF NOT EXISTS Prodotti(".
             
             "prezzo_articolo VARCHAR(10) NOT NULL , ".

              "immagine_descrizione VARCHAR(500) NOT NULL , ".
               "dir_immagine VARCHAR(300) NOT NULL , ".

            "nome_articolo VARCHAR(50) NOT NULL , ".
     
"codice_articolo VARCHAR(10) NOT NULL, ".
            "marca_articolo VARCHAR(40) NOT NULL, ".

             "categoria_articolo VARCHAR(100) NOT NULL".

          ");";


mysqli_select_db($con,'my_db');
   $retvalcross = @mysqli_query( $con,$sql_prodotti );
         if(! $retvalcross ) {
      echo 'Could not create table : ';
   } 
}
 //echo $_GET['my_file'];
//move_uploaded_file($_FILES["photo"]["tmp_name"], "uploads/".$menu."/".$table.'/'.$_FILES["photo"]["name"]);
if((isset($_POST['menu']))){


  $menu=$_POST['menu'];echo $menu;//$table=$_POST[$menu]; 
    // echo $table;
 $promo_sub=$menu."/".$_POST['articolo'].'/';echo $promo_sub;
if (!file_exists($promo_sub)) {
    mkdir($promo_sub, 0755, true);
}


// File upload path
$targetDir = $promo_folder;
if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];

      $file_size =$_FILES['image']['size'];   $file_tmp =$_FILES['image']['tmp_name']; $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES[image][name])));
      
      $extensions= array("jpeg","jpg","png");
      
      if(!in_array($file_ext,$extensions)){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
   /*   if($file_size < 19715){
         $errors[]='File size must be excately 19715 bytes';
      }*/
      
     if(empty($errors)==true){
         move_uploaded_file($file_tmp,$promo_sub.$file_name);

         echo "Success";
      }else{
         print_r($errors);
      }
  }

    

  $menu=$_POST['menu'];echo $menu;
//  if( isset ($_POST[$menu]))
if($_POST[articolo]) $nomearticolo=$menu."/".$_POST[articolo]."/";
 //$table=$_POST[$menu];
 $codice_art=$_POST[codice];
 $sqlins = "INSERT INTO Prodotti ".
    "(prezzo_articolo  , ".

              "immagine_descrizione  , ".
               "dir_immagine  , ".

            "nome_articolo  , ".
            "codice_articolo , ".

            "marca_articolo , ".

             "categoria_articolo".

 ) ".
 " VALUES ('$_POST[prezzo]','$_POST[descrizione]','$promo_sub$file_name','$_POST[articolo]','$codice_art','$_POST[marca]','$_POST[menu]','$promo_sub$file_name')";
    $upload_dir_img="";

           $dbhost = 'localhost';
   $dbuser = 'user_db';
   $dbpass = 'pass_db';
   $conn = mysqli_connect($dbhost, $dbuser, $dbpass);  
 mysqli_select_db($conn,'my_db');
   $retval = @mysqli_query(  $conn ,$sqlins);
   
   if(! $retval ) {
      die('Could not enter data: ' );
   }
         mysqli_close($conn);

echo "Data Entry Succesfull!!!/n";
}
}



</form>
</html>
