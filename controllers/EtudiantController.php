<?php
require_once(__DIR__ . '/../models/Etudiant.php');

class EtudiantController {

    // Affiche la liste de tous les étudiants
    public static function index() {
        $etudiants = Etudiant::getAll();
        
        echo "Liste des étudiants (vue non implémentée) :<br>";
        print_r($etudiants);
    }

    // Affiche les détails d'un étudiant spécifique
    public static function show($id) {
        $etudiant = Etudiant::getById($id);
        
        if ($etudiant) {
            echo "Détails de l'étudiant (vue non implémentée) :<br>";
            print_r($etudiant);
        } else {
            echo "Étudiant non trouvé.";
        }
    }

    // Affiche le formulaire d'inscription
    public static function create() {
        
        include __DIR__ . '/../views/register.php';
    }

    // Gère la soumission du formulaire d'inscription
    public static function store() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['role'])) {
                $nom = $_POST['name'];
                $email = $_POST['email'];
                $motdepasse = $_POST['password'];
                $role = $_POST['role']; 

                
                if ($role === 'etudiant') {
                     if (Etudiant::ajouter($nom, $email, $motdepasse)) {
                        
                        
                        echo "Inscription étudiant réussie.";
                        exit();
                    } else {
                        
                        echo "Erreur lors de l'inscription de l'étudiant.";
                    }
                } else {
                     echo "Inscription pour un rôle autre qu'étudiant non gérée ici.";
                     
                     
                }

            } else {
                echo "Données d'inscription incomplètes.";
            }
        }
         
        
    }

    // Affiche le formulaire de connexion
    public static function loginForm() {
         
        include __DIR__ . '/../views/login.php';
    }

    // Gère la soumission du formulaire de connexion
    public static function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            if (isset($_POST['email']) && isset($_POST['password'])) {
                $email = $_POST['email'];
                $motdepasse = $_POST['password'];

                
                
                
                
                
                
                 echo "Logique de connexion non implémentée complètement dans le modèle.";

            } else {
                 echo "Données de connexion incomplètes.";
            }
        }
         
        
    }

    // Affiche le formulaire de soumission de cahier de charge
     public static function submitProjectForm() {
        
        include __DIR__ . '/../views/soumission.php';
     }

    // Gère la soumission du formulaire de cahier de charge
    public static function submitProject() {
         if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            if (isset($_POST['theme']) && isset($_POST['binome'])) {
                $theme = $_POST['theme'];
                $binome = $_POST['binome'];

                
                
                

                echo "Soumission de cahier de charge reçue (logique d'enregistrement non implémentée).";

            } else {
                 echo "Données de soumission incomplètes.";
            }
        }
        
        
    }

     // Affiche le formulaire de modification d'un étudiant
    public static function edit($id) {
         $etudiant = Etudiant::getById($id);
         if ($etudiant) {
            
             echo "Affichage du formulaire de modification pour l'étudiant ID $id (vue non implémentée).";
         } else {
             echo "Étudiant non trouvé pour modification.";
         }
    }

    // Gère la soumission du formulaire de modification d'un étudiant
     public static function update($id) {
         if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            if (isset($_POST['nom']) && isset($_POST['email'])) {
                $nom = $_POST['nom'];
                $email = $_POST['email'];

                if (Etudiant::update($id, $nom, $email)) {
                    
                     echo "Étudiant mis à jour avec succès.";
                    
                    exit();
                } else {
                    echo "Erreur lors de la mise à jour de l'étudiant.";
                }
            } else {
                echo "Données de modification incomplètes.";
            }
        }
     }

     // Potentielle fonction pour supprimer un étudiant (non présente dans le modèle, mais courante)
    // public static function delete($id) {
    //     // Logique de suppression
    //     // Redirection
    // }
} 