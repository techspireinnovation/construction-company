<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\HeroSection\HeroSectionRequest;
use App\Repositories\Interfaces\HeroSectionRepositoryInterface;

class HeroSectionController extends Controller
{
    protected HeroSectionRepositoryInterface $repository;

    public function __construct(HeroSectionRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $hero = $this->repository->get();

        return view('admin.hero-sections.index', compact('hero'));
    }

    public function create()
    {
        if ($this->repository->get()) {
            return redirect()->route('admin.hero-sections.edit');
        }

        return view('admin.hero-sections.create');
    }

   
    // In your Controller (HeroSectionController.php)
    public function store(HeroSectionRequest $request)
    {
        try {

            $data = $request->validated();

            // Ensure hero_with_video data structure is correct
            if ($data['type'] == 2) {
                $data['hero_with_video'] = [
                    'title' => $request->input('hero_with_video.title'),
                    'content' => $request->input('hero_with_video.content'),
                    'embed' => $request->input('hero_with_video.embed')
                ];
            }

            $heroSection = $this->repository->storeOrUpdate($data);

            return redirect()
                ->route('admin.hero-sections.index')
                ->with('success', 'Hero section saved successfully.');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Error saving hero section: ' . $e->getMessage());
        }
    }

    public function edit()
    {
        $hero = $this->repository->get();

        if (!$hero) {
            return redirect()->route('admin.hero-sections.create');
        }

        return view('admin.hero-sections.edit', compact('hero'));
    }

    public function update(HeroSectionRequest $request)
    {
        try {
            $data = $request->validated();

            // Ensure hero_with_video data structure is correct
            if ($data['type'] == 2) {
                $data['hero_with_video'] = [
                    'title' => $request->input('hero_with_video.title'),
                    'content' => $request->input('hero_with_video.content'),
                    'embed' => $request->input('hero_with_video.embed')
                ];
            }

            $this->repository->storeOrUpdate($data);

            return redirect()
                ->route('admin.hero-sections.index')
                ->with('success', 'Hero section updated successfully.');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Error updating hero section: ' . $e->getMessage());
        }
    }
}