<?php

namespace App\GraphQL\Query;

use GraphQL;
use App\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;

class UserPaginateQuery extends Query
{
    protected $attributes = [
        'name' => 'UserPaginateQuery',
        'description' => 'uma query de paginação'
    ];

    public function type()
    {
        return GraphQL::paginate('user_type');
    }

    public function args()
    {
        return [
            'page' => [
                'type' => type::int(),
                'description' => 'Pagina definida para consulta'
            ],
            'paginate' => [
                'type' => type::int(),
                'description' => 'Quantidade de registros por consulta'
            ]
        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        // $select = $fields->getSelect();
        // $with = $fields->getRelations();
        $paginate = 10;

        if(isset($args['paginate'])){
            $paginate = $args['paginate'];
        }

        $page = 1;

        if(isset($args['page'])){
            $page = $args['page'];
        }

        return User::paginate($paginate, ['*'], 'page', $page);
        
    }
}