<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'username',
        'full_name',
        'email',
        'avatar',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = false;

    public function getAllUsers(): array
    {
        return $this->orderBy('id', 'DESC')->findAll();
    }
}