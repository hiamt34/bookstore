<?php

namespace App\Http\Controllers\Transporters;

use App\Http\Controllers\Controller;
use DB;
use App\Models\Transporters;
use Illuminate\Http\Request;
class TransportersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $suppliers = Supplier::get();
        // $trendCategories = Category::where('for_books', '=', true)->withCount('books')->orderBy('books_count','desc')->take(3)->get();
        // $trendBooks = Book::orderBy('sold','desc')->take(10)->get();
        // $newBooks = Book::orderBy('created_at','desc')->take(8)->get();
        // $categories = Category::where('for_books', '=', true)->get();
        $transporters = DB::table('transporters')->get();
        return view('admin.transporters.index')
                ->with('transporters',$transporters);
    }

    public function destroy( $id)
    {
        //
        DB::table('transporters')->delete($id);
        return redirect()->back();
    }

    public function edit( $id)
    {
        //
        $transporter = DB::table('transporters')->find($id);
        return view('admin.transporters.edit')
                ->with('transporter',$transporter);
    }

    public function update(Request $request, $id)
    {
        //
        $transporter = $request->all();
        $data = [
            'name' => $transporter['name'],
            'phone' => $transporter['phone'],
            'email' => $transporter['email'],
            'description' => $transporter['description'],
            'postage' => $transporter['postage'],
        ];
        // $data['name'] = $transporter['name'];
        // var_dump($data);
        DB::table('transporters')->where('id', $id)->update($data);
        return redirect()->route('transporters_list');
    }

    public function create( )
    {
        //
        return view('admin.transporters.create');
    }

    public function store( Request $request)
    {
        //

        $transporter = $request->all();
        $data = [
            'name' => $transporter['name'],
            'phone' => $transporter['phone'],
            'email' => $transporter['email'],
            'description' => $transporter['description'],
            'postage' => $transporter['postage'],
        ];
        DB::table('transporters')->insert($data);
        return redirect()->route('transporters_list');
    }
}
