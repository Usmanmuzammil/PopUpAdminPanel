<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pos_seting extends Model
{
    use HasFactory;
    protected $fillable = ['date','closing_date','opening_time', 'closing_time','status'];

    public $timestamps=false;

    public static function createWithCustomCreatedAt($attributes, $customCreatedAt)
    {
        $model = new self($attributes);
        $model->created_at = $customCreatedAt;
        $model->save();
        return $model;
    }

    public function isStartTimePassed($startTime)
{
    $now = Carbon::now();
    $startDateTime = Carbon::createFromFormat('H:i', $startTime);

    return $now->greaterThanOrEqualTo($startDateTime);
}

public function isEndTimeOnNextDay($endTime)
{
    $now = Carbon::now();
    $endDateTime = Carbon::createFromFormat('H:i', $endTime);

    return $endDateTime->lessThan($now->copy()->addDay());
}

}
