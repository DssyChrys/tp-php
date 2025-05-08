<?php
require_once(__DIR__ . '/../models/Enseignant.php');

class EnseignantController {

    // Affiche la liste de tous les enseignants
    public static function index() {
        $enseignants = Enseignant::getAll();
        // Ici, on inclurait normalement une vue pour afficher les enseignants
        // Par exemple : include __DIR__ . '/../views/enseignants/index.php';
        // Pour l'instant, affichons simplement les données.
        echo "Liste des enseignants (vue non implémentée) :<br>";
        print_r($enseignants);
    }

    // Affiche les détails d'un enseignant spécifique
    public static function show($id) {
        $enseignant = Enseignant::getById($id);
        // Ici, on inclurait normalement une vue pour afficher les détails de l'enseignant
        // Par exemple : include __DIR__ . '/../views/enseignants/show.php';
        if ($enseignant) {
            echo "Détails de l'enseignant (vue non implémentée) :<br>";
            print_r($enseignant);
        } else {
            echo "Enseignant non trouvé.";
        }
    }

    // Gère la soumission du formulaire d'ajout d'un enseignant
    public static function store() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Assurez-vous que les champs nécessaires existent et sont gérés correctement
            if (isset($_POST['nom']) && isset($_POST['domaines'])) {
                $nom = $_POST['nom'];
                // Gérer les domaines, en supposant qu'ils arrivent sous forme de tableau ou string
                $domaines = is_array($_POST['domaines']) ? implode(',', $_POST['domaines']) : $_POST['domaines'];

                if (Enseignant::ajouter($nom, $domaines)) {
                    // Rediriger après succès
                    // header("Location: ../views/enseignants/index.php"); // Adapter la redirection si nécessaire
                    echo "Enseignant ajouté avec succès.";
                    exit();
                } else {
                    // Gérer l'erreur
                    echo "Erreur lors de l'ajout de l'enseignant.";
                }
            } else {
                 echo "Données du formulaire incomplètes.";
            }
        }
    }

    // Gère la soumission du formulaire de modification d'un enseignant
    public static function update($id) {
         if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Assurez-vous que les champs nécessaires existent et sont gérés correctement
            if (isset($_POST['nom']) && isset($_POST['domaines'])) {
                $nom = $_POST['nom'];
                 // Gérer les domaines, en supposant qu'ils arrivent sous forme de tableau ou string
                $domaines = is_array($_POST['domaines']) ? implode(',', $_POST['domaines']) : $_POST['domaines'];

                if (Enseignant::update($id, $nom, $domaines)) {
                    // Rediriger après succès
                    // header("Location: ../views/enseignants/index.php"); // Adapter la redirection si nécessaire
                    echo "Enseignant mis à jour avec succès.";
                    exit();
                } else {
                    // Gérer l'erreur
                    echo "Erreur lors de la mise à jour de l'enseignant.";
                }
             } else {
                 echo "Données du formulaire incomplètes.";
            }
        }
    }

    // Potentielle fonction pour afficher le formulaire d'ajout
    public static function create() {
        // include __DIR__ . '/../views/enseignants/create.php'; // Assumant une vue pour le formulaire d'ajout
        echo "Affichage du formulaire d'ajout d'enseignant (vue non implémentée).";
    }

     // Potentielle fonction pour afficher le formulaire de modification
    public static function edit($id) {
         $enseignant = Enseignant::getById($id);
         if ($enseignant) {
            // include __DIR__ . '/../views/enseignants/edit.php'; // Assumant une vue pour le formulaire de modification
             echo "Affichage du formulaire de modification pour l'enseignant ID $id (vue non implémentée).";
         } else {
             echo "Enseignant non trouvé pour modification.";
         }
    }

     // Potentielle fonction pour supprimer un enseignant (non présente dans le modèle, mais courante)
    // public static function delete($id) {
    //     // Logique de suppression
    //     // Redirection
    // }
} 