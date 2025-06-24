<?php

namespace App\Enums;

enum UserTypeEnum: string
{

    case Admin = 'admin';

    case Company =  'company';

    /**
     * @param  UserTypeEnum  $state
     * @return void
     */
    public function getColor(): string
    {
        return match ($this) {
            UserTypeEnum::Admin => 'success',
            UserTypeEnum::Company => 'warning',
        };

    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Admin => 'admin',
            self::Company => 'company',
        };
    }
}
