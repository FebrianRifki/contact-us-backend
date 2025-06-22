<?php

namespace App\Repositories;

use App\Models\Email;
use App\Repositories\EmailRepositoryInterface;
use App\Mail\ContactReplyMail;
use Illuminate\Support\Facades\Mail;

class EmailRepository implements EmailRepositoryInterface
{
    public function send(array $data): array
    {
        try {
            $email = Email::create([
                'first_name'    => $data['first_name'],
                'last_name'     => $data['last_name'],
                'sender_email'  => $data['sender_email'],
                'subject'       => $data['subject'],
                'message'       => $data['message'],
                'status'        => 0, 
            ]);

            return [
                'success' => true,
                'data'    => $email,
            ];
        } catch (\Throwable $th) {
            return [
                'success' => false,
                'message' => 'An error occurred while sending the email.',
                'code'    => 500,
                'data'    => null,
                'error'   => $th->getMessage(), 
            ];
        }
    }
    public function getall(): array
    {
        try {
            $emails = Email::whereNull('parent_id')->get();
            return [
                'success' => true,
                'data'    => $emails,
            ];
        } catch (\Throwable $th) {
            return [
                'success' => false,
                'data'    => [],
                'error'   => $th->getMessage(),
            ];
        }
    }

    public function getById(int $id): array
    {
        try {
            $email = Email::findOrFail($id);
            return  [
                'success' => true,
                'data'    => $email,
            ];
        } catch (\Throwable $th) {
            return [
                'success' => false,
                'data'    => null,
                'error'   => $th->getMessage(),
            ];
        }
    }

    public function update(int $id, array $data): array
    {
        try {
            $email = Email::findOrFail($id);
            $email->status = $data['status'];
            $email->save();
            return [
                'success' => true,
                'data'    => $email,
            ];
        } catch (\Throwable $th) {
            return [
                'success' => false,
                'data'    => null,
                'error'   => $th->getMessage(),
            ];
        }
    }

    public function delete(int $id): array
    {
        try {
            $email = Email::findOrFail($id);
            $email->delete();
            return [
                'success' => true,
                'data'    => null,
            ];
        } catch (\Throwable $th) {
            return [
                'success' => false,
                'data'    => null,
                'error'   => $th->getMessage(),
            ];
        }
    }

    public function reply(int $id, array $data): array
    {
        try {
           
            $senderMail = Email::findOrFail($id);

          
            $replyMessage = Email::create([
                'first_name'   => 'Admin',
                'last_name'    => 'Admin',
                'parent_id'    => $id,
                'sender_email' => $senderMail->sender_email,
                'subject'      => 'Re: ' . $senderMail->subject,
                'message'      => $data['message'],
                'status'       => 0, 
            ]);

            
            Mail::to($senderMail->sender_email)->send(new ContactReplyMail($replyMessage));

           
            $senderMail->status = 2;
            $senderMail->save();

            return [
                'success' => true,
                'data'    => $replyMessage,
            ];

        } catch (\Throwable $th) {
            return [
                'success' => false,
                'data'    => null,
                'error'   => $th->getMessage(),
            ];
        }
    }

    public function getReplyMessage(int $id): array
    {
        try {
            $emails = Email::where('parent_id', $id)->get();
            return [
                'success' => true,
                'data'    => $emails,
            ];
        } catch (\Throwable $th) {
            return [
                'success' => false,
                'data'    => null,
                'error'   => $th->getMessage(),
            ];
        }
    }

}
