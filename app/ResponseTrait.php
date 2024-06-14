<?php

namespace App;

trait ResponseTrait
{
    //

    public function ResSuccess($data) {
        return response()->json([
            "status"=>"ok",
            "msg"=> "success",
            "data"=> $data
        ],200);
    }

    public function ResError($data) {
        return response()->json([
            "status"=>"error",
            "data"=> $data
        ],400);
    }

    public function responseTrait($data){
        if (is_object($data)) {
            $get_class = get_class($data);
            $name_model = explode("\\",$get_class)[2]; //get name models
            //return "App\Models\\".$name_model;
            if ($name_model != "MessageBag") {
               return $this->ResSuccess($data);
            }else{
               return $this->ResError($data);
            }
        }else{
            return $this->ResSuccess($data);
        }
      
        //return $data; //get_class($data);
    }
}
