<?php

namespace App\Http\Controllers;

use App\Models\account;
use App\Models\transction;
use App\Models\TransctionType;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class TransctionController extends Controller
{
    use ApiResponse;
    public function dopsit(Request $request)
    {
        $account = account::find($request->account_id);
        if ($account) {
            $blance = $account->blance + $request->amount;
            $account =  tap($account)->update([
                "blance" => $blance
            ]);

            if ($account) {
                $transction = transction::create($request->all());
                if ($transction) {
                    return $this->success_resposnes([
                        "transction" => $transction,
                        "on" => $account
                    ]);
                } else return $this->fiald_resposnes(message: "transction faild");
            } else return $this->fiald_resposnes(message: "update accout faild");
        } else return $this->fiald_resposnes(message: "accouut not found");
    }

    public function withdrow(Request $request)
    {
        $account = account::find($request->account_id);
        $currncy = $account->currncy;
        if ($request->amount <= $currncy["mas-limet"]) {
            if ($request->amount <= $account->blance) {
                if ($account) {
                    $blance = $account->blance - $request->amount;
                    $account =  tap($account)->update([
                        "blance" => $blance
                    ]);
                    if ($account) {
                        $transction = transction::create($request->all());
                        if ($transction) {
                            return $this->success_resposnes([
                                "transction" => $transction,
                                "on" => $account
                            ]);
                        } else return $this->fiald_resposnes(message: "transction faild");
                    } else return $this->fiald_resposnes(message: "update accout faild");
                } else return $this->fiald_resposnes(message: "accouut not found");
            } else return $this->fiald_resposnes(message: "your balnce less than amount");
        } else return $this->fiald_resposnes(message: "The amount more than the limet");
    }

    public function transform(Request $request)
    {
        $account = account::find($request->account_id);
        $account_ex = account::find($request->ex_account_id);
        $currncy = $account->currncy;
        $currncy_ex = $account_ex->currncy;
        if ($currncy->name == $currncy_ex->name) {
            if ($request->amount <= $account->blance) {
                if ($account) {
                    $blance = $account->blance - $request->amount;
                    $blance_ex = $account_ex->blance + $request->amount;
                    $account =  tap($account)->update([
                        "blance" => $blance
                    ]);
                    $account_ex =  tap($account_ex)->update([
                        "blance" => $blance_ex
                    ]);
                    if ($account && $account_ex) {
                        $transction = transction::create($request->all());
                        if ($transction) {
                            return $this->success_resposnes([
                                "transction" => $transction,
                                "from" => $account,
                                "to" => $account_ex
                            ]);
                        } else return $this->fiald_resposnes(message: "transction faild");
                    } else return $this->fiald_resposnes(message: "update accout faild");
                } else return $this->fiald_resposnes(message: "accouut not found");
            } else return $this->fiald_resposnes(message: "your balnce less than amount");
        } else return $this->fiald_resposnes(message: "the currncy not in the same type");
    }
}
