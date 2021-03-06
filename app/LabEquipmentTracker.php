<?php

namespace App;

use App\BaseModel;

class LabEquipmentTracker extends BaseModel
{
    // protected $fillable = ['month','year','lab_id','equipment_id','datesubmitted','submittedBy','dateemailsent','datebrokendown','datereported','datefixed','downtime','samplesnorun','failedruns','reagentswasted','breakdownreason','othercomments'];



    public function lab()
    {
        return $this->belongsTo('App\Lab');
    }

    public function submitter()
    {
        return $this->belongsTo('App\User', 'submittedBy');
    }
}
