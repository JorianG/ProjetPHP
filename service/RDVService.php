<?php

namespace service;

use class\Medecin;
use class\Patient;
use class\RDV;
use repositoring\RDVDAO;

include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/class/RDV.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/repositoring/RDVDAO.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/PatientService.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ProjetPHP/service/MedecinService.php";

class RDVService
{
    private RDVDAO $RDVDAO;
    private PatientService $patientService;
    private MedecinService $medecinService;

    public function __construct()
    {
        $this->RDVDAO = RDVDAO::getInstance();
        $this->patientService = new PatientService();
        $this->medecinService = new MedecinService();
    }

    public function insert(RDV $r): void
    {
        $this->RDVDAO->insert($r);
    }

    public function update(RDV $r): void
    {
        $this->RDVDAO->update($r);
    }

    public function delete(int $id_RDV): void
    {
        $this->RDVDAO->delete($id_RDV);
    }

    public function selectAll(): false|array // TODO refacto newFromArray
    {
        return $this->RDVDAO->selectAll();
    }

    public function getById(int $id): RDV
    {
        return RDV::newFromRow($this->RDVDAO->getById($id));
    }

    public function selectAllByPatientId(Patient $patient): array
    {
        return $this->RDVDAO->selectAllByPatient($patient->getIdPersonne());
    }

    public function selectAllByMedecin(Medecin $medecin): array
    {
        return $this->RDVDAO->selectAllByMedecin($medecin->getIdPersonne());
    }


}