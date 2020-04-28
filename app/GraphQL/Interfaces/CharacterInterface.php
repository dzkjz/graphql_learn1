<?php

declare(strict_types=1);

namespace App\GraphQL\Interfaces;

use GraphQL\Type\Definition\StringType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\InterfaceType;

class CharacterInterface extends InterfaceType
{
    protected $attributes = [
        'name' => 'CharacterInterface',
        'description' => 'Character interface',
    ];

    public function resolveType($root): StringType
    {
        // Use the resolveType to resolve the Type which is implemented trough this interface
        $type = $root['type'];
        if ($type === 'human') {
            return GraphQL::type('Human');
        } else if ($type === 'droid') {
            return GraphQL::type('Droid');
        }
    }

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the character.'
            ],
            'appearsIn' => [
                'type' => Type::nonNull(Type::listOf(GraphQL::type('Episode'))),
                'description' => 'A list of episodes in which the character has an appearance.'
            ],
        ];
    }
}
