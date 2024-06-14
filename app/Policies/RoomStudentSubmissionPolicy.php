<?php

namespace App\Policies;

use App\Models\Student\RoomStudentSubmission;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RoomStudentSubmissionPolicy
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
    public function view(User $user, RoomStudentSubmission $roomStudentSubmission): bool
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
    public function update(User $user, RoomStudentSubmission $roomStudentSubmission): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, RoomStudentSubmission $roomStudentSubmission): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, RoomStudentSubmission $roomStudentSubmission): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, RoomStudentSubmission $roomStudentSubmission): bool
    {
        //
    }
}
