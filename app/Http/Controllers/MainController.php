<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MainController extends Controller
{
    public function index()
    {
        // load user's notes
        $id = session('user.id');
        $notes = User::find($id)->notes()->get()->toArray();

        return view('home', ['notes' => $notes]);
    }

    public function newNote()
    {
        echo "I'm creating a new notes";
    }

    public function editNote(string $id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $error) {
            return redirect()->route('home');
        }

        echo "I'm editing note with id = $id";
    }

    public function deleteNote(string $id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $error) {
            return redirect()->route('home');
        }

        echo "I'm deleting note with id = $id";
    }
}
