<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AddSlideRequest;
use Illuminate\Http\Request;
use App\Slide;
use App\Http\Controllers\Controller;
use Webpatser\Uuid\Uuid;
use App\Language;
use Carbon\Carbon;
class SlideControler extends Controller
{
    public function index()
    {
        if(session()->get('locale') == Language::LA) {
            $slides = Slide::select('id','image', 'name_la AS name', 'updated_at')
                ->orderBy('id', 'DESC')
                ->paginate(DEFAULT_PAGINATION_PER_PAGE);
        } else {
            $slides = Slide::select('id','image', 'name_vi AS name', 'updated_at')
                ->orderBy('id', 'DESC')
                ->paginate(DEFAULT_PAGINATION_PER_PAGE);
        }
        return view('admin.slide.index', ['slides' =>$slides]);
    }

    public function form_add()
    {
        return view('admin.slide.add');
    }

    public function add(AddSlideRequest $request)
    {
        $fileName = Uuid::generate().'.'.pathinfo($request->file('image-service')->getClientOriginalName(), PATHINFO_EXTENSION);
        $request->file('image-service')->storeAs('public/slide', $fileName);
        Slide::insert(
            [
                'name_vi' => $request->input('name_vi'),
                'sale_vi' => $request->input('desc_vi'),
                'name_la' => $request->input('name_la'),
                'sale_la' => $request->input('desc_la'),
                'image' => $fileName,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        return redirect(route('slide.index'))
            ->with('alert-success', trans('messages.successfully_created', ['name' => 'slide']));
    }

    public function image($id)
    {
        $photo = Slide::where('id', trim($id))
            ->first();

        if (empty($photo)) {
            return abort(404);
        }
        $path = storage_path().'/app/public/slide/'.$photo->image;
        echo file_get_contents($path);
        return true;

    }

}
