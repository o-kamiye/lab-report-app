<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    //
    protected $fillable = ['name'];

    public static function getAll() {
        return self::orderBy('name', 'asc')
                    ->get();
    }
}
