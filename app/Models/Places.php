<?php
namespace App\Models;

/*
 * Mock travel destination data.
 * Note that we don't have to extend CodeIgniter's model for now
 */

use App\Models\Simple\JSONModel;

class Places extends JSONModel
{
    protected $origin = WRITEPATH . 'Data/placesData.json';
    protected $keyField = 'id';
    protected $validationRules = [];
}