<?php

namespace App\Http\Controllers;

use App\Models\AccounType;
use App\Models\TransctionType;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class AccounTypeController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $request = AccounType::all();

        return $this->success_resposnes($request,);
    }


    public function store(Request $request)
    {
        $result = AccounType::create($request->all());

        if ($result) {
            return $this->success_resposnes($result);
        } else {
            return $this->fiald_resposnes();
        }
    }


    public function show(int $id)
    {
        $result = AccounType::find($id);

        if ($result) {
            return $this->success_resposnes($result);
        } else {
            return $this->fiald_resposnes();
        }
    }


    public function update(Request $request, int $id)
    {
        $result = AccounType::find($id);

        if ($result) {
            $result->update($request->all());
            return $this->success_resposnes($result);
        } else {
            return $this->fiald_resposnes();
        }
    }


    public function destroy(int $id)
    {
        $result = AccounType::find($id);

        if ($result) {
            $result->delete();
            return $this->success_resposnes($result);
        } else {
            return $this->fiald_resposnes();
        }
    }
}
