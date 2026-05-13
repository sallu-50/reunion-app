<?php

namespace App\Jobs;

use App\Models\User;
use App\Services\MimsmsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendApprovalSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    public function handle(MimsmsService $mimsms)
    {
        $user = User::find($this->userId);
        if (! $user || ! $user->phone) {
            return;
        }

        $message = "আপনার রেজিস্ট্রেশন অনুমোদিত হয়েছে। এখন আপনি লগইন করতে পারবেন। - Reunion";
        $mimsms->send($user->phone, $message);
    }
}
