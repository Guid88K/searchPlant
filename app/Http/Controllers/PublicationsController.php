<?php

namespace App\Http\Controllers;

use App\Http\Service\ImageMover;
use App\Models\Categories;
use App\Models\Comments;
use App\Models\Publication_about_animal;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class PublicationsController extends AbstractController
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $publications = Publication_about_animal::all();
        return view('index', [
            'publications' => $publications
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Application|Redirector|RedirectResponse
     */
    public function store(Request $request): Redirector|RedirectResponse|Application
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'date' => 'required',
            'address' => 'required',
            'image' => 'required',
        ]);


        $publication = new Publication_about_animal([
            'user_id' => Auth::user()->id,
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'date' => $request->get('date'),
            'address' => $request->get('address'),
            'category_id' => $request->get('category_id'),
            'image' => ImageMover::moveImage($request->file('image')),
        ]);

        $publication->save();
        return redirect('/admin');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(int $id)
    {
        $publication = Publication_about_animal::find($id);
        $comments = Comments::where('publication_id', $id)->get();

        return view('show', [
            'publication' => $publication,
            'comments' => $comments,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(int $id)
    {
        $publication = Publication_about_animal::find($id);

        return view('edit', [
            'publication' => $publication
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Application|Redirector|RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        $publication = Publication_about_animal::find($id);

        $publication->user_id = Auth::user()->id;
        $publication->title = $request->get('title');
        $publication->description = $request->get('description');
        $publication->date = $request->get('date');
        $publication->address = $request->get('address');
        $publication->category_id = $request->get('category_id');
        '1' !== $request->get('result') ?: $publication->result = $request->get('result');
        null === $request->file('image') ?: $publication->image = ImageMover::moveImage($request->file('image'));

        $publication->update();

        return redirect('/admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(int $id): Redirector|RedirectResponse|Application
    {
        $publication = Publication_about_animal::find($id);
        $publication->delete();
        return redirect('/admin');
    }

    /**
     * Get publication by category
     *
     * @param int $id
     * @return Application|Redirector|RedirectResponse
     */
    public function getByCategory(int $id)
    {
        $publications = Publication_about_animal::where(function ($query) use ($id) {
            $query->where('category_id', '=', $id);
        })->get();

        return view('index', [
            'publications' => $publications
        ]);
    }
}
