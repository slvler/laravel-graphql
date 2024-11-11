<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Product;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class CreateProductMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createProduct'
    ];

    public function type(): Type
    {
        return GraphQL::type('Product');
    }

    public function args(): array
    {
        return [
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

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        return Product::create($args);
    }
}
