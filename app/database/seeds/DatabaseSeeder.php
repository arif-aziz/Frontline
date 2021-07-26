<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call('UserSeeder');
		$this->call('AktifitasUserSeeder');
		$this->call('TipeUserSeeder');
		$this->call('HakAksesSeeder');

        $this->command->info('Tables seeded!');
	}

}
