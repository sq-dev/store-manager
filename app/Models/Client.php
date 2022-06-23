<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'address',
        'email',
        'comment',
    ];

    public function countCreated(int $day)
    {
        $count = [];
        for ($i=0; $i < $day; $i++) {
            $clientCount = $this->whereDate('created_at', now()->subDays($i))->count();
            if ($clientCount > 0) {
                $count[] = $clientCount;
            }
        }

        return array_reverse($count);
    }

    public function isBetterThenTomorrow(): bool
    {
        return $this->whereDate('created_at', Carbon::today())->count() > $this->whereDate('created_at', Carbon::yesterday()->subDay(1))->count();
    }
}
