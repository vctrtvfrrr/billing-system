<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'debt_id',
        'name',
        'government_id',
        'email',
        'debt_amount',
        'debt_due_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'debt_id'       => 'integer',
        'debt_amount'   => 'float',
        'debt_due_date' => 'date',
    ];
}
