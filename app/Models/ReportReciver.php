<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportReciver extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'report_id',
        'reciver_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'deleted_at',
    ];

    /**
     * Relationship: Sebuah penerima (ReportReciver) dimiliki oleh satu laporan (Report).
     */
    public function report()
    {
        return $this->belongsTo(Report::class, 'report_id');
    }

    /**
     * Relationship: Sebuah penerima (ReportReciver) dimiliki oleh satu user (User).
     */
    public function reciver()
    {
        return $this->belongsTo(User::class, 'reciver');
    }
}
