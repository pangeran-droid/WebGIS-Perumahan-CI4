<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUser extends Model
{
    protected $table = 'tbl_user';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'email', 'password', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}