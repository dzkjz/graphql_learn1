<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use App\User;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class UpdateUserEmailMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateUserEmail',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return GraphQL::type('User');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::string()),
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string()),
            ],
        ];
    }

    public function rules(array $args = []): array
    {
        return [
            'id' => 'required',
            'email' => ['required', 'email'],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
//        $fields = $getSelectFields();
//        $select = $fields->getSelect();
//        $with = $fields->getRelations();
//
//        return [];

        $user = User::find($args['id']);

        if (!$user) {
            return null;
        }

        $user->email = $args['email'];

        $user->save();

        return $user;
    }
}
