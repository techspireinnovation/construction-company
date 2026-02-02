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

    public function all()
    {
        return Team::latest()->paginate(10);
    }

    public function store(array $data)
    {
        if (isset($data['image'])) {
            $data['image'] = $this->imageService->store($data['image'], 'teams');
        }

        $data['status'] = $data['status'] ?? 0;

        return Team::create($data);
    }

    public function find(int $id)
    {
        return Team::findOrFail($id);
    }

    public function update(array $data, int $id)
    {
        $team = $this->find($id);

        if (isset($data['image'])) {
            $data['image'] = $this->imageService->replace($team->image, $data['image'], 'teams');
        }

        $data['status'] = $data['status'] ?? 0;

        $team->update($data);

        return $team;
    }

    public function delete(int $id)
    {
        $team = $this->find($id);

        $this->imageService->delete($team->image);

        $team->delete();
    }

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

    public function toggleStatus(int $id): array
    {
        $team = $this->find($id);

        $team->status = !$team->status;
        $team->save();

        return ['success' => true, 'status' => $team->status];
    }
}
