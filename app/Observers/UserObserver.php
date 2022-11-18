<?php

namespace App\Observers;

use App\Mail\UserRegistered;
use App\Models\User;
use App\Tenant\TenantObserver;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserObserver
{

    use TenantObserver;

    /**
     * @param User $user
     * @return void
     */
    public function creating(User $user): void
    {
        $user->password = Hash::make($user->password);
        $user->company_id = $this->getCompanyId();
    }

    /**
     * Handle the User "created" event.
     *
     * @param User $user
     * @return void
     */
    public function created(User $user): void
    {
        Mail::to($user->email)->send(new UserRegistered($user));
    }

    /**
     * @param User $user
     * @return void
     */
    public function updating(User $user)
    {

    }

    /**
     * Handle the User "updated" event.
     *
     * @param User $user
     * @return void
     */
    public function updated(User $user)
    {

    }

    /**
     * Handle the User "deleted" event.
     *
     * @param User $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the User "restored" event.
     *
     * @param User $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param User $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
