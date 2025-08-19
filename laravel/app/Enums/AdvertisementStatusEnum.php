<?php

namespace App\Enums;

enum AdvertisementStatusEnum: string
{
    case ACTIVE = 'active';
    case PAUSED = 'paused';
    case SOLD = 'sold';
    case PUBLISHED = 'published';
    case INACTIVE = 'inactive';

    public function label(): string
    {
        return match($this) {
            self::ACTIVE => 'Ativo',
            self::PAUSED => 'Pausado',
            self::SOLD => 'Vendido',
            self::PUBLISHED => 'Publicado',
            self::INACTIVE => 'Inativo',
        };
    }
}
