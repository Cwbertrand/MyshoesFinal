<?php

namespace App\Service;

use App\Entity\ShoesCategory;

class Search{

    // All the properties are in public because too much security is not needed for a search functionality and we 
    // want to avoid the use of setters and getters and for easy access of the properties

    /**
     * @var string
     */
    public $categoryinfo = '';

    /**
     * @var ShoesCategory[] //from class categorie
     */
    public $categorycheckbox = [];

}

