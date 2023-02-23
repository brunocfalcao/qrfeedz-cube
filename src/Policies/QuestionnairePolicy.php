<?php

namespace QRFeedz\Cube\Policies;

use QRFeedz\Cube\Models\Questionnaire;
use QRFeedz\Cube\Models\User;

class QuestionnairePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Questionnaire $questionnaire): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Questionnaire $questionnaire): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Questionnaire $questionnaire): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Questionnaire $questionnaire): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Questionnaire $questionnaire): bool
    {
        //
    }
}
