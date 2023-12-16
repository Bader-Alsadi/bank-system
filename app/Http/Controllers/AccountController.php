<?php

namespace App\Http\Controllers;

use App\Models\account;
use App\Models\AccounType;
use App\Models\branch;
use App\Models\Currncy;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class AccountController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $request = account::all();

        return $this->success_resposnes($request,);
    }

    // public function firstacout(Request $request)
    // {
    //     $result = account::created($request->all());

    //     if ($result) {
    //         return $this->success_resposnes($result);
    //     } else {
    //         return $this->fiald_resposnes();
    //     }
    // }


    public function store(Request $request)
    {
        $branch = branch::find($request->branch_id);
        if ($branch) {
            $user = User::find($request->user_id);
            if ($user) {
                $accountT = AccounType::find($request->type_id);
                if ($accountT) {
                    $currncy = Currncy::find($request->currncy_id);
                    if ($currncy) {
                        $request["number"] = $user->id . mt_rand(1000000, 9000000);

                        $account = account::create($request->all());
                        if ($account) {
                            if ($account) {
                                if (isEmpty($user->accounts)) {
                                    $account->update([
                                        "is_main" => true
                                    ]);
                                }
                                return $this->success_resposnes($account);
                            } else {
                                return $this->fiald_resposnes();
                            }
                        }
                    } else return $this->fiald_resposnes(message: "currncy type not found");
                } else return $this->fiald_resposnes(message: "account type not found");
            } else return $this->fiald_resposnes(message: "user not found");
        } else return $this->fiald_resposnes(message: "branch not found");
    }


    public function show(int $id)
    {
        $result = account::with("user", "branch", "currncy", "accountType")->find($id);

        if ($result) {
            return $this->success_resposnes($result);
        } else {
            return $this->fiald_resposnes();
        }
    }


    public function update(Request $request, int $id)
    {
        $result = account::find($id);

        if ($result) {
            $result->update($request->all());
            return $this->success_resposnes($result);
        } else {
            return $this->fiald_resposnes();
        }
    }


    public function destroy(int $id)
    {
        $result = account::find($id);

        if ($result) {
            $result->delete();
            return $this->success_resposnes($result);
        } else {
            return $this->fiald_resposnes();
        }
    }
}
