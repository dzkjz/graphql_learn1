<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class UserQuery extends Query
{
    protected $attributes = [
        'name' => 'user',
        'description' => 'A query'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('User'));
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::string(),
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::string(),
            ],
        ];
    }

//    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
//    {
////        /** @var SelectFields $fields */
////        $fields = $getSelectFields();
////        $select = $fields->getSelect();
////        $with = $fields->getRelations();
////
////        return [
////            'The user works',
////        ];
//        if (isset($args['id'])) {
//            return User::where('id', $args['id'])->get();
//        } elseif (isset($args['email'])) {
//            return User::where('email', $args['email'])->get();
//        } else {
//            return User::all();
//        }
//    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $fields = $resolveInfo->getFieldSelection($depth = 3);

        if (isset($args['id'])) {
            $user = User::where('id', $args['id']);
        } elseif (isset($args['email'])) {
            $user = User::where('email', $args['email']);
        } else {
            $user = User::query();
        }

        foreach ($fields as $field => $keys) {
            if ($field == 'articles') {
                $user->with('articles');
            }
        }

        return $user->get();
    }

}
