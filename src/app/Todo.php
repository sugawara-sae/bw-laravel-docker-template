<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $table = 'todos';

    protected $fillable =
    // $fillableの定義で、代入できる項目に制限をかける。
    [
        'content',
    ];
}

?>