<?php

namespace App\Http\Controllers;

use App\Models\Currncy;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class CurrncyController extends Controller
{
    use ApiResponse;
 
    public function index()
    {
        $request = Currncy::all();

        return $this->success_resposnes($request,);
    }

  
    public function store(Request $request)
    {
        $result = Currncy::create($request->all());

        if ($result) {
            return $this->success_resposnes($result);
        } else {
            return $this->fiald_resposnes();
        }
    }


    public function show(int $id)
    {
        $result = Currncy::find($id);

        if ($result) {
            return $this->success_resposnes($result);
        } else {
            return $this->fiald_resposnes();
        }
    }


    public function update(Request $request, int $id)
    {
        $result = Currncy::find($id);

        if ($result) {
            $result->update($request->all());
            return $this->success_resposnes($result);
        } else {
            return $this->fiald_resposnes();
        }
    }

 
    public function destroy(int $id)
    {
        $result = Currncy::find($id);

        if ($result) {
            $result->delete();
            return $this->success_resposnes($result);
        } else {
            return $this->fiald_resposnes();
        }
    }
}
