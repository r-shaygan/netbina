<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected function deadline(): Attribute
    {
        return Attribute::make(
            set: fn($value) => date('Y-m-d H:i:00', strtotime($value))
        );
    }

    public function assignerUser()
    {
        return $this->belongsTo(User::class, 'assigner', 'id');
    }

    public function ownerUser()
    {
        return $this->belongsTo(User::class, 'owner', 'id');
    }

    public function isDelayed():bool
    {
        return strtotime($this->deadline) < time() && $this->status==0;
    }

    public function isPending()
    {
        return strtotime($this->deadline) >= time() && $this->status==0;
    }

    public function isAccepted()
    {
        return  $this->status==1;
    }
}
