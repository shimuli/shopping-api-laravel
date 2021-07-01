<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'identifier'=> (int)$user->id,
            'name'=>(string)$user->name,
            'tel'=>(string)$user->phone,
            'isVerified'=> (int)$user->verified,
            'isAdmin'=>($user->admin ==='true'),
            'createdDate'=> (string)$user->created_at,
            'lastChange'=> (string)$user->updated_at,
            'deletedDate'=> $user->isset($user->deleted_at) ? (string) $user->deleted_at : null,
        ];
    }
}
