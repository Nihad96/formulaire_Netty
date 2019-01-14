<?php
namespace Model;
use Model\Contact;



class updateManager extends AbstractManager
{

    const TABLE = 'contact';

    public function __construct($pdo)
    {
        parent::__construct(self::TABLE, $pdo);
    }

    public function update(Contact $contact)
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET nom = :lastname, prenom = :firstname, tel = :number, email = :email, ville = :town WHERE id=:id");
        $statement->bindValue('id', $contact->getId(), \PDO::PARAM_INT);
        $statement->bindValue('lastname', $contact->getNom(), \PDO::PARAM_STR);
        $statement->bindValue('firstname', $contact->getPrenom(), \PDO::PARAM_STR);
        $statement->bindValue('number', $contact->getTel(), \PDO::PARAM_STR);
        $statement->bindValue('email', $contact->getEmail(), \PDO::PARAM_STR);
        $statement->bindValue('town', $contact->getVille(), \PDO::PARAM_STR);

        return $statement->execute();

    }

}