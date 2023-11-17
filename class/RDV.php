<?php

namespace class;

use DateTime;

class RDV
{
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
}