<?php

namespace App\Enums;


enum ApiCRUDlExceptionsEnum: string
{
    case JSONNotValid = "error.json.not.valid";

    /**
     * Получить код
     */
    public function code()
    {
        return match ($this) {
            self::JSONNotValid => -1,
        };
    }

    /**
     * Получить переведенную строку ошибки
     */
    public function label(string $replaces)
    {
        return __('crud_exception.' . $replaces);
    }
}
