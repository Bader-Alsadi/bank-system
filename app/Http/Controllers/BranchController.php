<?php

namespace App\Http\Controllers;

use App\Models\branch;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $request = branch::all();

        return $this->success_resposnes($request,);
    }


    public function store(Request $request)
    {
        $request["code"] = substr($request->name, 0, 2) . "-" . mt_rand(1000, 9000);
        $result = branch::create($request->all());

        if ($result) {
            return $this->success_resposnes($result);
        } else {
            return $this->fiald_resposnes();
        }
    }


    public function show(int $id)
    {
        $result = branch::find($id);

        if ($result) {
            return $this->success_resposnes($result);
        } else {
            return $this->fiald_resposnes();
        }
    }


    public function update(Request $request, int $id)
    {
        $result = branch::find($id);

        if ($result) {
            $result->update($request->all());
            return $this->success_resposnes($result);
        } else {
            return $this->fiald_resposnes();
        }
    }


    public function destroy(int $id)
    {
        $result = branch::find($id);

        if ($result) {
            $result->delete();
            return $this->success_resposnes($result);
        } else {
            return $this->fiald_resposnes();
        }
    }
}
