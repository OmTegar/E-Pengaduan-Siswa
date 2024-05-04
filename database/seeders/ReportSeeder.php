<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Report;
use App\Models\ReportReciver;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::where('role_id', 2)->pluck('id')->toArray();

        Report::factory(1000)->create()->each(function ($report) use ($userIds) {
            shuffle($userIds);
            $reciverIds = array_slice($userIds, 0, rand(1, count($userIds)));
            foreach ($reciverIds as $reciverId) {
                ReportReciver::factory()->create([
                    'report_id' => $report->id,
                    'reciver_id' => $reciverId,
                ]);
            }
        });
    }
}
