<?php

declare(strict_types=1);

namespace App\GraphQL\Enums;

use Rebing\GraphQL\Support\EnumType;

class ArticleStatusEnum extends EnumType
{
    protected $enumObject = true;

    protected $attributes = [
        'name' => 'ArticleStatusEnum',
        'description' => 'Article Status Enum',
//        'values' => [
////            'TEST' => [
////                'value' => 1,
////                'description' => 'test',
////            ],
//            'APPROVED' => [
//                'value' => 1,
//                'description' => 'approved',
//            ],
//            'REJECT' => [
//                'value' => 0,
//                'description' => 'reject',
//            ]
//        ],
    ];

    public function values()
    {
        return [
            'APPROVED' => '1',
            'REJECT' => '0'
        ];
    }
}
