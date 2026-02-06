<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\About\AboutRequest;
use App\Repositories\Interfaces\AboutRepositoryInterface;

class AboutController extends Controller
{
    protected AboutRepositoryInterface $repository;

    public function __construct(AboutRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $about = $this->repository->get();
        return view('admin.abouts.index', compact('about'));
    }

    public function create()
    {
        if ($this->repository->get()) {
            return redirect()->route('admin.abouts.edit');
        }

        return view('admin.abouts.create');
    }

    public function store(AboutRequest $request)
    {
        try {
            $data = $request->validated();

            $about = $this->repository->storeOrUpdate($data);

            return redirect()
                ->route('admin.abouts.index')
                ->with('success', 'About section saved successfully.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Error saving About section: ' . $e->getMessage());
        }
    }

    public function edit()
    {
        $about = $this->repository->get();

        if (!$about) {
            return redirect()->route('admin.abouts.create');
        }

        return view('admin.abouts.edit', compact('about'));
    }

    public function update(AboutRequest $request)
    {
        try {
            $data = $request->validated();

            $this->repository->storeOrUpdate($data);

            return redirect()
                ->route('admin.abouts.index')
                ->with('success', 'About section updated successfully.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Error updating About section: ' . $e->getMessage());
        }
    }
}
