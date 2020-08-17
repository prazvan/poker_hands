<?php

namespace App\Repositories\Eloquent;

use App\Models\GameReport;
use Illuminate\Support\Collection;

/**
 * Class HandRepository
 * @package App\Repositories\Eloquent
 */
class GameReportRepository extends EloquentRepository
{
    /**
     * Create new Report and return id
     *
     * @return int
     */
    public function create(): int
    {
        // create empty report and assign it to the current user.
        return (GameReport::create([
            'user_id' => auth()->user()->id
        ]))->id;
    }

    /**
     * Get Report By Id
     *
     * @param $id
     *
     * @return GameReport|null
     */
    public function getById($id): ?GameReport
    {
        return $this->cacheQuery('report' . $id, function() use ($id)
        {
            return GameReport::findOrFail($id);
        });
    }

    public function all($user_id): Collection
    {
        return GameReport::where(['user_id' => $user_id])->orderBy('created_at', 'desc')->get();
    }

    /**
     * Update Report
     *
     * @param $report_id
     * @param $payload
     * @return bool
     */
    public function updateReport($report_id, $payload): bool
    {
        $GameReport = self::getById($report_id);

        if ($GameReport)
        {
            foreach ($payload as $key => $value)
            {
                $GameReport->setAttribute($key, $value);
            }
        }

        return $GameReport->update();
    }
}