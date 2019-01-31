<?php

namespace App\GraphQL\Mutation;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;
use App\User;
use GraphQL;

class UserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'UserMutation',
        'description' => 'Mutation cadastra usuario'
    ];

    public function type()
    {
    
        return GraphQL::type('user_type');
    
    }
    
    public function args()
    {
        return [
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => "Nome do usuario"
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => "Email do usuario"
            ],
            "password" => [
                'type' => Type::nonNull(Type::string()),
                'description' => "Senha do usuario"
            ]
        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        $user = User::create([
            'name' => $args['name'],
            'email' => $args['email'],
            'password' => bcrypt($args['password'])
        ]);

        return $user;
    }
}