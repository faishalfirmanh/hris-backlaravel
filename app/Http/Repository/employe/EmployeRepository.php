<?php

namespace App\Http\Repository\employe;

use App\Http\Repository\BaseRepository;
use App\Models\Employe;
use DB;

class EmployeRepository extends BaseRepository{

    public function __construct(Employe $model)
    {
        parent::__construct($model);
    }
}