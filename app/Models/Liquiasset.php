<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Liquiasset extends Model
{
    //
    //
    //use HasFactory;
    //use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'job_asset',
        'job_id',
        'asset_category',
        'asset_quantity',
        'asset_type',
        'asset_make',
        'asset_model',
        'asset_serial',
        'asset_weight_each',
        'asset_description',
        'asset_status',
        'asset_disposition',
        'assetdisdate',
        'assetdiswho',
        'assetdiswho',
        'assetdisticketshippinginfo',
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
