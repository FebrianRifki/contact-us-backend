<?php

namespace App\Http\Controllers;

use App\Repositories\EmailRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Mail\ContactReplyMail;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    protected $emailRepository;

    public function __construct(EmailRepositoryInterface $emailRepository)
    {
        $this->emailRepository = $emailRepository;
    }

    public function sendEmail(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'first_name'    => 'required|string|max:255',
                'last_name'     => 'required|string|max:255',
                'sender_email'  => 'required|email|max:255',
                'subject'       => 'required|string|max:255',
                'message'       => 'required|string|max:1000',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success'     => false,
                    'message'     => 'Request body is invalid',
                    'status_code' => 400,
                    'errors'      => $validator->errors(),
                ], 400);
            }

            $data = $this->emailRepository->send($request->all());

            if ($data['success']) {
                return response()->json([
                    'success' => true,
                    'message' => 'Email sent successfully',
                    'data'    => $data['data'],
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to send email',
                'data'    => $data['error'] ?? null,
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Internal server error',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function getAllEmails()
    {
        try {
            $data = $this->emailRepository->getAll();

            return response()->json([
                'success'     => true,
                'message'     => 'Emails retrieved successfully',
                'status_code' => 200,
                'data'        => $data['data'],
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success'     => false,
                'message'     => 'Internal server error',
                'status_code' => 500,
                'data'        => [],
            ], 500);
        }
    }

    public function getEmailById($id)
    {
        try {
            $data = $this->emailRepository->getById($id);

            if ($data) {
                return response()->json([
                    'success'     => true,
                    'message'     => 'Email retrieved successfully',
                    'status_code' => 200,
                    'data'        => $data['data'],
                ], 200);
            }

            return response()->json([
                'success'     => false,
                'message'     => 'Email not found',
                'status_code' => 404,
                'data'        => [],
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'success'     => false,
                'message'     => 'Internal server error',
                'status_code' => 500,
                'data'        => [],
            ], 500);
        }
    }

    public function updateEmailStatus(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'status' => 'required|integer|in:0,1',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid status value',
                    'errors'  => $validator->errors(),
                ], 400); 
            }
            

            $data = $this->emailRepository->update($id, [
                'status' => $request->status
            ]);

            if ($data['success']) {
                return response()->json([
                    'success' => true,
                    'message' => 'Email status updated successfully',
                    'status_code' => 200,
                    'data'    => $data['data'],
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => 'Email not found',
                'data'    => [],
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Internal server error',
                'error'   => $e->getMessage(), 
            ], 500);
        }
    }


    public function reply(Request $request, $id){
        try {
             $validator = Validator::make($request->all(), [
                'message' => 'required|string|max:1000',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors'  => $validator->errors(),
                ], 400);
            }


            $data = $this->emailRepository->reply($id, $request->all());

             if ($data['success']) {
                return response()->json([
                    'success' => true,
                    'message' => 'Email Sent!',
                    'status_code' => 200,
                    'data'    => $data['data'],
                ], 200);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Internal server error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    function getReplyMessage($id)
    {
        try {
        $data = $this->emailRepository->getReplyMessage($id);

        if ($data['success']) {
            return response()->json([
                'success'     => true,
                'message'     => 'Reply message retrieved successfully',
                'status_code' => 200,
                'data'        => $data['data'],
            ], 200);
        }

        return response()->json([
            'success'     => false,
            'message'     => 'Reply message not found',
            'status_code' => 404,
            'data'        => [],
        ], 404);
        } catch (\Throwable $th) {
            return response()->json([
                'success'     => false,
                'message'     => 'Internal server error',
                'status_code' => 500,
                'data'        => [],
            ], 500);
        }
    }


    public function deleteEmail($id)
    {
        try {
            $data = $this->emailRepository->delete($id);

            if ($data['success']) {
                return response()->json([
                    'success'     => true,
                    'message'     => 'Email deleted successfully',
                    'status_code' => 200,
                    'data'        => [],
                ], 200);
            }

            return response()->json([
                'success'     => false,
                'message'     => 'Email not found',
                'status_code' => 404,
                'data'        => [],
            ], 404);

        } catch (\Throwable $th) {
            return response()->json([
                'success'     => false,
                'message'     => 'Internal server error',
                'status_code' => 500,
                'data'        => [],
            ], 500);
        }
    }
}
