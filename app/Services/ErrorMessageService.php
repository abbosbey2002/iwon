<?php

namespace App\Services;

class ErrorMessageService
{
    /**
     * Get error message by code.
     */
    public function getMessage(int $code): string
    {
        return trans(match ($code) {
            0 => 'app.errors.0',
            1 => 'app.errors.1',
            2 => 'app.errors.2',
            3 => 'app.errors.3',
            4 => 'app.errors.4',
            5 => 'app.errors.5',
            default => 'app.errors.default'  // Default xabar noto‘g‘ri kodlar uchun
        });
    }
}
