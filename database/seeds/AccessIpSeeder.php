<?php

use Illuminate\Database\Seeder;
use App\AccessIp;

class AccessIpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ips = ['172.28.79.209', '183.82.22.244', '127.0.0.1']; // you can add and remove default ips from here
        foreach ($ips as $key => $ip) {
        	AccessIp::firstOrCreate(['address' => $ip]);
        }
    }
}
