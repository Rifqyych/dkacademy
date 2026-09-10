<?php

namespace App\Services;

use App\Models\Registration;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppRegistrationNotifier
{
    public function send(Registration $registration): bool
    {
        $token = config('whatsapp.cloud_api_token');
        $phoneNumberId = config('whatsapp.cloud_phone_number_id');
        $adminPhone = $this->normalizePhone(config('whatsapp.admin_phone'));

        if (!$token || !$phoneNumberId || !$adminPhone) {
            Log::warning('WhatsApp registration notification was not sent because the API configuration is incomplete.', [
                'registration_id' => $registration->id,
                'has_token' => (bool) $token,
                'has_phone_number_id' => (bool) $phoneNumberId,
                'has_admin_phone' => (bool) $adminPhone,
            ]);

            return false;
        }

        $version = trim(config('whatsapp.cloud_api_version', 'v23.0'), '/');
        $endpoint = "https://graph.facebook.com/{$version}/{$phoneNumberId}/messages";
        $payload = $this->payload($registration, $adminPhone);

        try {
            $response = Http::withToken($token)
                ->acceptJson()
                ->asJson()
                ->timeout(15)
                ->post($endpoint, $payload);
        } catch (\Throwable $exception) {
            Log::error('WhatsApp registration notification request failed.', [
                'registration_id' => $registration->id,
                'error' => $exception->getMessage(),
            ]);

            return false;
        }

        if ($response->successful()) {
            return true;
        }

        Log::error('WhatsApp registration notification was rejected by the API.', [
            'registration_id' => $registration->id,
            'status' => $response->status(),
            'response' => $response->json() ?? $response->body(),
        ]);

        return false;
    }

    private function payload(Registration $registration, string $adminPhone): array
    {
        $templateName = config('whatsapp.template_name');

        if ($templateName) {
            return [
                'messaging_product' => 'whatsapp',
                'to' => $adminPhone,
                'type' => 'template',
                'template' => [
                    'name' => $templateName,
                    'language' => [
                        'code' => config('whatsapp.template_language', 'id'),
                    ],
                    'components' => [
                        [
                            'type' => 'body',
                            'parameters' => [
                                ['type' => 'text', 'text' => $registration->full_name],
                                ['type' => 'text', 'text' => $registration->email],
                                ['type' => 'text', 'text' => $registration->phone],
                                ['type' => 'text', 'text' => $registration->program],
                                ['type' => 'text', 'text' => $registration->level],
                                ['type' => 'text', 'text' => $registration->message ?: '-'],
                            ],
                        ],
                    ],
                ],
            ];
        }

        return [
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => $adminPhone,
            'type' => 'text',
            'text' => [
                'preview_url' => false,
                'body' => $this->message($registration),
            ],
        ];
    }

    private function message(Registration $registration): string
    {
        return implode("\n", [
            'Halo Admin DK Academy, ada pendaftaran baru dari website.',
            '',
            'Nama: ' . $registration->full_name,
            'Email: ' . $registration->email,
            'WhatsApp/Phone: ' . $registration->phone,
            'Program: ' . $registration->program,
            'Level: ' . $registration->level,
            'Pesan: ' . ($registration->message ?: '-'),
            '',
            'Mohon segera follow up calon peserta ini.',
        ]);
    }

    private function normalizePhone(?string $phone): ?string
    {
        if (!$phone) {
            return null;
        }

        $phone = preg_replace('/\D+/', '', $phone);

        if (str_starts_with($phone, '0')) {
            return '62' . substr($phone, 1);
        }

        if (str_starts_with($phone, '8')) {
            return '62' . $phone;
        }

        return $phone;
    }
}
