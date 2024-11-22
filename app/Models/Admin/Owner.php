<?php

namespace App\Models\Admin;

use App\Base\Uuid\UuidModel;
use App\Models\Traits\HasActive;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;
use App\Models\Payment\OwnerWallet;
use App\Models\Payment\OwnerWalletHistory;
use Carbon\Carbon;
use config;

class Owner extends Model
{
    use HasActive,UuidModel,SoftDeletes,SearchableTrait;

     protected $table = 'owners';

    protected $fillable = [
        'user_id','service_location_id','company_name','owner_name','name','surname','mobile','phone','email','password','address','postal_code','city','expiry_date','no_of_vehicles','tax_number','bank_name','ifsc','account_no','active','approve','transport_type'
    ];
    

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function ownerDocument()
    {
        return $this->hasMany(OwnerDocument::class, 'owner_id', 'id')->orderBy('document_id');
    }

    public function area(){
        return $this->belongsTo(ServiceLocation::class,'service_location_id','id');
    }

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'owners.company_name' => 20,
            'owners.owner_name' => 20,
            'owners.name' => 20,
            'owners.email' => 20,
            'owners.mobile' => 20,
        ],
    ];

    public function ownerWalletDetail()
    {
        return $this->hasOne(OwnerWallet::class, 'user_id', 'id');
    }

    public function ownerWalletHistoryDetail()
    {
        return $this->hasMany(OwnerWalletHistory::class, 'user_id', 'id');
    }

}
