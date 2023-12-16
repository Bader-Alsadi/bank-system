<?php

namespace App\Http\Controllers;

use App\Models\TransctionType;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class TransctionTypeController extends Controller
{
    use ApiResponse;
 
    public function index()
    {
        $request =TransctionType::all();

        return $this->success_resposnes($request,);
    }

  
    public function store(Request $request)
    {
        $result = TransctionType::create($request->all());

        if ($result) {
            return $this->success_resposnes($result);
        } else {
            return $this->fiald_resposnes();
        }
    }


    public function show(int $id)
    {
        $result = TransctionType::find($id);

        if ($result) {
            return $this->success_resposnes($result);
        } else {
            return $this->fiald_resposnes();
        }
    }


    public function update(Request $request, int $id)
    {
        $result = TransctionType::find($id);

        if ($result) {
            $result->update($request->all());
            return $this->success_resposnes($result);
        } else {
            return $this->fiald_resposnes();
        }
    }

 
    public function destroy(int $id)
    {
        $result = TransctionType::find($id);

        if ($result) {
            $result->delete();
            return $this->success_resposnes($result);
        } else {
            return $this->fiald_resposnes();
        }
    }
}
