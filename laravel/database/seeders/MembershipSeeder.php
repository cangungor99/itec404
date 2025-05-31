<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Membership;
use App\Models\Club;
use App\Models\User;

class MembershipSeeder extends Seeder
{
    public function run(): void
    {
        // Sadece student rolüne sahip kullanıcılar
        $students = User::whereHas('roles', fn($q) => $q->where('name', 'student'))->get();
        $clubs = Club::all();

        // Her kulübe 3-5 öğrenci rastgele ekle
        foreach ($clubs as $club) {
            $assignedUsers = $students->random(min(5, $students->count()));

            foreach ($assignedUsers as $student) {
                Membership::firstOrCreate([
                    'userID' => $student->userID,
                    'clubID' => $club->clubID,
                ], [
                    'role' => 'member',
                    'joined_at' => now(),
                    'status' => 'approved',
                ]);
            }
        }
    }
}
