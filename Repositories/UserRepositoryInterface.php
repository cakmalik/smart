<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    /**
     * Get's a record by it's ID
     *
     * @param int
     */
    public function get($id);

    /**
     * Get's all records.
     *
     * @return mixed
     */
    public function all(): Collection;

    /**
     * Deletes a record.
     *
     * @param int
     */
    public function delete($id);

    /**
     * Updates a record.
     *
     * @param int
     * @param array
     */
    public function update($id, array $data);

    /**
     * create
     *
     * @param  mixed $data
     * @return User
     */
    public function create(array $data): User;
}
