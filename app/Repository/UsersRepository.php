<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 9/19/18
 * Time: 9:48 AM
 */

namespace App\Repository;


use App\Transaction;

class UsersRepository
{
    public static function getUserActiveTransactions($user_id)
    {
        $transactions = Transaction::query()->with([
            'make_payment_user',
            'get_payment_user',
            'get_payment',
            'make_payment',
            'photo_proofs',
            'transaction_reports'
        ])
            ->where('transactions.status', 1)
            ->where(function($query) use ($user_id) {
                $query->where('transactions.make_payment_user_id', $user_id)
                    ->orWhere('transactions.get_payment_user_id', $user_id);
            })
            ->get();
        return $transactions;
    }
}