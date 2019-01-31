<?php

namespace App\GraphQL\Query;

use GraphQL;
use App\Post;
use App\User;
use GraphQL\Type\Definition\Type;

use Rebing\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;

class PostQuery extends Query
{
    protected $attributes = [
        'name' => 'PostQuery',
        'description' => 'A query'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('post_type'));
    }

    public function args()
    {
        return [
            'user_id' => [
                'type' => Type::int(), 
                'description' => 'Id do Usuário'
            ]
        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        // $select = $fields->getSelect();
        // $with = $fields->getRelations();

        return Post::all();

    }
}