<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 10/17/18
 * Time: 9:13 AM
 */

namespace Tests\Unit\Console\Commands;


use App\Console\Commands\ProcessInvestments;
use App\Investment;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ProcessInvestmentsTest extends TestCase
{
    use DatabaseMigrations;

    public $ProcessInvestments;

    public function setUp()
    {
        parent::setUp();
        $this->ProcessInvestments = new ProcessInvestments();
    }

    /** @test */
    public function testHandleProcessInvestments()
    {
        factory('App\Investment',3)->create([
            'status' => Investment::CONFIRMED,
            'release_date' => (new Carbon())->subHour()
        ]);
        $this->ProcessInvestments->handle();
        $this->assertEquals(3, Investment::query()->where('status', Investment::CASH_OUT)->count());
    }

}