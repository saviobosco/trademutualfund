<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 10/3/18
 * Time: 9:17 AM
 */

namespace App\Repository;


use App\GetPayment;
use App\MakePayment;
use App\User;
use App\TransactionReport;

class StatisticsRepository
{
    public static function getTotalOfUsers()
    {
        return setting('total_users') + User::count();
    }

    public static function getTotalOfPayOuts()
    {
        return setting('total_payout') + GetPayment::sum('initial_amount');
    }

    public static function getTotalOfTransactions()
    {
        return setting('total_transactions') + static::getTotalOfPayOuts() + MakePayment::sum('initial_amount');
    }

    public static function getTotalActiveSupportTickets()
    {
        return TransactionReport::query()
            ->where('status', 1)
            ->count();
    }
}