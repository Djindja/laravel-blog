<?php

namespace App\Http\Controllers;

use Mail;
use Session;
use App\Post;
use Illuminate\Http\Request;

class PagesController extends Controller {

    public function getIndex() {
        $posts = Post::orderBy('created_at', 'desc')->limit(4)->get();
        return view('pages.welcome')->withPosts($posts);
    }

    public function getAbout() {
        return view('pages.about');
    }

    public function getContact() {
        return view('pages.contact');
    }

    public function postContact(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'subject' => 'min:2,'
            'message' => 'min:10'
        ]);

        $data = array(
            'email' = $request->email,
            'subject' = $request->subject,
            'bodyMessage' = $request->message
        );

        Mail::send('emails.contact', $data, function($message) use ($data){
            $message->from($data['email']);
            $mesage->to('hello@dev.com');
            $message->subject($data['subject']);
        });

        Session::flash('success', 'Your Email was Sent!');

        return redirect()->url('/');
    }
}
