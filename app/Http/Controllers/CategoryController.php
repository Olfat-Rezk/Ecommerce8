<?php

namespace App\Http\Controllers;

use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function index(){

        //$categories = DB::table('categories');
         $categories = Category::latest()->paginate(5);

        // $categories = DB::table('categories')
        //             ->join('users','categories.user_id','user_id')
        //             ->select('categories.*','users.name')
        //             ->latest()->paginate(10);
        $trashed = Category::onlyTrashed()->paginate(3);

        return view('admin.category.index',compact('categories','trashed'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'category_name'=>'required|unique:categories|max:255'
        ],
    [
        'category_name.required'=>'please enter name'

    ]);
    // Category::insert([
    //     'category_name'=>$request->category_name,
    //     'user_id'=>Auth::user()->id,
    //     'created_at'=>Carbon::now()

    // ]);

    // $category = new Category;
    // $category->category_name = $request->category_name;
    // $category->user_id = Auth::user()->id;
    // $category->save();

    $data = array();
    $data['category_name']=$request->category_name;
    $data['user_id']=Auth::user()->id;
    DB::table('categories')->insert($data);

    return Redirect()->back()->with('success','category inserted successfully');

    }
    public function edit($id){
        $categories= Category::find($id);
        //$categories = DB::table('categories')->where('id',$id)->first();
        return view('admin.category.edit',compact('categories'));
    }

    public function update(Request $request,$id){
        // $categories = Category::find($id)->update([
        //     'category_name'=>$request->category_name,
        //     'user_id'=>Auth::user()->id
        // ]);
        $data= array();
        $data['category_name']= $request->category_name;
        $data['user_id']=Auth::user()->id;
        DB::table('categories')->where('id',$id)->update($data);
        return Redirect()->route('all.category')->with('success','category updated successfully');

    }

    public function softDelete($id){
        $delete = Category::find($id)->delete();
        return redirect()->back()->with('success','Category is deleted soft delete');
    }
    public function restore($id){
        $restore = Category::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success','Category is restored');


    }
    public function forceDelete($id){
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success','Category is deleted forcelly');
    }

}
