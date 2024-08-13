<?php

namespace App\Data\Backend\User;

use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Attributes\Validation\Unique;
use Spatie\LaravelData\Data;

class UserData extends Data
{
    public function __construct(
        #[Required,StringType,Max(30)]
        public string $name,

        #[Required,StringType,Max(100),Unique()]
        public string $email,

        #[Required,StringType,Max(100)]
        public string $password,

        #[Required,StringType]
        public string $roles,
    ) {}

    public static function rules():array
    {
        return [];
    }

    public static function messages():array
    {
        return [
            'name' => 'please enter name.'
        ];
    }
}
