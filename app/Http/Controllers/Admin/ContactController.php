<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Contact;
use Illuminate\Support\Facades\Auth;
use App\Validations\Validation;
class ContactController extends Controller
{
    public $data;
    private $perPage;
    private $model;

    public function __construct()
    {
        $this->perPage  = config('admin.per_page');
        $this->model    = new Contact();
        $this->data['controller'] = __CLASS__;
    }


    public function index()
    {
        $user_id=Auth::id();
       $this->data['data'] = $this->model->where('user_id',$user_id)->get();
       return view('contact.index', $this->data);
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
            return redirect('Contact/create')
                ->withErrors($validator)
                ->withInput();
        }
        $user_id=Auth::id();
        $this->model->insert(
            array('user_id'=>$user_id,'title'=>$requestData['title'], 'number'=>$requestData['number'],'description'=>$requestData['description'])
        );
       return redirect('contact/index');
    }

    public function edit(Request $request, $id) {

        $this->data['data'] = $this->model->where('id',$id)->first();

        return view('contact.update',$this->data);
    }

    //update
    public function update(Request $request){

        $requestData = $request->all();

        $this->model->where('id',$requestData['id'])->update(
            array('title'=>$requestData['title'],'number'=>$requestData['number'], 'description'=>$requestData['description']
        ));
         return redirect('contact/index');
    }
    //delete
    public function delete(Request $request, $id){
      $this->model->where('id', $id)->delete();

      return redirect('contact/index');
    }


}
