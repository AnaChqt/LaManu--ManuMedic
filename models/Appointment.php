<?php

require_once(dirname(__FILE__) . '/../utils/database.php');

class Appointment
{
    private int $_id;
    private string $_dateHour;
    private string $_idPatients;
    private object $_pdo;

    // Méthode "Construct"
    public function __construct(string $dateHour = '', string $idPatients = '')
    {
        $this->setDateHour($dateHour);
        $this->setIdPatients($idPatients);
        $this->_pdo = Database::dbConnect();
    }

    // GETTER pour les attributs de "Appointments"
    public function getId(): int
    {
        return $this->_id;
    }
    public function getDateHour(): string
    {
        return $this->_dateHour;
    }
    public function getIdPatients(): string
    {
        return $this->_idPatients;
    }

    // SETTER pour les attributs de "Appointments"
    public function setId(int $id): void
    {
        $this->_id = $id;
    }
    public function setDateHour(string $dateHour): void
    {
        $this->_dateHour = $dateHour;
    }
    public function setIdPatients(string $idPatients): void
    {
        $this->_idPatients = $idPatients;
    }

    // Méthode pour ajouter des rdv
    public function addAppt(): bool
    {
        try {
            $sth = $this->_pdo->prepare(
                'INSERT INTO `appointments`(`dateHour`, `idPatients`) 
            VALUES (:dateHour, :idPatients);'
            );
            $sth->bindValue(':dateHour', $this->getDateHour(), PDO::PARAM_STR);
            $sth->bindValue(':idPatients', $this->getIdPatients(), PDO::PARAM_STR);
            return $sth->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    // Méthode pour afficher la liste des rdv
    public static function listAppt(): array
    {
        $sql = 'SELECT `lastname`, `firstname`, `dateHour`,`appointments`.`idPatients` AS `idPatients`, `appointments`.`id` AS `idAppt` 
        FROM `appointments` 
        LEFT JOIN `patients`
        ON `patients`.`id` = `appointments`.`idPatients`;';
        try {
            $sth = Database::dbConnect()->query($sql);
            if (!$sth) {
                throw new PDOException();
            }
            $listAppt = $sth->fetchAll();
            return $listAppt;
        } catch (PDOException $e) {
            return [];
        }
    }

    // Méthode pour vérifier que la date n'est pas déjà prise
    public static function isDateExist(string $dateHour): bool
    {
        try {
            $sql = 'SELECT `dateHour`
                FROM `appointments`
                WHERE `dateHour` = :dateHour;';
            $sth = Database::dbConnect()->prepare($sql);
            $sth->bindValue(':dateHour', $dateHour, PDO::PARAM_STR);
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

    // Méthode pour afficher les RDV du patient sur une fiche
    public static function getOneByID($id): object
    {
        $sql = 'SELECT `lastname`, `firstname`, `dateHour`, `idPatients`, `appointments`.`id` AS `idAppt` 
        FROM `appointments` 
        JOIN `patients`
        ON   `appointments`.`idPatients`=`patients`.`id`
        WHERE `appointments`.`id`= :id;';
        try {
            $sth = Database::dbConnect()->prepare($sql);
            $sth->bindValue(':id', $id, PDO::PARAM_STR);
            $verif = $sth->execute();
            if (!$verif) {
                throw new PDOException();
            } else {
                $Appt = $sth->fetch();
                if (!$Appt) {
                    throw new PDOException('! Rendez-vous non trouvé !');
                }
                return $Appt;
            }
        } catch (PDOException $e) {
            return $e;
        }
    }

    // Modifier le rendez-vous d'un patient
    public function modifAppt($id)
    {
        $sql = 'UPDATE `appointments`
            SET `dateHour` = :dateHour,
            `idPatients` = :idPatients
            WHERE `id` = :id;';
        try {
            $sth = $this->_pdo->prepare($sql);
            $sth->bindValue(':id', $id, PDO::PARAM_INT);
            $sth->bindValue(':idPatients', $this->getIdPatients(), PDO::PARAM_STR);
            $sth->bindValue(':dateHour', $this->getDateHour(), PDO::PARAM_STR);
            return $sth->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    // Méthode pour avoir les rdv d'une personne
    public function getAllApptById(): array
    {
        $sql = 'SELECT `id`, `dateHour`, `idPatients` 
        FROM `appointments` 
        WHERE `idPatients` = :idPatients;';
        try {
            $sth = $this->_pdo->prepare($sql);
            $sth->bindValue(':idPatients', $this->_idPatients, PDO::PARAM_INT);
            if ($sth->execute()) {
                return $sth->fetchAll();
            }
        } catch (PDOException $e) {
            return [];
        }
    }

    // Méthode pour suppr les rdv d'une personne
    public static function deleteAppt($idAppt): bool
    {
        $sql = 'DELETE 
        FROM `appointments` 
        WHERE `id` = :id;';
        try {
            $sth = Database::dbConnect()->prepare($sql);
            $sth->bindValue(':id', $idAppt, PDO::PARAM_INT);
            return $sth->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    // Méthode pour supprimer un rendez-vous
    public static function deleteByPatient($idAppt): bool
    {
        $sql = 'DELETE 
        FROM `appointments` 
        WHERE `idPatients` = :id;';
        try {
            $sth = Database::dbConnect()->prepare($sql);
            $sth->bindValue(':id', $idAppt, PDO::PARAM_INT);
            return $sth->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}
