<?php
namespace App\Tadala\Core;

class StatusLoja
{
    private static string $filePath = __DIR__ . '/../../store_status.json';

   
    public static function getStatus(): string
    {
        if (!file_exists(self::$filePath)) {
            self::setStatus('aberto');
            return 'aberto';
        }
        $data = json_decode(file_get_contents(self::$filePath), true);
        return $data['status'] ?? 'aberto';
    }

    public static function setStatus(string $status): void
    {
        $status = in_array($status, ['aberto', 'fechado']) ? $status : 'aberto';
        file_put_contents(self::$filePath, json_encode([
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ], JSON_PRETTY_PRINT));
    }

 
    public static function toggle(): string
    {
        $current = self::getStatus();
        $new = $current === 'aberto' ? 'fechado' : 'aberto';
        self::setStatus($new);
        return $new;
    }

  
    public static function isOpen(): bool
    {
        return self::getStatus() === 'aberto';
    }
}