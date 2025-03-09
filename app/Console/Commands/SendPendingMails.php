<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\ContactFormMail;
use App\Mail\ContactFormMailAdmin;
use Illuminate\Support\Facades\Mail;
use App\Models\ContactForm;

class SendPendingMails extends Command
{
    protected $signature = 'send:pending-mails';
    protected $description = 'Send emails for contact forms with status=1';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $contacts = ContactForm::where('status', "1")->get();

        foreach ($contacts as $contact) {
            $emailData = [
                'name' => $contact->name,
                'email' => $contact->email,
                'subject' => $contact->subject,
                'phone' => $contact->phone,
                'meeting_time' => $contact->meeting_time,
                'message' => $contact->message,
            ];

            // Send email to the user
            Mail::to($contact->email)->send(new ContactFormMail($emailData));

            // Send email to the admin
            Mail::to('iamtalha.mht@gmail.com')->send(new ContactFormMailAdmin($emailData));

            // Update status after sending email
            $contact->status = "2"; // Change status to 2 (sent)
            //$contact->update(['status' => "2"]); // Change status to 3 (sent)
            $contact->save();
        }

        $this->info('Emails sent successfully to users and admin.');
    }
}
