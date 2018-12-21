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
			$days = rand(0,365);
			$balance = rand(0,20);
			$create_date = strtotime('-' . $days .' days');
			if ($balance>10) $days = rand(0,28);
			$last_payment = strtotime('-' . rand(0,$days) .' days');	
			$next_payment = strtotime('+1 month', $last_payment);
			$status = ($next_payment < time() && $balance < 10 ? false : true ); 


			DB::table('clients')->insert([
				'fio' =>  $fio,
				'email' => mb_strtolower(preg_replace('/\s/', '-', $fio)) . '@gmail.com',
				'balance' => $balance,
				'status' => $status,
	 			'next_payment' => date('Y-m-d' , $next_payment),
	 			'last_payment' => date('Y-m-d', $last_payment),
	            'create_date' => date('Y-m-d', $create_date)
			]);
		}
	}
}
