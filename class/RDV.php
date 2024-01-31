<?php

namespace class;

use DateTime;
use repositoring\RDVDAO;
use service\MedecinService;
use service\PatientService;
use function Sodium\add;

class RDV
{
    private int $idRDV;
    private Patient $patient;
    private Medecin $medecin;

    private DateTime $dateHeure;
    private int $dureeEnMinute;

    public function __construct(Patient $patient, Medecin $medecin, DateTime $dateHeure, int $dureeEnMinute)
    {
        $this->patient = $patient;
        $this->medecin = $medecin;
        $this->dateHeure = $dateHeure;
        $this->dureeEnMinute = $dureeEnMinute;
    }

    public static function newFromRow(mixed $rows): RDV
    {
        $medecinService = new MedecinService();
        $patientService = new PatientService();
        $dateHeure = new DateTime($rows['DateHeure']);
        $patient = $patientService->getById($rows['Id_Personne_Id_Patient']);
        $patient->setIdPersonne($rows['Id_Personne_Id_Patient']);
        $medecin = $medecinService->getById($rows['Id_Personne_id_medecin']);
        $medecin->setIdPersonne($rows['Id_Personne_id_medecin']);

        $rdv = new RDV(
            $patient,
            $medecin,
            $dateHeure,
            $rows['DureeEnM']);
        $rdv->setId($rows['Id_RDV']);
        return $rdv;
    }

    public static function newFromArray(array $rows): array
    {
        $rdvs = [];
        foreach ($rows as $row) {
            $rdvs[] = RDV::newFromRow($row);
        }
        return $rdvs;
    }

    /**
     * @return Medecin
     */
    public function getMedecin(): Medecin
    {
        return $this->medecin;
    }

    /**
     * @return Patient
     */
    public function getPatient(): Patient
    {
        return $this->patient;
    }

    /**
     * @return DateTime
     */
    public function getDateHeure(): DateTime
    {
        return $this->dateHeure;
    }

    /**
     * @return int
     */
    public function getDureeEnMinute(): int
    {
        return $this->dureeEnMinute;
    }

    /**
     * @param Medecin $medecin
     */
    public function setMedecin(Medecin $medecin): void
    {
        $this->medecin = $medecin;
    }

    /**
     * @param Patient $patient
     */
    public function setPatient(Patient $patient): void
    {
        $this->patient = $patient;
    }

    /**
     * @param DateTime $dateHeure
     */
    public function setDateHeure(DateTime $dateHeure): void
    {
        $this->dateHeure = $dateHeure;
    }

    /**
     * @param int $dureeEnMinute
     */
    public function setDureeEnMinute(int $dureeEnMinute): void
    {
        $this->dureeEnMinute = $dureeEnMinute;
    }

    public function setId(int $Id_RDV): void
    {
        $this->idRDV = $Id_RDV;
    }

    public function getIdRDV(): int
    {
        return $this->idRDV;
    }

    public function isSupperpose(RDV $RDV): bool
    {
        $dateDebut1 = $this->getDateHeure();
        $dateDebut2 = $RDV->getDateHeure();
        $duree1 = $this->getDureeEnMinute();
        $duree2 = $RDV->getDureeEnMinute();

        $dateInterval = new \DateInterval('PT' . $duree1 . 'M');
        $dateFin1 = $dateDebut1->add($dateInterval);
        $dateInterval1 = new \DateInterval('PT' . $duree2 . 'M');
        $dateFin2 = $dateDebut2->add($dateInterval1);

        // vérifie que les dates ne se superposent pas
        if ($dateDebut1 < $dateDebut2 && $dateFin1 > $dateDebut2) {
            return true;
        }
        if ($dateDebut1 > $dateDebut2 && $dateDebut1 < $dateFin2) {
            return true;
        }

        if ($dateFin1 < $dateFin2 && $dateFin1 > $dateDebut2) {
            return true;
        }
        if ($dateFin1 > $dateFin2 && $dateDebut1 < $dateFin2) {
            return true;
        }

        if ($dateDebut1 < $dateDebut2 && $dateFin1 > $dateDebut2) {
            return true;
        }
        if ($dateDebut1 > $dateDebut2 && $dateDebut1 < $dateFin2) {
            return true;
        }

        return false;
    }
}