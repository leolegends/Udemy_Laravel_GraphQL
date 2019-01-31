<?php

namespace App\GraphQL\Type;

use App\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'UserType',
        'description' => 'Um Type de Usuários',
        'model' => User::class
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::ID()),
                'description' => 'O id do usuario no banco de dados'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'O nome do usuario no banco de dados'
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'O email do usuario no banco de dados'
            ],
            'password' => [
                'type' => Type::string()
            ],
            'posts' => [
                'type' => Type::listOf(GraphQL::type('post_type')),
                'description' => 'Posts Por usuário'
            ]
        ];
    }
}