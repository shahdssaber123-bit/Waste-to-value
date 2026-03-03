<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Order;
use App\Models\Rating;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin
        User::factory()->admin()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        // Create collectors
        $collectors = User::factory(3)->collector()->create();

        // Create regular users
        $users = User::factory(10)->create();

        // Create orders for each user
        foreach ($users as $user) {
            $orders = Order::factory(rand(1, 3))->create([
                'user_id' => $user->id,
                'collector_id' => $collectors->random()->id,
                'status' => $this->randomStatus(),
            ]);

            // Create ratings for completed orders
            foreach ($orders as $order) {
                if ($order->status === 'completed' && rand(0, 1)) {
                    Rating::factory()->create([
                        'order_id' => $order->id,
                        'user_id' => $user->id,
                    ]);
                }
            }
        }
    }

    private function randomStatus()
    {
        $statuses = ['pending', 'assigned', 'in_progress', 'completed'];
        return $statuses[array_rand($statuses)];
    }
}
