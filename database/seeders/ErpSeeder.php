<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Erp;

class ErpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $erp = [
            'name' => 'erp',
            'email' => 'erp@gmail.com',
            'password' => Hash::make('123123'),
        ];

        Erp::create($erp);
    }
}
