<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Server;
use Illuminate\Database\Seeder;

class ServerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first company or create one if none exists
        $company = Company::first();

        // Create or update sample servers for the company
        Server::updateOrCreate(
            ['company_id' => $company->id, 'host' => '192.168.1.1'], // Unique identifying attributes
            [
                'name' => 'Server 1',
                'description' => 'Main application server',
                'ssh_login_type' => 'password',
                'ssh_user' => 'root',
                'ssh_port' => '22',
                'ssh_password' => 'securepassword',
                'ssh_private_key' => null,
            ]
        );

        Server::updateOrCreate(
            ['company_id' => $company->id, 'host' => '192.168.1.2'],
            [
                'name' => 'Server 2',
                'description' => 'Backup server',
                'ssh_login_type' => 'key',
                'ssh_user' => 'admin',
                'ssh_port' => '2222',
                'ssh_password' => null,
                'ssh_private_key' => 'private_key_content',
            ]
        );
    }
}
