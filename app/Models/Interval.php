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
     */
    public int $start;

    /**
     * The end of the interval.
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

        $this->start = $this->validateAndCastInt(
            value: $attributes['start'] ?? 0,
            field: 'start'
        );

        $this->end = isset($attributes['end'])
            ? $this->validateAndCastInt(value: $attributes['end'], field: 'end')
            : null;
    }

    /**
     * Validate and cast a value to an integer.
     *
     * @throws \InvalidArgumentException If the value is not numeric.
     */
    private function validateAndCastInt(mixed $value, string $field): int
    {
        if (!is_numeric(value: $value)) {
            throw new \InvalidArgumentException(
                message: "The {$field} attribute must be numeric."
            );
        }

        return (int) $value;
    }
}
