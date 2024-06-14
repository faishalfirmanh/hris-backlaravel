<?php

namespace App\Http\Repository;
use DB;
use Illuminate\Database\Eloquent\Model;
class BaseRepository {

    public $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findOrfail($id)
    {
        return $this->model->findOrfail($id);
    }

    public function CreateOrUpdate(array $attributes, $id = null)
    {
        DB::beginTransaction();
        try {
            if ($id > 0) {
                $data = $this->model->find($id);
                if ($id && !$data) return "no data id ".$id;
                $data->fill($attributes);
                $data->save();
            } else {
                $data = $this->model->create($attributes);
            }
            DB::commit();
            return $data;
        } catch (Exception $e) {
            DB::rollBack();
            return "error saved";
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $data = $this->model->find($id);
            $save = $data->delete();
            DB::commit();
            return $save;
        } catch (Exception $e) {
            DB::rollBack();
            return "failed deleted";
        }
    }

    public function getData($limit, $keyword = null)
    {
        return $this->model
        ->when(!empty($keyword), function ($q) use ($keyword) {
            $q->where('fullname','like','%'. $keyword .'%');
            $q->orWhere('email','like','%'. $keyword .'%');
        })
        ->limit($limit)->paginate($limit);
    }
}