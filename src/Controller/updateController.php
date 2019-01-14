<?php
/**
 * Created by PhpStorm.
 * User: nihad
 * Date: 11/01/19
 * Time: 11:25
 */

namespace Controller;
use Model\updateManager;
use Model\Contact;


class updateController extends AbstractController
{
    protected $twig;

    public function update($id)
    {
        $updateManager = new updateManager($this->pdo);
        $contact = $updateManager->selectOneById($id);
        $contacts = $updateManager->selectAll();


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

            if(!preg_match("/^[a-zA-Z ]*$/", $_POST['lastname'])) {
                $errors['lastname2'] = "Veuillez n'utiliser que des lettres ou des espaces";
            }
            if(!preg_match("/^[a-zA-Z ]*$/",$_POST['firstname'])) {
                $errors['firstname2'] = "Veuillez n'utiliser que des lettres ou des espaces";
            }
            if(preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $_POST['email']   )) {
                $errors['email2']= "Veuillez utiliser un format correct";
            }


            $contact->setNom(strtoupper($_POST['lastname']));
            $contact->setPrenom($_POST['firstname']);
            $contact->setTel($_POST['tel']);
            $contact->setEmail($_POST['email']);
            $contact->setVille($_POST['town']);

            $updateManager->update($contact);
            header('location: /');
            exit();

        }
        return $this->twig->render('update.html.twig', ['user' => $contact, 'contacts' => $contacts]);
    }
}