<?php  
include_once 'function.php'; 


class inscription{
    

   private $numcarte;
   private $email;
   private $mdp;
   private $mdp2;
   private $bdd;
    
    public function __construct($numcarte,$email,$mdp,$mdp2){
        
        
        $numcarte = htmlspecialchars($numcarte);
        $email = htmlspecialchars($email);
        
        $this->numcarte = $numcarte; 
        $this->email = $email;
        $this->mdp = $mdp;
        $this->mdp2 = $mdp2;
        $this->bdd = bdd();
        
    }
    
    public function verif(){
        $sql='SELECT numcarte ,motdepasse FROM utilisateur';
        $requete = $this->bdd->query($sql);
        while($i=$requete->fetch())
        {
          if($this->numcarte==$i['numcarte'] AND $i['motdepasse']=='000')/*Si le numcarte est bon*/
          {
            $requete->closeCursor();
          $syntaxe = '#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,4}$#'; 
                if(preg_match($syntaxe,$this->email)){ /*email bon*/
                         
                    if(strlen($this->mdp) > 5 AND strlen($this->mdp) < 20 ){ /*Si le mot de passe à le bon format*/
                            
                        if($this->mdp == $this->mdp2){/*Deux mots de passe bon*/
                            return 'ok';
                        }
                        else { /*Mot de passe !=*/
                            $erreur = 'Les mots de passe doivent être identique';
                            return $erreur;
                             }
                    }
                    else {/*Mauvais format du mot de passe*/
                        $erreur = 'Le mot de passe doit contenir entre 5 et 20 caractères';
                        return $erreur;
                         }       
                }
                else { /*email mauvais*/
                    $erreur = "Syntaxe de l'adresse email incorrect ";
                    return $erreur;
                     } 
          }
        }
         /*Numcarte mauvais*/
        $erreur = 'Le numéro de carte n\'existe pas ';
        $requete->closeCursor();
        return $erreur;
                      
    }
    
    
    public function enregistrement(){
        $mdpEnsha1=sha1($this->mdp);
        $sql='UPDATE utilisateur SET motdepasse = :motdepasse, email = :email ,date_inscription = CURDATE() WHERE utilisateur.numcarte = :numcarte';
        $requete = $this->bdd->prepare($sql);
        $requete->execute(array(
            'email' => $this->email,
            'motdepasse' => $mdpEnsha1,
            'numcarte' => $this->numcarte
        ));
        $requete->closeCursor();
        
        return 1; 
       
    }
    
    public function session(){
        $requete = $this->bdd->prepare('SELECT nom ,prenom FROM utilisateur WHERE numcarte = :numcarte');
        $requete->execute(array('numcarte'=>  $this->numcarte));
        $requete = $requete->fetch();
        $_SESSION['nom'] = $requete['nom'];
        $_SESSION['prenom'] = $requete['prenom'];

        $_SESSION['numcarte'] = $this->numcarte;
        
        return 1;
    }
    
    
    
}

