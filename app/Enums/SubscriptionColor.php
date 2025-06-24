<?php

namespace App\Enums;

enum SubscriptionColor: string
{
    case Bronze = 'bronze';
    case Silver = 'silver';
    case Gold = 'gold';
    case Platinum = 'platinum';


    public function getColor(): string
    {
        return match ($this) {
            self::Bronze => '#cd7f32',  // لون برونزي (Bronze)
            self::Silver => '#c0c0c0',  // لون فضي (Silver)
            self::Gold => '#ffd700',     // لون ذهبي (Gold)
            self::Platinum => '#e5e4e2', // لون بلاتيني (Platinum)
        };
    }

    public function price(): int
    {
        return match ($this) {
            self::Bronze => 100,
            self::Silver => 300,
            self::Gold => 500,
            self::Platinum => 1000,
        };
    }

    public function messageBalance(): int
    {
        return match ($this) {
            self::Bronze => 100,
            self::Silver => 500,
            self::Gold => 1000,
            self::Platinum => 5000,
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::Bronze => 'Basic plan suitable for starters.',
            self::Silver => 'Affordable plan with additional features.',
            self::Gold => 'Advanced plan with premium benefits.',
            self::Platinum => 'Premium plan with all-inclusive features.',
        };
    }

}
