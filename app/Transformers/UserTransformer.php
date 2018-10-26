<?php
namespace App\Transformers;
use App\User;
use App\Transformers\TransformerAbstract;

class UserTransformer extends TransformerAbstract{
    public function transform($user){
        return [
            'fullname' => $user->name,
            'email' => $user->email,
            'api_token' => $user->api_token,
        ];
    }

}
?>