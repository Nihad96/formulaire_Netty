<?php

namespace Controller;
use Model\contactManager;
use Model\Contact;

class ContactController extends AbstractController
{


    protected $twig;


    public function insert()
    {
        $contactManager = new contactManager($this->pdo);
        $contacts = $contactManager->selectAll();
        $contact=0;

        if ($_POST) {


            if (empty($_POST['firstname'])) {
                $errors['firstname1'] = "Veuillez saisir votre prénom";
            }

            if (empty($_POST['lastname'])) {
                $errors['lastname1'] = "Veuillez saisir votre nom";
            }

            if (empty($_POST['email'])) {
                $errors['email1'] = "Veuillez saisir votre adresse mail";
            }

            if (empty($_POST['number'])) {
                $errors['number1'] = "Veuillez saisir votre numéro de téléphone";
            }

            if (empty($_POST['town'])) {
                $errors['town1'] = "Veuillez selectionner une ville";
            }


            if (!preg_match("/^[a-zA-Z ]*$/", $_POST['firstname'])) $error['firstname2'] = 'Un prénom ne peut comporter que des lettres';

            if (!preg_match("/^[a-zA-Z ]*$/", $_POST['lastname'])) $error['lastname2'] = 'Un nom ne peut comporter que des lettres';

            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $error['email2'] = 'Veuillez saisir une adresse mail valide';

            if (count($errors) == 0){
                $contact = new Contact();
                $contact->setNom(strtoupper($_POST['lastname']));
                $contact->setPrenom($_POST['firstname']);
                $contact->setTel($_POST['number']);
                $contact->setEmail($_POST['email']);
                $contact->setVille($_POST['town']);

                $contactManager = new contactManager($this->pdo);
                $contactManager->insert($contact);
                header('Location: /');
                exit();
            }
        }
        return $this->twig->render('contact.html.twig', ['contact' => $contact, 'contacts' => $contacts]);
    }




}

?>