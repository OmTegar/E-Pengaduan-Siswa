<?php

namespace App\Models;

use App\Models\User;
use App\Models\ReportReciver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\ReportAttachment;
use Illuminate\Support\Str;


class Report extends Model
{
    use HasFactory;
    use HasUuids;

    protected $with = ['sender', 'reciver', 'attachments'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sender_id',
        'subject',
        'sessage',
        'status',
        'soomType',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'Sender_id' => 'integer',
        'Status' => 'string',
        'RoomType' => 'string',
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
     * Relationship: Sebuah laporan dimiliki oleh satu pengirim (User).
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Relationship: Sebuah laporan dapat memiliki banyak penerima (reciver).
     */
    public function reciver()
    {
        return $this->hasMany(ReportReciver::class, 'report_id');
    }

    /**
     * Relationship: Sebuah laporan dapat memiliki banyak lampiran (Attachments).
     */
    public function attachments()
    {
        return $this->hasMany(ReportAttachment::class, 'report_id');
    }

    public static function getAnonymousName(): string
    {
        return Str::random(10);
    }

    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->diffForHumans();
    }

    public function getUpdatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->diffForHumans();
    }

    public function comments()
    {
        return $this->hasMany(ReportComment::class, 'report_id');
    }

    public function publicView()
    {
        return $this->hasOne(ReportPublicView::class, 'report_id');
    }
}
