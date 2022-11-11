<?php 
namespace App\Models;
use CodeIgniter\Model;
class CounterModel extends Model
{
    protected $table = 'message_word_counter';
    protected $primaryKey = 'id';
    
    protected $allowedFields = ['words_length', 'articles_comments'];
}