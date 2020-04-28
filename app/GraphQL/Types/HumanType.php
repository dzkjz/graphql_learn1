<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class HumanType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Human',
        'description' => 'A Human'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the human.',
            ],
            'appearsIn' => [
                'type' => Type::nonNull(Type::listOf(GraphQL::type('Episode'))),
                'description' => 'A list of episodes in which the human has an appearance.'
            ],
            'totalCredits' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The total amount of credits this human owns.'
            ]
        ];
    }

    public function interfaces(): array
    {
        return [
            GraphQL::type('Character')
        ];
    }
}
