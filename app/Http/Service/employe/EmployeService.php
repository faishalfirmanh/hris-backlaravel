<?php

namespace App\Http\Service\employe;

use App\Http\Repository\employe\EmployeRepository;
use App\Http\Service\BaseService;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
class EmployeService implements BaseService{

    protected $repo;
    public function __construct(EmployeRepository $repo)
    {
        $this->repo = $repo;
    }
    
    public function cekKondisiCreateOrUpdate($request) : array
    {
        $arr = [];
        if (isset($request["id"])) {
            $employe = $this->repo->find($request["id"]);
            if ($employe != null) {
                $cekemail = ['required','email',Rule::unique('employes')->ignore($employe->id)];
                $cek_phone = ['required','integer' ,Rule::unique('employes')->ignore($employe->id)];
            }else{
                $cekemail = 'required|email|unique:employes,email';
                $cek_phone = 'required|integer|unique:employes,phone_number';
            }
         
            $cek_update =  'required|integer|exists:employes,id';
            $cekid = $request["id"];
            $arr[] = [$cekemail,$cek_phone,$cek_update,$cekid];
        }else{
            $cekemail = 'required|email|unique:employes,email';
            $cek_phone = 'required|integer|unique:employes,phone_number';
            $cekid = null;
            $cek_update = 'nullable';
            $arr[] = [$cekemail,$cek_phone,$cek_update,$cekid];
        }
        return $arr[0];
    }

    public function saveService($request)
    {
       
      
        $cek_updated = $this->cekKondisiCreateOrUpdate($request);
      
        $validator = Validator::make($request,[
            'id' => $cek_updated[2],
            'fullname' => 'required|string',
            'username' => 'required|string',
            'password' => 'required|string',
            'type_employe' => 'required|integer|between:0,3',
            'email' =>  $cek_updated[0],
            'phone_number' => $cek_updated[1],
            'file_cv' =>  'required|string',
        ]);
        
        if ($validator->fails()) {
            return $validator->errors();
        }
       
        $request['password'] = bcrypt($request['password']);
        $saved = $this->repo->CreateOrUpdate($request, $cek_updated[3]);
       
        return $saved;
        
    }

    
    public function getAlldataPaginateService($request)
    {
        $validator = Validator::make($request,[
            'limit' => 'required|integer|min:10',
            'page' => 'required|integer|min:1',
            'keyword' => 'nullable|string',
        ]); 
        if ($validator->fails()) {
            return $validator->errors();
        }
      
        $get = $this->repo->getData($request["limit"],isset($request["keyword"]) ? $request["keyword"] : null);
        return $get;
    }

    public function getByIdService($request)
    {
        $validator = Validator::make($request,[
            'id' => 'required|integer|exists:employes,id',
        ]);
        
        if ($validator->fails()) {
            return $validator->errors();
        }
        $get = $this->repo->find($request["id"]);
        return $get;
    }

    public function deletedByIdService($request)
    {
        $validator = Validator::make($request,[
            'id' => 'required|integer|exists:employes,id',
        ]);
        
        if ($validator->fails()) {
            return $validator->errors();
        }
        $deleted = $this->repo->delete($request["id"]);
        return $deleted;
    }
}