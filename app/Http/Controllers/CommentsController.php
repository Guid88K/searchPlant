<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends AbstractController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request, int $id)
    {
        $comment = new Comments([
            'title' => 'test',
            'user_id' => Auth::user()->id,
            'publication_id' => $id,
            'description' => $request->description
        ]);

        $comment->save();

        return redirect('/publications/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $comment = Comments::find($id);
        $comment->delete();

        return redirect()->back();
    }
}
