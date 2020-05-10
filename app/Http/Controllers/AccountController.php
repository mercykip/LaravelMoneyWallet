<?php

namespace App\Http\Controllers;

use App\Account;
use App\User;
use App\Transaction;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkBalance($id)
    {
        $account=Account::find($id,['amount']);
        return response()->json($account);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function withDraw(Request $request,$id)
    {
      
       $account=Account::find($id);
       $tax=0;
       $charges=2;
       $dbAmount=intval($account->amount);
       $amount=intval($request->get('amount'));
       $email=$account->email;
       $accountId=$account->accountId;
       
       if($amount<$dbAmount){
        $account->amount=$dbAmount-$amount;
        $account->save();
        $account=$account->amount;
        //set Transaction table
        $transaction=new Transaction();
       // $transaction->email=$account->email;
       
        $transaction->amount=$account;
        $transaction->email=$email;
        $transaction->accountId=$accountId;
        $transaction->save();
        return response()->json($account);
       }
       else{
        return response()->json("insufficient funds");
       }
    }

       Public function fundTransfer(Request $request,$id){
           $account=Account::find($id);
           $username=$request->get('email');
           $amount=$request->get('amount');//Amount to send
           $user = Account::where('email', $username)->first();
         //  $user_id = User::select('customerId')->where('username', $username)->first();//select the username id
          $userAmount=intval($user->amount);
          $loggedAmount=intval($account->amount);//loggedIn user
          if($loggedAmount>$userAmount){
              if($loggedAmount>$amount){
                  $account->amount=$loggedAmount-$amount;
                  $account->save();
                  return response()->json($account);
              }
              else{
                return response()->json("insufficient funds to send "); 
              }

          }
       
       }

       public function fundDeposit(Request $request,$id){
           $user=Account::find($id);
           $amount=$request->get('amount');//amount to deposit
           $dbAmount=intval($user->amount);
           $user->amount=$dbAmount+$amount;
           $user->save();
           $balance=$user->amount;
           return response()->json("you balance is ".$balance);
       }

       
     
  
        
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        //
    }
}
