<?php

declare(strict_types=1);

namespace App\GraphQL\Fields;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Field;

class PictureField extends Field
{
    protected $attributes = [
        'description' => 'A picture'
    ];

    public function type(): Type
    {
        return Type::string();
    }

    public function args(): array
    {
        return [
            'width' => [
                'type' => Type::int(),
                'description' => 'The width of the picture'
            ],
            'height' => [
                'type' => Type::int(),
                'description' => 'The height of the picture'
            ]
        ];
    }

    public function resolve($root, $args): string
    {
        $width = isset($args['width']) ? $args['width'] : 100;
        $height = isset($args['height']) ? $args['height'] : 100;
        return 'http://placehold.it/' . $width . 'x' . $height;
    }
}
