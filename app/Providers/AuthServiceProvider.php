<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->before(function ($user, $ability) {
            if ($user->is_admin === 1) {
                return true;
            }
        });

        //在门面里定义了一个用户授权的权限
        $gate->define('manage-posts', function ($user) {
            return $user->is_admin === 1;
        });

        //查看用户是否有权删除对应评论
        $gate->define('delete-comment',function($user,$comment){
            return $user->id === $comment->uid;
        });
    }
}
