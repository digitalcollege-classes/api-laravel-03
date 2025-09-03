<?php

namespace App\Jobs;

use App\Models\User;
use App\Notification\UserCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class EnviarEmailJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private User $user,
    )
    {
    }

    public function handle(): void
    {
        $email = new UserCreatedNotification($this->user->name);
        Mail::to($this->user)->send($email);
    }
}
