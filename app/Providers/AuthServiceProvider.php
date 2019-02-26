<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Crit;
use App\Policies\CritPolicy;
use App\Group;
use App\Policies\GroupPolicy;
use App\GroupMembership;
use App\Policies\GroupMembershipPolicy;
use App\Page;
use App\Policies\PagePolicy;
use App\Paste;
use App\Policies\PastePolicy;
use App\Upload;
use App\Policies\UploadPolicy;
use App\User;
use App\Policies\UserPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Crit::class => CritPolicy::class,
        Group::class => GroupPolicy::class,
        GroupMembership::class => GroupMembershipPolicy::class,
        Page::class => PagePolicy::class,
        Paste::class => PastePolicy::class,
        Upload::class => UploadPolicy::class,
        User::class => UserPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('crits.view', 'App\Policy\CritPolicy@view');
        Gate::define('crits.create', 'App\Policy\CritPolicy@create');
        Gate::define('crits.update', 'App\Policy\CritPolicy@update');
        Gate::define('crits.delete', 'App\Policy\CritPolicy@delete');
        Gate::define('crits.restore', 'App\Policy\CritPolicy@restore');
        Gate::define('crits.forceDelete', 'App\Policy\CritPolicy@forceDelete');

        Gate::define('groups.view', 'App\Policy\GroupPolicy@view');
        Gate::define('groups.create', 'App\Policy\GroupPolicy@create');
        Gate::define('groups.update', 'App\Policy\GroupPolicy@update');
        Gate::define('groups.delete', 'App\Policy\GroupPolicy@delete');
        Gate::define('groups.restore', 'App\Policy\GroupPolicy@restore');
        Gate::define('groups.forceDelete', 'App\Policy\GroupPolicy@forceDelete');

        Gate::define('groupmemberships.view', 'App\Policy\GroupMembershipPolicy@view');
        Gate::define('groupmemberships.create', 'App\Policy\GroupMembershipPolicy@create');
        Gate::define('groupmemberships.update', 'App\Policy\GroupMembershipPolicy@update');
        Gate::define('groupmemberships.delete', 'App\Policy\GroupMembershipPolicy@delete');
        Gate::define('groupmemberships.restore', 'App\Policy\GroupMembershipPolicy@restore');
        Gate::define('groupmemberships.forceDelete', 'App\Policy\GroupMembershipPolicy@forceDelete');

        Gate::define('pages.view', 'App\Policy\PagePolicy@view');
        Gate::define('pages.create', 'App\Policy\PagePolicy@create');
        Gate::define('pages.update', 'App\Policy\PagePolicy@update');
        Gate::define('pages.delete', 'App\Policy\PagePolicy@delete');
        Gate::define('pages.restore', 'App\Policy\PagePolicy@restore');
        Gate::define('pages.forceDelete', 'App\Policy\PagePolicy@forceDelete');

        Gate::define('pastes.view', 'App\Policy\PastePolicy@view');
        Gate::define('pastes.create', 'App\Policy\PastePolicy@create');
        Gate::define('pastes.update', 'App\Policy\PastePolicy@update');
        Gate::define('pastes.delete', 'App\Policy\PastePolicy@delete');
        Gate::define('pastes.restore', 'App\Policy\PastePolicy@restore');
        Gate::define('pastes.forceDelete', 'App\Policy\PastePolicy@forceDelete');

        Gate::define('uploads.view', 'App\Policy\UploadPolicy@view');
        Gate::define('uploads.create', 'App\Policy\UploadPolicy@create');
        Gate::define('uploads.update', 'App\Policy\UploadPolicy@update');
        Gate::define('uploads.delete', 'App\Policy\UploadPolicy@delete');
        Gate::define('uploads.restore', 'App\Policy\UploadPolicy@restore');
        Gate::define('uploads.forceDelete', 'App\Policy\UploadPolicy@forceDelete');

        Gate::define('users.view', 'App\Policy\UserPolicy@view');
        Gate::define('users.create', 'App\Policy\UserPolicy@create');
        Gate::define('users.update', 'App\Policy\UserPolicy@update');
        Gate::define('users.delete', 'App\Policy\UserPolicy@delete');
        Gate::define('users.restore', 'App\Policy\UserPolicy@restore');
        Gate::define('users.forceDelete', 'App\Policy\UserPolicy@forceDelete');
    }
}
