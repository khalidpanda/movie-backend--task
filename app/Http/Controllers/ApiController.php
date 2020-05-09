<?php

namespace App\Http\Controllers;

use App\Api;
use Illuminate\Http\Request;
use \GuzzleHttp\Client;
use Illuminate\Support\Facades\Input;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $movies = Api::all();
        return view('home')->with('movies', $movies);
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    //storing api data using postman
    public function store(Request $request)
    {
        $data = new Api();
    $data->title = $request->input('original_title');
    $data->description = $request->input('overview');
    $data->filename = $request->input('poster_path');
    $data->link = $request->input('homepage');
    $data->save();

       return response()->json($data);
          
    }


//testing the tmdb api
public function handle(Request $request)
{
 
    $client = new Client();
    $res = $client->request('GET','https://api.themoviedb.org/3/movie/550?api_key=4c8fa5e2d77afbfe2035bcda11b407b2');
    $jsonArray = json_decode($res->getBody()->getContents(), true);


    dd($jsonArray);

    
}

//Requirement: 4 json query for user
public function jsonQuuery(Request $request)
{

      $q = Input::get ( 'q' );
    $movie = Api::where('title','LIKE','%'.$q.'%')->orWhere('filename','LIKE','%'.$q.'%')->orWhere('description','LIKE','%'.$q.'%')->orWhere('link','LIKE','%'.$q.'%')->get()->toJson(JSON_PRETTY_PRINT);
   
    return response(dd($movie, 200));
}  

//api for this application only movie db

public function taskAPI(Request $request)

{
     $movie = Api::get()->toJson(JSON_PRETTY_PRINT);
   
    return response($movie, 200);
}

}