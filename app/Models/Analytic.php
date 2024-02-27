<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;


class Analytic extends Model
{
    use HasFactory;

    protected $table = 'analytics';

    protected $fillable = [
        'session',
        'contact_id',
        'uri',
        'source',
        'country',
        'state',
        'browser',
        'device',
        'operating_system',
        'ip',
        'language',
        'meta',
    ];

    protected $casts = [
        'session' => 'string',
        'contact_id' => 'integer',
        'uri' => 'string',
        'source' => 'string',
        'country' => 'string',
        'state' => 'string',
        'browser' => 'string',
        'device' => 'string',
        'operating_system' => 'string',
        'ip' => 'string',
        'language' => 'string',
        'meta' => 'json',
    ];

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class, 'contact_id', 'id');
    }
}
