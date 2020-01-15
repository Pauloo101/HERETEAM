<?php

namespace App\Http\Controllers\Utility;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'matric_no' => ['required', 'unique:students'],
            'surname' => 'required',
            'first_name' => 'required',
            'gender' => 'required',
            'classroom_id' => 'required',
            'section_id' => 'required',
            'dob' => 'required',
            'father_name' => 'required',
            'email' => 'required',
            'father_occupation' => 'required',
            'father_phone' => 'required',
            'mother_name' => 'required',

            'mother_occupation' => 'required',
            'mother_phone' => 'required',
            'guardian_name' => 'required',
            'guardian_email' => 'required',
            'guardian_occupation' => 'required',
            'guardian_phone' => 'required',
            'relationship' => 'required',
            'guardian_address' => 'required',
            'tickek' => 'required'
        ]);

        //check ticket
        $check = Ticket::where('key', $request->ticket)->get();
        // return count($check);
        if (count($check) == 1) {
            if ($check[0]['used'] == 1) {
                return response('Ticket has already been used', 422);
                // return 'ticket is already used ';
            } else {
                //save student
                $password = Hash::make($request->surname);
                $settings = Setting::select()->where('Is_Active', 1)->first();
                // dd($settings->session_id);
                // dd($request);
                $checkparent = Parents::where('father_phone', $request->father_phone)->orwhere('mother_phone', $request->mother_phone)->pluck('id');
                // dd($checkparent);
                if (count($checkparent) == 0) {
                    $this->parent = new Parents;
                    $this->parent->name = $request->surname;
                    $this->parent->father_name = $request->father_name;
                    $this->parent->email = $request->email;
                    $this->parent->father_occupation = $request->father_occupation;
                    $this->parent->father_phone = $request->father_phone;
                    $this->parent->mother_name = $request->mother_name;
                    $this->parent->password = $password;
                    // $this->parent->mother_email = $request->mother_email;
                    $this->parent->mother_occupation = $request->mother_occupation;
                    $this->parent->mother_phone = $request->mother_phone;
                    $this->parent->is_guardian = $request->relationship;
                    $this->parent->save();
                    $this->parent = $this->parent->id;
                    // dd($parent);
                    $guardian = new Guardian;
                    $guardian->name = $request->guardian_name;
                    $guardian->phone = $request->guardian_phone;
                    $guardian->email = $request->guardian_email;
                    $guardian->occupation = $request->guardian_occupation;
                    $guardian->address = $request->guardian_address;
                    $guardian->relationship = $request->relationship;
                    $guardian->guardian_is = $request->relationship;
                    $guardian->save();
                    echo ('if');
                } else {
                    $this->parent = $checkparent[0];
                    echo ('else');
                }
                // dd($this->parent[0]);
                $student = new Student;
                $student->parent_id = $this->parent;
                $student->matric_no = $request->matric_no;
                $student->first_name = $request->first_name;
                $student->surname = $request->surname;
                $student->gender = $request->gender;
                $student->DOB = $request->dob;
                $student->save();
                $student_session = new Student_Session;
                $student_session->session_id = $settings->session_id;
                $student_session->term_id = $settings->term_id;
                $student_session->student_id = $student->id;
                $student_session->classroom_id = $request->classroom_id;
                $student_session->section_id = $request->section_id;
                $student_session->student_name = $request->surname . ' ' . $request->first_name;
                $student_session->save();



                $ticket = Ticket::find($check[0]['id']);
                $ticket->used = 1;
                $ticket->save();
                return 'done';
            }
        } else {
            return 'invalid ticket';
        }
    }
}
