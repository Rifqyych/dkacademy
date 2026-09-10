<?php

return [
    'admin_phone' => env('WHATSAPP_ADMIN_PHONE', '6281210669659'),
    'cloud_api_token' => env('WHATSAPP_CLOUD_API_TOKEN'),
    'cloud_phone_number_id' => env('WHATSAPP_CLOUD_PHONE_NUMBER_ID'),
    'cloud_api_version' => env('WHATSAPP_CLOUD_API_VERSION', 'v23.0'),
    'template_name' => env('WHATSAPP_CLOUD_TEMPLATE_NAME'),
    'template_language' => env('WHATSAPP_CLOUD_TEMPLATE_LANGUAGE', 'id'),
];
