<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Larament\Barta\Facades\Barta;
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

    public function handle()
    {
        $user = User::find($this->userId);
        if (! $user) {
            Log::warning('SendApprovalSms: user not found', ['user_id' => $this->userId]);
            return;
        }

        if (! $user->phone) {
            Log::info('SendApprovalSms: user has no phone, skipping SMS', ['user_id' => $this->userId]);
            return;
        }

        $message = "আপনার রেজিস্ট্রেশন অনুমোদিত হয়েছে। এখন আপনি লগইন করতে পারবেন। - Reunion";

        try {
            Barta::to($user->phone)
                ->message($message)
                ->send();
        } catch (\Throwable $e) {
            Log::error('SendApprovalSms: Barta send failed', ['error' => $e->getMessage(), 'user_id' => $this->userId]);
        }
    }
}
