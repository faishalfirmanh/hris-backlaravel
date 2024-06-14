<?php

namespace App\Http\Controllers\API\Employe;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Service\employe\EmployeService;
use App\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class EmployesController extends Controller
{
    //
    protected $service;
    use ResponseTrait;
    public function __construct(EmployeService $serviceEmp )
    {
        $this->service = $serviceEmp;
    }


    public function index()
    {
        echo "<h1>Hallo BHOSKUU !!!!!</h1>";
    }

    public function saved(Request $request)
    {
       $post = $this->service->saveService($request->all());
       return $this->responseTrait($post);
    }

    public function delete(Request $request)
    {
       $deleted = $this->service->deletedByIdService($request->all());
       return $this->responseTrait($deleted);
    }

    public function getAllData(Request $request)
    {
       $get = $this->service->getAlldataPaginateService($request->all());
       return $this->responseTrait($get);
    }

    public function getById(Request $request)
    {
       $get = $this->service->getByIdService($request->all());
       return $this->responseTrait($get);
    }
}
