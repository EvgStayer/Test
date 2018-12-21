<?php

use Illuminate\Database\Seeder;

/**
 * Generate data
 */
class DatabaseSeeder extends Seeder
{
	public $FirstName = array('Adney','Aldo','Aleyn','Alford','Amherst','Angel','Anson','Archibald','Aries','Arwen','Astin','Atley','Atwell','Audie','Avery','Ayers','Baker','Balder','Ballentine','Bardalph','Barker','Barric','Bayard','Bishop','Blaan','Blackburn','Blade','Blaine','Blaze','Bramwell','Brant','Brawley','Breri','Briar','Brighton','Broderick','Bronson','Bryce','Burdette','Burle');
	public $LastName = array('Na','Naab','Naar','Naas','Naasz','Naatz','Nabb','Naber','Nabers','Nabholz','Nabor','Nabors','Nabours','Nabozny','Naccarato','Nace','Nacey','Nachazel','Nachbar','Nachman','Nachreiner','Nacht','Nachtigal','Nachtigall','Nachtman','Nachtwey','Nack','Nacke','Naclerio','Nadal','Nadeau','Nadel','Nadell','Nadelman','Naden','Nader','Naderi','Nadig','Nading','Nadkarni');

	public function run()
	{
		DB::table('clients')->delete();
		for ($i=0; $i < 40; $i++) 
		{ 
			$fio = $this->FirstName[rand(0,39)] . ' ' . $this->LastName[rand(0,39)];
			DB::table('clients')->insert([
				'fio' =>  $fio,
				'email' => mb_strtolower(preg_replace('/\s/', '-', $fio)) . '@gmail.com',
				'balance' => 0,
				'status' => false,
	 			'next_payment' => date('Y-m-d'),
	 			'last_payment' => date('Y-m-d'),
	 			'last_payment' => date('Y-m-d'),
	            'create_date' => date('Y-m-d', strtotime('-' . rand(0,365) .' days'))
			]);
		}
	}
}
