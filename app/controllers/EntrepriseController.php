<?php

class EntrepriseController
{
    private $model;

    public function __construct(EntrepriseModel $model)
    {
        $this->model = $model;
    }

    public function liste()
    {
        return $this->model->getAllEntreprises();
    }

    public function ajouter()
    {
        if (isset($_POST['nom'], $_POST['description'], $_POST['email'], $_POST['telephone'])) {
            $this->model->ajouterEntreprise($_POST['nom'], $_POST['description'], $_POST['email'], $_POST['telephone']);
        }
    }

    public function modifier($id)
    {
        if (isset($_POST['nom'], $_POST['description'], $_POST['email'], $_POST['telephone'])) {
            $this->model->modifierEntreprise($id, $_POST['nom'], $_POST['description'], $_POST['email'], $_POST['telephone']);
        }
    }

    public function supprimer($id)
    {
        $this->model->supprimerEntreprise($id);
    }

    public function rechercher()
    {
        if (isset($_GET['recherche'])) {
            return $this->model->rechercherEntreprise($_GET['recherche']);
        }
        return [];
    }
}
