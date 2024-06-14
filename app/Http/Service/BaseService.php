<?php

namespace App\Http\Service;

interface BaseService {

    public function saveService($request);
    public function getAlldataPaginateService($request);
    public function getByIdService($request);
    public function deletedByIdService($request);
    
}