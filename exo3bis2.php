<?php 
session_start(); 
include("fonction_exo3bis2.php");
?>

<html>

	<head>
    <?php

            $formvalide=false;
            $erreurNumV="";
            $erreurEntier="";
            $erreurNombre="";

			if (isset($_POST['valider'])) {

               
                if (isset($_POST['mots'])){
                    $_POST['nb_de_mots']=$_SESSION['nb_de_mots'];
                }

				if(empty($_POST['nb_de_mots'])){
					$erreurNumV= " ( Veuillez renseigner ce champ !!! )";
                }

                elseif (!(is_number($_POST['nb_de_mots']))) {
                  $erreurNombre= " ( Veuillez entrer un entier positif !!! )";
                }
                elseif (!(is_entier($_POST['nb_de_mots']-1))) {
                    $erreurEntier= " ( Nombre de champ limité à 10 !!! )";
                  }
                

                else{
                    $formvalide=true;
                    $_SESSION['nb_de_mots']=$_POST['nb_de_mots'];
                    $nb_de_mots=$_POST ['nb_de_mots'];
                    for ($i=0; $i < $nb_de_mots; $i++) { 
                        $erreurVide[$i]="";
                        $erreurAlpha[$i]="";
                        $erreurLen[$i]="";
                    }
                   
                    if (isset($_POST['mots'])) {
                        
                        $e=0;
                        for ($i=0; $i < $nb_de_mots ;$i++) {

                            if(empty($_POST['mots'][$i])){
                                $erreurVide[$i]= " ( Veuillez renseigner ce champ !!! )";
                                $e++;
                            }

                            elseif (!(is_valide($_POST['mots'][$i]))) {
                                $erreurAlpha[$i]= " ( Veuillez entrer des lettres uniquement !!! )";
                                $e++;
                            }
                            elseif (my_strlen($_POST['mots'][$i])>20) {
                                $erreurLen[$i]= " ( Mot trop long !!! )";
                                $e++;
                            }
                            
                        } 
                        if ( $e==0) {
                          
                            $n=0;
                            for ($i=0; $i < $nb_de_mots ;$i++) {
                                
                                if (is_char_in_string("m",$_POST['mots'][$i])) {
                                    $n++;                                
                                }

                            }
                            $resultat= "Vous avez saisi ".$nb_de_mots." mot(s) dont ".$n." avec la lettre M";
                                
                        } 
                    } 
                       


                }


			
			}

			?>
		<title>exo3</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="StyleExo1.css" />
	</head>

	<body>
		<div class="milieu">
            
		<form action="" method="POST">
            <p>Donner le nombre de mots :</p>
            <?php
            echo ''.$erreurNumV.' '.$erreurNombre.''.$erreurEntier.'';
            ?>
            <div><input type="text" name="nb_de_mots" placeholder=" <?php if(isset($_POST["nb_de_mots"])){echo $_POST["nb_de_mots"];}else echo "Entrer un nombre"; ?>"></div><br/><br/><br/>  
            <?php
                        
            if($formvalide){
                       
                for ($i=0; $i < $nb_de_mots ;$i++) {
                    $k=$i+1;
                    echo '<p>Mot N*'.$k.' :</p>'.$erreurVide[$i].' '.$erreurAlpha[$i].' '.$erreurLen[$i].'';
                    ?>
                        
                    <div><input type="text" name="mots[]" value="<?php if(isset($_POST["mots"][$i])){echo $_POST["mots"][$i];}?>" placeholder=" Entrer un mot" ></div><br/><br/><br/>
                    <?php
                } 
                
            }
            ?>
            <div><input type="submit" name="valider" value="Valider"></div><br/>
			
			
        </form>	
            
            <?php 
                if (isset($resultat)) {
                    echo "<p>".$resultat."<p>";
                }
            ?>
						 
		</div>
	</body> 
</html>
