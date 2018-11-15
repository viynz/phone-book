<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use App\Contacts;
use App\User;
use DB;
use Auth;
use App\Http\Requests\updateContactForm;

class ContactsController extends Controller
{
      protected function addcontacts( Request $request )
        {
          

          $validator = Validator::make($request->all(),[
            
            'firstname' => 'required|string|max:255|regex:/^[(a-zA-Z\s)]+$/u',
            'lastname' => 'required|string|max:255|regex:/^[(a-zA-Z\s)]+$/u',
            'middlename' => 'nullable|string|max:1|regex:/^[(a-zA-Z\s)]+$/u',
            'phonenumber' => 'required|string|min:11|unique:contacts',
            'email' => 'required|email|string|max:255|unique:contacts',
        ]);
        


        if ($validator->passes()) 
        {

            $contact = new Contacts();

            $contact->phonenumber = $request->phonenumber;
            $contact->firstname = $request->firstname;
            $contact->lastname = $request->lastname;
            $contact->middlename = $request->middlename;
            $contact->email = $request->email;
            $contact->save();



            $contacts = Contacts::all();
            $success = "CONTACT SUCCESSFULY ADDED.";
            $content = view('home')->with(compact('person'))->render();
            return response()->json(['content'=> $content, 'success'=> $success]);

        }
        else
	        {
                $contacts = Contacts::all();
	           return back()->with(compact( 'pages.contacts' ))->withErrors( $validator->messages())->withInput();
	        }




        }  


    public function getcontacts()
    {
        $contacts = Contacts::all();
        return view('pages.contacts',compact( 'contacts' ));
    }


     public function deleteContact()
    {
        $person = Contacts::where( 'id' , request()->id )->first();
        $person->delete();

        $person = Contacts::all();
        return redirect('/contacts')->with("message","$person->firstname $person->lastname is now Disabled");
    }






        protected function UpdateContact( Request $request)
        {
          
          $id = $request->id;

          $validator = Validator::make($request->all(),[

            
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'phonenumber' => 'required|string|min:11|unique:contacts,phonenumber,' . $id,
            'email' => 'required|email|string|max:255|unique:users,email,' . $id,

        ]);
        


        if ($validator->passes()) 
        {

             $contact = Contacts::where('id', $id)->first();

            $contact->firstname = $request->firstname;
            $contact->lastname = $request->lastname;
            $contact->middlename = $request->middlename;
            $contact->username = $request->username;
            $contact->email = $request->email;
            $contact->update();


        $contact = Contacts::all();

        return back()->with('message', 'SUCCESSFULY UPDATED USER.')->with(compact( 'contacts' ));

        }
        else
        {
            $contact = Contacts::all();
            return back()->with(compact( 'contacts' ))->withErrors( $validator->messages())->withInput();
        }



        } 










        
}


 
