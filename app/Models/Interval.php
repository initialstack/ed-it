<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Interval extends Model
{
    /** @use HasFactory<\Database\Factories\IntervalFactory> */
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['strat', 'end'];

    /**
     * The start of the interval.
     *
     * @var int
     */
    public int $start;

    /**
     * The end of the interval.
     *
     * @var int|null
     */
    public ?int $end = null;

    /**
     * Initialize the Interval model.
     *
     * @param array<string, mixed> $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct(attributes: $attributes);
        
        $this->start = $attributes['start'] ?? 0;
        $this->end = $attributes['end'] ?? null;
    }
}
