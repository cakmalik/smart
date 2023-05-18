<?php


namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Collection;



class UserRepository implements UserRepositoryInterface
{
    /**
     * Get's a record by it's ID
     *
     * @param int
     * @return collection
     */
    public function get($id)
    {
        return User::find($id);
    }

    /**
     * Get's all records.
     *
     * @return mixed
     */
    public function all(): Collection
    {
        return User::all();
    }

    /**
     * Deletes a record.
     *
     * @param int
     */
    public function delete($id)
    {
        User::destroy($id);
    }

    /**
     * Updates a post.
     *
     * @param int
     * @param array
     */
    public function update($id, array $data)
    {
        User::find($id)->update($data);
    }

    public function create(array $data): User
    {
        return User::create($data);
    }
}
