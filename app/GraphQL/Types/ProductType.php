<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\Models\Product;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ProductType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Product',
        'model' => Product::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'product table id'
            ],
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'product table title'
            ],
            'desc' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'product table desc'
            ]
        ];
    }
}
