<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;
    public function get_asset()
    {
        return $this->belongsTo(Asset::class, 'assetId');
    }
    public function get_type()
    {
        return $this->belongsTo(Type::class, 'typeId');
    }
}
