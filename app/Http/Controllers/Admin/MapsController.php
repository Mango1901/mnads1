<?php

namespace App\Http\Controllers\Admin;

use App\Repository\MapRepository;
use Illuminate\Http\Request;
use App\Maps;
use Illuminate\Support\Facades\Auth;
use App\Validations\Validation;
class MapsController extends Controller
{
    protected $_MapsRepository;

    public function __construct(MapRepository $mapRepository)
    {
        $this->_MapsRepository = $mapRepository;
    }
    public function index()
    {
        $user_id=Auth::id();
       $getMaps = $this->_MapsRepository->getMapByUserId($user_id);
       return view('maps.index', compact("getMaps"));
    }

    public function create() {

        return view('maps.create');
    }

    public function store( Request $request)
    {
        $requestData = $request->all();
         $validator=Validation::validatemapRequest($request);
         if($validator->fails()){
             return redirect('maps/create')
                 ->withErrors($validator)
                 ->withInput();
         }
        $user_id=Auth::id();
        if (Auth()->user()->can('create', Maps::class)) {
            $check_maps_name = $this->_MapsRepository->CheckMapName($user_id,$requestData['map']);
            if($check_maps_name){
                return redirect('maps/index')->with('error','this maps had already been used');
            }
            $this->_MapsRepository->CreateMap($user_id,$requestData['map'],$requestData['map_title']);
            return redirect('maps/index')->with('message','Add Maps successfully');
        } else {
            return redirect('maps/index')->with("error", "your account did not have permission to add more maps");
        }
    }

    public function edit(Request $request, $id) {

        $editMaps = $this->_MapsRepository->getMapById($id);

        return view('maps.update',compact('editMaps'));
    }


    public function update(Request $request){

        $requestData = $request->all();
        $validator=Validation::validatemapUpdateRequest($request);
        if($validator->fails()){
            return redirect('maps/edit'.$requestData['id'])
                ->withErrors($validator)
                ->withInput();
        }
        $check_maps_name = $this->_MapsRepository->CheckMapsNameUpdate(Auth::user()->id,$requestData['id'],$requestData['map']);
        if($check_maps_name){
            return redirect('maps/index')->with('error','This maps had already been used');
        }else{
            $this->_MapsRepository->MapsUpdate($requestData['id'],$requestData['map'],$requestData['map_title']);
        }
         return redirect('maps/index')->with('message','Update Maps successfully');
    }


    public function delete(Request $request, $id){
      $this->_MapsRepository->DeleteMaps($id);

      return redirect('maps/index')->with('message','Delete maps successfully');
    }

































//    public $data;
//    private $perPage;
//    private $model;
//
//    public function __construct()
//    {
//        $this->perPage  = config('admin.per_page');
//        $this->model    = new Maps();
//        //
//        $this->data['controller'] = __CLASS__;
//    }
//
//
//    public function index()
//    {
//        $user_id=Auth::id();
//       $this->data['data'] = $this->model->where('user_id',$user_id)->where('status',0)->get();
//       return view('maps.index', $this->data);
//    }
//
//    public function create() {
//
//        return view('maps.create');
//    }
//
//
//
//    public function store( Request $request)
//    {
//        $requestData = $request->all();
////         $validator=Validation::validatemapRequest($request);
////         if($validator->fails()){
////             return redirect('maps/create')
////                 ->withErrors($validator)
////                 ->withInput();
////         }
//        $user_id=Auth::id();
//        if (Auth()->user()->can('create', Maps::class)) {
//            $check_maps_name = Maps::where('user_id',$user_id)->where('map',$requestData['map'])->first();
//            if($check_maps_name){
//                return redirect('maps/index')->with('error','this maps had already been used');
//            }
//            $this->model->insert(
//                array('user_id'=>$user_id,'map'=>$requestData['map'])
//            );
//            return redirect('maps/index')->with('message','Add Maps successfully');
//        } else {
//            return redirect('maps/index')->with("error", "your account did not have permission to add more maps");
//        }
//    }
//
//    public function edit(Request $request, $id) {
//
//        $this->data['data'] = $this->model->where('id',$id)->where('status',0)->first();
//
//        return view('maps.update',$this->data);
//    }
//
//
//    public function update(Request $request){
//
//        $requestData = $request->all();
//
//        $check_maps_name = Maps::where('user_id',Auth::user()->id)->where('map',$requestData['map'])->whereNotIn('id',[$requestData['id']])->first();
//        if($check_maps_name){
//            return redirect('maps/index')->with('error','This maps had already been used');
//        }else{
//            $this->model->where('id',$requestData['id'])->update(
//                array('map'=>$requestData['map']
//            ));
//        }
//         return redirect('maps/index')->with('message','Update Maps successfully');
//    }
//
//
//    public function delete(Request $request, $id){
//      $this->model->where('id', $id)->update(['status'=>1]);
//
//      return redirect('maps/index')->with('message','Delete maps successfully');
//    }

}
