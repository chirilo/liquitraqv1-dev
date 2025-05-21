<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Liquijob extends Model
{
    //
    //use HasFactory;
    //use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_name',
        'corporate_address',
        'contact_name',
        'contact_telephone',
        'contact_email',
        'location_address',
        'start_date',
        'type',
        'job_owner_id'
    ];

    /**
     * Filter to fetch the trashed items
     *
     * @var $query, array $filters
     */
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['filter'] ?? null, function ($query, $filter) {
            if ($filter === 'only') {
                $query->onlyTrashed();
            }
        });
    }
}
