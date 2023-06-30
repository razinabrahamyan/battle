<?php

use App\Reason;
use Illuminate\Database\Seeder;

class ReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reasons = [
            ['type' => 'reject_reason', 'reason' => 'harmar che'],
            ['type' => 'reject_reason', 'reason' => 'chem uze'],
            ['type' => 'reject_reason', 'reason' => 'chem krna'],
            ['type' => 'report_reason', 'reason' => 'xaytarakutyun'],
            ['type' => 'report_reason', 'reason' => 'xaxacoxnere tklor en'],
            ['type' => 'report_reason', 'reason' => 'es ayspes aylevs chem karox'],
        ];
        Reason::insert($reasons);
    }
}
