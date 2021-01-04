<?php

namespace App\Http\Controllers\Admin;

use App\Repository\ContactRepository;
use Illuminate\Http\Request;
use App\Contact;
use Illuminate\Support\Facades\Auth;
use App\Validations\Validation;
class ContactController extends Controller
{
    protected $_ContactRepository;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->_ContactRepository = $contactRepository;
    }
        public function index()
    {
        $user_id=Auth::id();
       $getContact = $this->_ContactRepository->GetContactByUserId($user_id);
       return view('contact.index', compact('getContact'));
    }

    public function create() {

        return view('contact.create');
    }
    //create
    public function store( Request $request)
    {
        $requestData = $request->all();
        $validator = Validation::validatecontactRequest($request);
        if ($validator->fails()) {
            return redirect('contact/create')
                ->withErrors($validator)
                ->withInput();
        }
        $user_id=Auth::id();
        if (Auth()->user()->can('create', Contact::class)) {
            $check_contact_phone_number = $this->_ContactRepository->CheckContactPhoneNumberExist(Auth::user()->id,$requestData['number']);
            if($check_contact_phone_number){
                return redirect('contact/index')->with('error','this phone had already been used');
            }
            $this->_ContactRepository->CreateContact($user_id,$requestData['title'],$requestData['number'],$requestData['description']);
            return redirect('contact/index')->with('message', 'Add Contact successfully');
        } else {
            return redirect('contact/index')->with("error", "your account did not have permission to add more contacts");
        }
    }

    public function edit(Request $request, $id) {

       $editContact = $this->_ContactRepository->getContactById($id);

        return view('contact.update',compact("editContact"));
    }

    //update
    public function update(Request $request){

        $requestData = $request->all();
        $validator = Validation::validatecontactUpdateRequest($request);
        if ($validator->fails()) {
            return redirect('contact/edit/'.$requestData['id'])
                ->withErrors($validator)
                ->withInput();
        }
        $check_contact_phone_number = $this->_ContactRepository->CheckContactPhoneNumberUpdateExist(Auth::user()->id,$requestData['number'],$requestData['id']);
        if($check_contact_phone_number){
            return redirect('contact/index')->with('error','This phone number had already been used');
        }else{
            $this->_ContactRepository->UpdateContact($requestData['id'],$requestData['title'],$requestData['number'],$requestData['description']);
        }
         return redirect('contact/index')->with('message','Update Contact successfully');
    }
    //delete
    public function delete(Request $request, $id){
      $this->_ContactRepository->DeleteContact($id);

      return redirect('contact/index')->with('message','Delete Contact successfully');
    }



































    //    public $data;
//    private $perPage;
//    private $model;
//
//    public function __construct()
//    {
//        $this->perPage  = config('admin.per_page');
//        $this->model    = new Contact();
//        $this->data['controller'] = __CLASS__;
//    }
//
//
//    public function index()
//    {
//        $user_id=Auth::id();
//       $this->data['data'] = $this->model->where('user_id',$user_id)->where('status',0)->get();
//       return view('contact.index', $this->data);
//    }
//
//    public function create() {
//
//        return view('contact.create');
//    }
//    //create
//    public function store( Request $request)
//    {
//        $requestData = $request->all();
//        $validator = Validation::validatecontactRequest($request);
//        if ($validator->fails()) {
//            return redirect('contact/create')
//                ->withErrors($validator)
//                ->withInput();
//        }
//        $user_id=Auth::id();
//        if (Auth()->user()->can('create', Contact::class)) {
//            $check_contact_phone_number = Contact::where('user_id',Auth::user()->id)->where('number',$requestData['number'])->first();
//            if($check_contact_phone_number){
//                return redirect('contact/index')->with('error','this phone had already been used');
//            }
//            $this->model->insert(
//                array('user_id'=>$user_id,'title'=>$requestData['title'], 'number'=>$requestData['number'],'description'=>$requestData['description'])
//            );
//            return redirect('contact/index')->with('message', 'Add Contact successfully');
//        } else {
//            return redirect('contact/index')->with("error", "your account did not have permission to add more contacts");
//        }
//    }
//
//    public function edit(Request $request, $id) {
//
//        $this->data['data'] = $this->model->where('id',$id)->where('status',0)->first();
//
//        return view('contact.update',$this->data);
//    }
//
//    //update
//    public function update(Request $request){
//
//        $requestData = $request->all();
//        $validator = Validation::validatecontactUpdateRequest($request);
//        if ($validator->fails()) {
//            return redirect('contact/edit/'.$requestData['id'])
//                ->withErrors($validator)
//                ->withInput();
//        }
//        $check_contact_phone_number = Contact::where('user_id',Auth::user()->id)->where('number',$requestData['number'])->whereNotIn('id',[$requestData['id']])->first();
//        if($check_contact_phone_number){
//            return redirect('contact/index')->with('error','This phone number had already been used');
//        }else{
//            $this->model->where('id',$requestData['id'])->update(
//                array('title'=>$requestData['title'],'number'=>$requestData['number'], 'description'=>$requestData['description']
//            ));
//        }
//         return redirect('contact/index')->with('message','Update Contact successfully');
//    }
//    //delete
//    public function delete(Request $request, $id){
//      $this->model->where('id', $id)->update(['status'=>1]);
//
//      return redirect('contact/index')->with('message','Delete Contact successfully');
//    }
}
