<?php

namespace class;

enum Civilite
{
    case M;
    case MME;
    case MLE;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public static function fromString(string $name): Civilite
    {
        return match (strtoupper($name)) {
            "M" => Civilite::M,
            "MR" => Civilite::M,
            "MME" => Civilite::MME,
            "MLLE" => Civilite::MLE,
        };
    }
}
