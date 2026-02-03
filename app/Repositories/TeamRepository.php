<?php

namespace App\Repositories;

use App\Models\Team;
use App\Services\ImageService;
use Illuminate\Support\Facades\DB;

class TeamRepository
{
    protected ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Get all teams ordered by order_no
     */
    public function all()
    {
        return Team::orderBy('order_no')->paginate(10);
    }

    /**
     * Store a new team
     */
    public function store(array $data)
    {
        if (isset($data['image'])) {
            $data['image'] = $this->imageService->store($data['image'], 'teams');
        }

        $data['status'] = $data['status'] ?? 0;

        // 👉 Set next order number automatically
        $data['order_no'] = Team::max('order_no') + 1;

        return Team::create($data);
    }

    /**
     * Find team
     */
    public function find(int $id)
    {
        return Team::findOrFail($id);
    }

    /**
     * Update team
     */
    public function update(array $data, int $id)
    {
        $team = $this->find($id);

        if (isset($data['image'])) {
            $data['image'] = $this->imageService->replace(
                $team->image,
                $data['image'],
                'teams'
            );
        }

        $data['status'] = $data['status'] ?? 0;

        $team->update($data);

        return $team;
    }

    /**
     * Delete single team
     */
    public function delete(int $id)
    {
        $team = $this->find($id);

        $this->imageService->delete($team->image);

        $team->delete();
    }

    /**
     * Bulk delete
     */
    public function bulkDestroy(array $ids)
    {
        DB::transaction(function () use ($ids) {
            $teams = Team::whereIn('id', $ids)->get();

            foreach ($teams as $team) {
                $this->imageService->delete($team->image);
            }

            Team::whereIn('id', $ids)->delete();
        });
    }

    /**
     * Toggle status
     */
    public function toggleStatus(int $id): array
    {
        $team = $this->find($id);

        $team->status = !$team->status;
        $team->save();

        return [
            'success' => true,
            'status' => $team->status
        ];
    }

    /**
     * ✅ Update order after drag & drop
     */
    public function updateOrder(array $orders): void
    {
        DB::transaction(function () use ($orders) {
            foreach ($orders as $item) {
                Team::where('id', $item['id'])
                    ->update(['order_no' => $item['position']]);
            }
        });
    }
}
