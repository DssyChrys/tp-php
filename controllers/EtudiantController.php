<?php
require_once(__DIR__ . '/../models/etudiant.php');
require_once(__DIR__ . '/../models/projet.php');

class EtudiantController {
    public static function create() {
        include dirname(__DIR__) . '/views/register.php';
    }
    

    public static function store() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
                $nom = $_POST['name'];
                $email = $_POST['email'];
                $motdepasse = $_POST['password'];

                Etudiant::ajouter($nom, $email, $motdepasse);
                echo "<script>
                        alert('Inscription réussie.');
                        window.location.href = '/tp_php/public/login'; 
                     </script>";
                exit();

            } else {
                echo "Données d'inscription incomplètes.";
            }
        }     
    }


    public static function loginForm() {
         
        include __DIR__ . '/../views/login.php';
    }

    public static function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['email']) && isset($_POST['password'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];
    
                $etudiant = Etudiant::getByEmail($email);
    
                if ($etudiant) {
                    if (password_verify($password, $etudiant['password'])) {
                        session_start();
                        $_SESSION['etudiant_id'] = $etudiant['id'];
                        $_SESSION['etudiant_nom'] = $etudiant['nom'];
                        $_SESSION['etudiant_role'] = $etudiant['role']; 
    
                        if ($etudiant['role'] === 'admin') {
                            header("Location: /tp_php/public/affectation");
                            exit();
                        } else {
                            header("Location: /tp_php/public/soumission");
                            exit();
                        }
                    } else {
                        echo "Mot de passe incorrect.";
                    }
                } else {
                    echo "Email non trouvé.";
                }
            } else {
                echo "Données de connexion incomplètes.";
            }
        } else {
            self::loginForm();
        }
    }
    
    
    public static function submitProject() {
        session_start();
    
        if (!isset($_SESSION['etudiant_id'])) {
            echo "Vous devez être connecté pour soumettre un projet.";
            exit();
        }
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['theme'], $_POST['binome'], $_POST['filiere'])) {
                $theme = trim($_POST['theme']);
                $binomeNom = trim($_POST['binome']);
                $filiere = trim($_POST['filiere']);
                $etudiantId = $_SESSION['etudiant_id'];
    
                $binome = Etudiant::getByName($binomeNom);
                if ($binome) {
                    $binomeId = $binome['id'];
                    $isBinomeDejaPris = Projet::estBinomePris($binomeId);

                    if ($isBinomeDejaPris) {
                        echo "Cet étudiant est déjà binôme dans un autre projet.";
                        exit();
                    }
    
                    $success = Projet::ajouter($theme, $etudiantId, $binomeId, $filiere);
    
                    if ($success) {
                        // Redirection après succès
                        header("Location: /tp_php/public/soumission");
                        exit();
                    } else {
                        echo "Erreur lors de l'enregistrement du projet.";
                    }
                } else {
                    echo "Le binôme spécifié n'a pas de compte sur l'application.";
                }
            } else {
                echo "Données de soumission incomplètes.";
            }
        } else {
            self::submitProjectForm();
        }
    }
    
    




















    public static function index() {
        $etudiants = Etudiant::getAll();
        
        echo "Liste des étudiants (vue non implémentée) :<br>";
        print_r($etudiants);
    }

    public static function show($id) {
        $etudiant = Etudiant::getById($id);
        
        if ($etudiant) {
            echo "Détails de l'étudiant (vue non implémentée) :<br>";
            print_r($etudiant);
        } else {
            echo "Étudiant non trouvé.";
        }
    }

    

    // Affiche le formulaire de connexion
    

    // Affiche le formulaire de soumission de cahier de charge
     public static function submitProjectForm() {
        
        include __DIR__ . '/../views/soumission.php';
     }

    // Gère la soumission du formulaire de cahier de charge
   
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