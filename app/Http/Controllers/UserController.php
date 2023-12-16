<?php

namespace App\Http\Controllers;

use App\Models\account;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $request = User::all();

        return $this->success_resposnes($request,);
    }


    public function store(Request $request)
    {
        $request["password"] = Hash::make($request->password);
        $result = User::create($request->except("account"));

        if ($result) {
            $account = $request["account"];
            $account["user_id"] = $result["id"];
            $account["number"] = $result["id"] . mt_rand(1000000, 9000000);
            $account["is_main"] = true;
            $accounrResult =  account::create($account);
            if ($accounrResult) {
                $request["momaiaz"] = substr(explode("-", $accounrResult["created_at"])[0], 0, 2) . mt_rand(1000, 9000);
                $result = User::find($result["id"])->update($request->except("account"));
                return $this->success_resposnes([
                    "user" => tap($result),
                    "account" => $accounrResult
                ]);
            }
        } else {
            return $this->fiald_resposnes();
        }
    }

    public function changeMainAccoubt(Request $request)
    {
        $account_id = $request->account_id;
        $user = request()->user();
        $accounts = $user->accounts;
        if (count($accounts) > 1) {
            foreach ($accounts as $account) {
                $mainAccount_id = $account->is_main ? $account->id : 0;
                if ($account->id == $account_id) {
                    $mainAccount = account::find($mainAccount_id)->update([
                        "is_main" => false
                    ]);
                    $newMainAccount = account::find($account->id)->update([
                        "is_main" => true
                    ]);
                    return $this->success_resposnes([
                        "Ex_account" => tap($mainAccount),
                        "new_account" => tap($newMainAccount)

                    ]);
                }
            }
        } else if (count($accounts) == 1) {
        } else return $this->fiald_resposnes(message: "you dont have this account");
    }


    public function show(int $id)
    {
        $result = User::with("accounts")->find($id);

        if ($result) {
            return $this->success_resposnes($result);
        } else {
            return $this->fiald_resposnes();
        }
    }


    public function update(Request $request, int $id)
    {
        $result = User::find($id);

        if ($result) {
            $result->update($request->all());
            return $this->success_resposnes($result);
        } else {
            return $this->fiald_resposnes();
        }
    }


    public function destroy(int $id)
    {
        $result = User::find($id);

        if ($result) {
            $result->delete();
            return $this->success_resposnes($result);
        } else {
            return $this->fiald_resposnes();
        }
    }
}
