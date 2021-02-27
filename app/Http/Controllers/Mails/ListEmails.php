<?php

namespace App\Http\Controllers\Mails;

use App\Events\EmailCreated;
use App\Http\Controllers\Controller;
use App\Models\SentMails;

class ListEmails extends Controller
{
    public function __invoke()
    {
        return response()->json([
            'message' => 'All mails paginated',
            'payload' => SentMails::paginate(100),
            'success' => true
        ]);
    }
}
