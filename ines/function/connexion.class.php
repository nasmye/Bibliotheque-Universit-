<?php 

include_once 'function.php';

class connexion{
    
    private $numcarte; 
    private $mdp;
    private $bdd;
    
    public function __construct($numcarte,$mdp) {
        $this->numcarte = $numcarte;
        $this->mdp = $mdp;
        $this->bdd = bdd();
    }
    
    public function verif(){
        $sql='SELECT * FROM utilisateur WHERE utilisateur.numcarte = :numcarte';
        $requete = $this->bdd->prepare($sql);
        $requete->execute(array('numcarte'=> $this->numcarte));
        $reponse = $requete->fetch();
        if($reponse){
            
            if(sha1($this->mdp) == $reponse['motdepasse'] and $reponse['motdepasse']!='000'){
                return 'ok';
            }
            else {
                $erreur = 'Le mot de passe est incorrect';
                return $erreur;
            }
            
            
        }
        else {
            $erreur = 'Le pseudo est inéxistant';
            return $erreur;
         }
        
        
    }
    
    public function session(){
        $requete = $this->bdd->prepare('SELECT prenom ,nom FROM utilisateur WHERE numcarte = :numcarte ');
        $requete->execute(array('numcarte'=>  $this->numcarte));
        $requete = $requete->fetch();
        $_SESSION['prenom'] = $requete['prenom'];
        $_SESSION['nom'] = $requete['nom'];
        $_SESSION['numcarte'] = $this->numcarte;
        
        return 1;
    }
    
    
}