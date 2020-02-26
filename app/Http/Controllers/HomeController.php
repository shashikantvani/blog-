<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Image;
use Session;
use App\User;
use App\Role;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users= DB::table('users')->where('user_role','!=',1)->count('*');

        $posts= DB::table('posts')->count('*');
     
        return view('home',['user_count'=>$users,'post_count'=>$posts]);
    }

    public function users(){

       $users=User::where('user_role','!=',1)->get();

       return view('users',['users'=>$users]);


    }

    public function roles()
    {
      
        return view('roles');
    }

    public function getpermission($id){
      
        $menus=Role::where('status',1)->get();

        foreach($menus as $menu){
           $permission= DB::table('menu_permission')->where('menu_id',$menu->id)->where('role_id',$id)->where('status',1)->first();

           if(!empty($permission)){
            $menu->permission=1;

           }else{
            $menu->permission=0;
           }

        }


         echo '{"status":1,"data":'.json_encode($menus).'}';
      //  return response()->json(['status' => true, 'data' => $menus]);
        exit;

    }


    function addPermission(Request $request){

       $permission=$request->input('permissions');
        $role_id=$request->input('role_id');

        if(!empty($permission)){

        

        DB::table('menu_permission')->where('role_id',$role_id)->update(['status'=>0]);
       
       foreach ($permission as  $value) {

          $check= DB::table('menu_permission')->where('menu_id',$value)->where('role_id',$role_id)->first();

          if(!empty($check)){

            DB::table('menu_permission')->where('menu_id',$value)->where('role_id',$role_id)->update(['status'=>1]);

          }else{

             DB::table('menu_permission')->insert(['menu_id'=>$value,'role_id'=>$role_id,'status'=>1]);

          }

       }
       
          return back()
            ->with('success','You have successfully Save Permission.');
      // return redirect('roles');
          }else{
              return back()
            ->with('success','Please Select At least one ');
          }  

    }


    public function addposts(){
        return view('addposts');
    }

    public function createpost(Request $request){

      
         $title=$request->title;
         $description=$request->description;
         $image=$request->file('image');
         $thumb= $request->file('image'); 

         $slug= explode(' ',$title);

         $slug = implode('-',$slug);


         if($request->id==0 || $request->id==''){


         
      


         $request->validate([
            'title' => 'required',
            'description'=>'required'
        ]);
      // echo  $img = Image::make($request->file('image')->getRealPath()); exit;
        $fileName='';
       if(!empty($image)){
     
       $fileName = time().'.'.$image->extension(); 
        $image->move(public_path('uploads'), $fileName);
     
       // echo  $this->resize_crop_image(100, 100,$thumb, $fileName);
    

      //  $image->move(public_path('uploads/thumbnail'), $fileName);
      // // echo $img; 
      //  exit;
       }

       $id= DB::table('posts')->insertGetId(['user_id'=>Auth::user()->id,'title'=>$title,'slug'=>'','description'=>$description,'featured_image'=>$fileName,'thumbnail'=>$fileName]);
      
      if($id!=0){
           DB::table('posts')->where('id',$id)->update(['slug'=>$slug.'-'.$id]);
      }
   
        return back()
            ->with('success','You have successfully save post.');

         }else{

      $post=DB::table('posts')->where('id','=',$request->id)->first();


       $fileName=$post->featured_image;
       if(!empty($image)){
     
       $fileName = time().'.'.$image->extension(); 
        $image->move(public_path('uploads'), $fileName);

         }

       $id= DB::table('posts')->where('id',$request->id)->update(['title'=>$title,'slug'=>$slug.'-'.$request->id,'description'=>$description,'featured_image'=>$fileName,'thumbnail'=>$fileName]);
      
        return back()
            ->with('success','You have successfully Update Post.');

         }   
    }


    public function post($id){
      
       $post=DB::table('posts')->where('slug','=',$id)->first();

       return view('postdetail',['post'=>$post]);

    }

      public function editpost($id){
      
       $post=DB::table('posts')->where('slug','=',$id)->first();

       return view('editpost',['post'=>$post]);

    }



    public function posts(){

        $posts= DB::table('posts')->where('delete','=',0)->where('status',1)->paginate(6);

        return view('posts',['posts'=>$posts]);
    }


    public function delete($id){

          DB::table('posts')->where('slug','=',$id)->update(['delete'=>1]);

            return back()
            ->with('success','Post Deleted Successfully');

    }


    function resize_crop_image($max_width, $max_height, $source_file, $dst_dir, $quality = 80){
    $imgsize = getimagesize($source_file);
    $width = $imgsize[0];
    $height = $imgsize[1];
    $mime = $imgsize['mime'];

    switch($mime){
        case 'image/gif':
            $image_create = "imagecreatefromgif";
            $image = "imagegif";
            break;

        case 'image/png':
            $image_create = "imagecreatefrompng";
            $image = "imagepng";
            $quality = 7;
            break;

        case 'image/jpeg':
            $image_create = "imagecreatefromjpeg";
            $image = "imagejpeg";
            $quality = 80;
            break;

        default:
            return false;
            break;
    }

    $dst_img = imagecreatetruecolor($max_width, $max_height);
    $src_img = $image_create($source_file);

    $width_new = $height * $max_width / $max_height;
    $height_new = $width * $max_height / $max_width;
    //if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
    if($width_new > $width){
        //cut point by height
        $h_point = (($height - $height_new) / 2);
        //copy image
        imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
    }else{
        //cut point by width
        $w_point = (($width - $width_new) / 2);
        imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
    }

    $image($dst_img, $dst_dir, $quality);
    
    if($dst_img)imagedestroy($dst_img);
    if($src_img)imagedestroy($src_img);


}
//usage example

}
