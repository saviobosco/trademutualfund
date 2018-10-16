<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 9/19/18
 * Time: 9:48 AM
 */

namespace App\Repository;


use App\Investment;
use App\ReferralPyramid;
use App\ReferralsBonus;
use App\Transaction;
use App\TransactionReport;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class UsersRepository
{
    public static function getUserActiveTransactions($user_id)
    {
        $transactions = Transaction::query()->with([
            'make_payment_user',
            'get_payment_user.user_payment_details',
            'get_payment',
            'make_payment',
            'photo_proofs',
            'transaction_reports' => function($query) {
                $query->where('status', 1);
            }
        ])
            ->where('transactions.status', 1)
            ->where(function($query) use ($user_id) {
                $query->where('transactions.make_payment_user_id', $user_id)
                    ->orWhere('transactions.get_payment_user_id', $user_id);
            })
            ->get();
        return $transactions;
    }

    public static function getUserActiveInvestments($user_id)
    {
        $transactions = Investment::query()
            ->where('user_id', $user_id)
            ->where(function($query) {
                $query->where('status', '<>', -1)
                    ->where('status', '<>', 5);
            })
            ->count();
        return $transactions;
    }

    public static function getUserReferralBonus($user_id)
    {
        return ReferralsBonus::query()
        ->where('status',1)
        ->where('user_id', $user_id)
        ->pluck('amount')->sum();
    }

    public static function getUserSupportTickets($user_id)
    {
        return Cache::remember($user_id.'-supportTickets', (new Carbon())->addMinutes(10), function () use ($user_id) {
            return TransactionReport::query()
                ->where('user_id', $user_id)
                ->count();
        });
    }

    public static function getUserCashAbleInvestments($user_id)
    {
        $investments = Investment::query()
            ->select(['roi_amount'])
            ->where('user_id', $user_id)
            ->whereBetween('status', [2,4])
            ->pluck('roi_amount')
            ->sum();
        return $investments;
    }

    public static function getUserReferralCount($user_id)
    {
        try {
            return ReferralPyramid::whereDescendantOf($user_id)
                ->count();
        } catch ( ModelNotFoundException $exception) {
            return 0;
        }
    }

    public static function getUserCompletedInvestments($user_id)
    {
        $transactions = Investment::query()
            ->where([
                ['user_id', $user_id],
                ['status', Investment::COMPLETED]
            ])
            ->count();
        return $transactions;
    }

    public static function getCompletedInvestmentWithNoTestimony($user_id)
    {
        $completedInvestment = Investment::query()
            ->doesntHave('testimony')
            ->where([
                ['user_id',$user_id],
                ['status', Investment::COMPLETED]
            ])
            ->count();
        return $completedInvestment;
    }
}