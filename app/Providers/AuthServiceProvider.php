<?php

namespace App\Providers;

use App\Constant;
use App\Models\Post;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Laravel\Sanctum\Sanctum;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
//        'App\Model' => 'App\Policies\ModelPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();
        Sanctum::personalAccessTokenModel();

        Gate::before(function ($user) {
            if (is_null($user)) {
                return view('errors.not_found');
            }
            return ($user->posts()->where('user_id', $user->id)->exists() || $user->role_id == 1);
        });
    }
}
