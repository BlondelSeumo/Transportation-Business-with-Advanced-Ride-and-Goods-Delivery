<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use App\Base\Uuid\UuidModel;
use App\Models\User;
use App\Models\Master\Project;


class PocClient extends Model
{
	use UuidModel;

	   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'poc_clients';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','project_id'
    ];

    /**
     * The roles associated with the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    // *
    //  * The roles associated with the user.
    //  *
    //  * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     
    // public function project()
    // {
    //     return $this->belongsTo(Project::class, 'id', 'project_id');
    // }
}
