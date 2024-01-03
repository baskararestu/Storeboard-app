<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Product extends Model
{
    use HasFactory, Notifiable;

    protected $primaryKey = "id_product";

    protected $table = "products";

    protected $guarded = ["id_product"];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id_user");
    }
}
