<?php

namespace class;

enum Civilite
{
    case M;
    case MME;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
