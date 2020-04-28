<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ArticleType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Article',
        'description' => 'A type'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the article',
            ],
            'title' => [
                'name' => 'title',
                'type' => Type::nonNull(Type::string()),
                'description' => 'The title of the article',
            ],
            'body' => [
                'name' => 'body',
                'type' => Type::nonNull(Type::string()),
                'description' => 'The body of the article',
            ],
            'status' => [
                'name' => 'status',
                'type' => GraphQL::type('ArticleStatusEnum'),
                'description' => 'The status of the article',
            ]

        ];
    }
}
