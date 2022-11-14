<?php

namespace App\Policies\Api;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CategoryPolice
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function viewAny(User $user): Response|bool
    {
        return $user->id === $user::ROLE_ADMIN
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Category $category
     * @return Response|bool
     */
    public function view(User $user, Category $category): Response|bool
    {
        return $user->id === $user::ROLE_ADMIN
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response
     */
    public function create(User $user): Response
    {
        return $user->id === $user::ROLE_ADMIN
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Category $category
     * @return Response|bool
     */
    public function update(User $user, Category $category): Response|bool
    {
        return $user->id === $user::ROLE_ADMIN
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Category $category
     * @return Response|bool
     */
    public function delete(User $user, Category $category): Response|bool
    {
        return $user->id === $user::ROLE_ADMIN
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Category $category
     * @return Response|bool
     */
    public function restore(User $user, Category $category): Response|bool
    {
        return $user->id === $user::ROLE_ADMIN
            ? Response::allow()
            : Response::denyWithStatus(403);

    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Category $category
     * @return Response|bool
     */
    public function forceDelete(User $user, Category $category): Response|bool
    {
        return $user->id === $user::ROLE_ADMIN
            ? Response::allow()
            : Response::denyWithStatus(403);
    }
}
