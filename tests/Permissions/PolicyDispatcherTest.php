<?php
/**
 * Created by PhpStorm.
 * User: alexeyrudkovskiy
 * Date: 03.02.17
 * Time: 10:36
 */


use App\Classes\PolicyDispatcher;


class PolicyDispatcherTest extends TestCase
{

    public function testBasedOnPermissionsTable()
    {

        // Creating permission
        $permission = \App\Permission::create([
            'name' => 'Permission',
            'map' => [
                'organization' => [
                    'edit' => true,
                    'view' => false
                ]
            ]
        ]);

        // Creating user
        $user = factory(\App\User::class)->make();
        $user->permission()->associate($permission);
        $user->regenerateApiToken();
        $user->save();

        $policyDispatcher = app(\App\Interfaces\PolicyDispatcherInterface::class);
        $policyDispatcher->setUser($user);

        $canEdit = $policyDispatcher->dispatch(new \App\Organization(), 'edit');
        $canView = $policyDispatcher->dispatch(new \App\Organization(), 'view');

        // Deleting
        $user->delete();
        $permission->delete();

        $this->assertTrue($canEdit);
        $this->assertFalse($canView);
    }

    public function testBasedOnCustomPolicy()
    {
        // Creating permission
        $permission = \App\Permission::create([
            'name' => 'Permission',
            'map' => [
                'organization' => [
                    'edit' => true,
                    'view' => true
                ]
            ]
        ]);

        // Creating user
        $user = factory(\App\User::class)->make();
        $user->permission()->associate($permission);
        $user->regenerateApiToken();
        $user->save();

        $policy = new class extends \App\Policies\DefaultPolicy {

            public function edit(\App\User $user, \App\Organization $organization, $access)
            {
                return $access && $user->id !== null;
            }

            public function view(\App\User $user, \App\Organization $organization, $access)
            {
                return $user->id == 1 && $access;
            }

        };

        $policyDispatcher = app(\App\Interfaces\PolicyDispatcherInterface::class);
        $policyDispatcher->register(\App\Organization::class, $policy);

        $policyDispatcher->setUser($user);

        $organization = \App\Organization::first();

        $canEdit = $policyDispatcher->dispatch($organization, 'edit');
        $canView = $policyDispatcher->dispatch($organization, 'view');

        // Deleting
        $user->delete();
        $permission->delete();

        $this->assertTrue($canEdit);
        $this->assertFalse($canView);
    }

    public function testRestoreUser()
    {
        // Creating user
        $user = factory(\App\User::class)->make();
        $user->regenerateApiToken();
        $user->save();

        // Getting first user
        $firstUser = \App\User::first();
        // Log in as first user
        auth()->login($firstUser);

        // Creating policy dispatcher
        $policyDispatcher = app(\App\Interfaces\PolicyDispatcherInterface::class);
        // Setting user
        $policyDispatcher->setUser($user);
        // Restoring user
        $policyDispatcher->restoreUser();

        // Deleting
        $user->delete();

        $this->assertEquals($firstUser->id, $policyDispatcher->getUser()->id);
    }

}
