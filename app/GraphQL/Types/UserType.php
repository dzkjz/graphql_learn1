<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\GraphQL\Fields\PictureField;
use GraphQL\GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'A type'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the user',
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'The email of the user',
            ],
            'articles' => [
                'type' => Type::listOf(\Rebing\GraphQL\Support\Facades\GraphQL::type('Article')),
                'description' => 'The articles of the user',
            ],
            'picture' => PictureField::class
        ];
    }

    protected function resolveEmailField($root, $args)
    {
        return strtolower($root->email);
    }

    protected function resolveArticlesField($root, $args)
    {
        if (isset($args['id'])) {
            return $root->articles->where('id', $args['id']);
        }
        return $root->articles;
    }
}
