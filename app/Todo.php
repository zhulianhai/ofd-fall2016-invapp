<?php
namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Todo
 *
 * @package App
 * @property string $task
 * @property text $notepad
*/
class Todo extends Model
{
    
    protected $fillable = ['task', 'notepad'];
    
    
}
