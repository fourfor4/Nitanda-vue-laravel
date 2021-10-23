<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Broadcast::routes(['middleware' => 'jwt.auth']);
        Broadcast::routes();
        // Broadcast::PrivateChannel('question.created', function($question, $user) {
        //     return true;
        // });
        require base_path('routes/channels.php');
    }
}
