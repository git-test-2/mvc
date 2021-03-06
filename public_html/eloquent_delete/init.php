<?php
use Illuminate\Database\Capsule\Manager as Capsule;
//use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

//require "../../vendor/autoload.php";
//require "../../config.php";

$capsule = new Capsule;

const CONNECTION_DEFAULT = "default";

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'Database'  => 'loftschoollss',
    'username'  => USERNAME_DB,
    'password'  => PASSWORD_DB,
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
], CONNECTION_DEFAULT);

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

$capsule->getConnection(CONNECTION_DEFAULT)->enableQueryLog();

class MicroBlogUsers extends Illuminate\Database\Eloquent\Model
{
    public $timestamps = false;
    public $table = "users";
    protected $primaryKey = "id";
    protected $connection = CONNECTION_DEFAULT;

    public function posts()
    {
        return $this->hasMany('Post', 'author_id', 'id');
    }
}

class MicroBlogMessages extends Illuminate\Database\Eloquent\Model
{
    public $timestamps = false;
    public $table = "messages";
    protected $primaryKey = "id";
    protected $connection = CONNECTION_DEFAULT;

    public function userdata()
    {
        return $this->belongsTo(MicroBlogUsers::class, 'author_id', 'id');
    }
}
