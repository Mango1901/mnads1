<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoogleReport extends Model
{

    protected $fillable=[
        'user_id','clicks_desktop','cost_desktop','ctr_desktop','averageCpc_desktop','impressions_desktop','segments_desktop',
        'clicks_mobile','cost_mobile','ctr_mobile','averageCpc_mobile','impressions_mobile','segments_mobile',
        'clicks_tablet','cost_tablet','ctr_tablet','impressions_tablet','segments_tablet','averageCpc_tablet'
    ];
    protected $primaryKey = 'id';
    protected $table= 'google_reports';
}
