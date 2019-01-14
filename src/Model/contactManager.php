<?php
namespace Model;
use Model\Contact;



class contactManager extends AbstractManager {

    const TABLE = 'contact';

    public function __construct($pdo) {
        parent::__construct(self::TABLE, $pdo);
    }


    public function insert(Contact $contact): int {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (nom, prenom, tel, email, ville) VALUES (:lastname, :firstname, :number, :email, :town)");
        $statement->bindValue('lastname', $contact->getNom(), \PDO::PARAM_STR);
        $statement->bindValue('firstname', $contact->getPrenom(), \PDO::PARAM_STR);
        $statement->bindValue('number', $contact->getTel(), \PDO::PARAM_STR);
        $statement->bindValue('email', $contact->getEmail(), \PDO::PARAM_STR);
        $statement->bindValue('town', $contact->getVille(), \PDO::PARAM_STR);

        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }
    }

}

?>