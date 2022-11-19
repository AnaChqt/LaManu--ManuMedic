<?php

require_once(dirname(__FILE__) . '/../utils/database.php');

class Patient
{
    private int $_id;
    private string $_lastname;
    private string $_firstname;
    private string $_birthdate;
    private string $_phone;
    private string $_mail;
    private object $_pdo;

    public function __construct(string $lastname = '', string $firstname = '', string $birthdate = '', string $phone = '', string $mail = '')
    {
        $this->setLastname($lastname);
        $this->setFirstname($firstname);
        $this->setBirthdate($birthdate);
        $this->setPhone($phone);
        $this->setMail($mail);
        $this->_pdo = Database::dbConnect();
    }

    // GETTER pour les attributs de Patients
    public function getId(): int
    {
        return $this->_id;
    }
    public function getLastname(): string
    {
        return $this->_lastname;
    }
    public function getFirstname(): string
    {
        return $this->_firstname;
    }
    public function getBirthDate(): string
    {
        return $this->_birthdate;
    }
    public function getPhone(): string
    {
        return $this->_phone;
    }
    public function getMail(): string
    {
        return $this->_mail;
    }

    // SETTER pour les attributs privés
    public function setId(int $id): void
    {
        $this->_id = $id;
    }
    public function setLastname(string $lastname): void
    {
        $this->_lastname = $lastname;
    }
    public function setFirstname(string $firstname): void
    {
        $this->_firstname = $firstname;
    }
    public function setBirthDate(string $birthdate): void
    {
        $this->_birthdate = $birthdate;
    }
    public function setPhone(string $phone): void
    {
        $this->_phone = $phone;
    }
    public function setMail(string $mail): void
    {
        $this->_mail = $mail;
    }

    // Méthode pour ajouter des patients
    public function add()
    {
        try {
            $sth = $this->_pdo->prepare(
                'INSERT INTO `patients`(`lastname`, `firstname`, `birthdate`, `phone`, `mail`)
                VALUES (:lastname, :firstname, :birthdate, :phone, :mail);'
            );
            $sth->bindValue(':lastname', $this->getLastname(), PDO::PARAM_STR);
            $sth->bindValue(':firstname', $this->getFirstname(), PDO::PARAM_STR);
            $sth->bindValue(':birthdate', $this->getBirthdate(), PDO::PARAM_STR);
            $sth->bindValue(':phone', $this->getPhone(), PDO::PARAM_STR);
            $sth->bindValue(':mail', $this->getMail(), PDO::PARAM_STR);
            if ($sth->execute()) {
                $idPatients = $this->_pdo->lastInsertId();
                return $idPatients;
            }
        } catch (PDOException $e) {
            // return false;
        }
    }

    // Méthode pour vérifier si le mail existe
    public static function isMailExist(string $mail): bool
    {
        try {
            $sql = 'SELECT `mail`
                FROM `patients`
                WHERE `mail` = :mail;';
            $sth = Database::dbConnect()->prepare($sql);
            $sth->bindValue(':mail', $mail, PDO::PARAM_STR);
            $sth->execute();
            if (empty($sth->fetchAll())) {
                return false;
            } else {
                return true;
            }
        } catch (PDOException $e) {
            return false;
        }
    }

    // Méthode pour afficher la liste des patients
    public static function listPatient(string $search = '', $patientsPerPage = 1000, $offset = ''): array
    {
        $sql = 'SELECT * FROM `patients` 
        WHERE `lastname` 
        LIKE :search
        OR `firstname`
        LIKE :search
        LIMIT :offset,:patientsPerPage;';
        try {
            $sth = Database::dbConnect()->prepare($sql);
            $sth->bindValue(':search', "%$search%");
            $sth->bindValue(':patientsPerPage', $patientsPerPage, PDO::PARAM_INT);
            $sth->bindValue(':offset', $offset, PDO::PARAM_INT);
            if (!$sth) {
                throw new PDOException();
            }
            if ($sth->execute()) {
                return $sth->fetchAll();
            }
        } catch (PDOException $exception) {
            return [];
        }
    }

    // Méthode pour afficher l'id dans l'url
    public static function findId(int $id): object
    {
        $sql = 'SELECT *
        FROM `patients`
        WHERE `id` = :id;';
        try {
            $sth = Database::dbConnect()->prepare($sql);
            $sth->bindValue(':id', $id, PDO::PARAM_INT);
            $verif = $sth->execute();
            if (!$verif) {
                throw new PDOException();
            } else {
                $idProfil = $sth->fetch();
                if (!$idProfil) {
                    throw new PDOException('! Patient non trouvé !');
                }
                return $idProfil;
            }
        } catch (PDOException $e) {
            return $e;
        }
    }

    // Méthode pour modifier les données du patient
    public function modifPatient($id)
    {
        $sql = 'UPDATE `patients`
            SET `lastname` = :lastname,
                `firstname` = :firstname,
                `birthdate` = :birthdate,
                `phone` = :phone,
                `mail` = :mail
            WHERE `id` = :id;';
        try {
            $sth = $this->_pdo->prepare($sql);
            $sth->bindValue(':id', $id, PDO::PARAM_INT);
            $sth->bindValue(':lastname', $this->getLastname(), PDO::PARAM_STR);
            $sth->bindValue(':firstname', $this->getFirstname(), PDO::PARAM_STR);
            $sth->bindValue(':birthdate', $this->getBirthdate(), PDO::PARAM_STR);
            $sth->bindValue(':phone', $this->getPhone(), PDO::PARAM_STR);
            $sth->bindValue(':mail', $this->getMail(), PDO::PARAM_STR);
            return $sth->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    // Méthode pour supprimer un patient et son rendez-vous
    public static function deleteApptPatient($idAppt): bool
    {
        $sql = 'DELETE 
        FROM `patients` 
        WHERE `id` = :id;';
        try {
            $sth = Database::dbConnect()->prepare($sql);
            $sth->bindValue(':id', $idAppt, PDO::PARAM_INT);
            return $sth->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    // Méthode pour créer la pagination
    public static function count()
    {
        $sql = "SELECT COUNT(`id`) AS nb_patients 
        FROM `patients`;";
        $sth = Database::dbConnect()->query($sql);
        return $sth->fetch();
    }
}
