<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
class NotificationService
{
    /**
     * Gửi thông báo đến OneSignal
     *
     * @param string $playerId
     * @param string $message
     * @return array
     */
    // Trong phương thức sendNotification
public function sendNotification($playerId, $message)
{
    Log::info("Sending notification to player: " . $playerId);  // Log cho việc kiểm tra
    $response = Http::withHeaders([
        'Authorization' => 'Basic ' . env('ONESIGNAL_REST_API_KEY'),
    ])->post('https://onesignal.com/api/v1/notifications', [
        'app_id' => env('ONESIGNAL_APP_ID'),
        'include_player_ids' => [$playerId],
        'contents' => ['en' => $message],
    ]);

    Log::info("OneSignal response: ", $response->json());  // Log phản hồi từ OneSignal
    return $response->json();
}

}
