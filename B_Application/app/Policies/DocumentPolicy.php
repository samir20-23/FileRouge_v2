<?php

namespace App\Policies;

use App\Models\Document;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DocumentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
     

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Document $document): bool
    {
       return $user->isAdmin() || $user->isFormateur() || $user->id === $document->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
   
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Document $document): bool
    {
       return $user->isAdmin() || $user->isFormateur() || $user->id === $document->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Document $document): bool
    {
       return $user->isAdmin() || $user->isFormateur() || $user->id === $document->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Document $document): bool
    {
       return $user->isAdmin() || $user->isFormateur() || $user->id === $document->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Document $document): bool
    {
       return $user->isAdmin() || $user->isFormateur() || $user->id === $document->user_id;
    }
}
