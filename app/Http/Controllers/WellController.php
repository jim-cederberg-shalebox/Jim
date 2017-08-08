<?php

namespace App\Http\Controllers;

use App\Well;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WellController extends Controller {
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct() {
    $this->middleware('auth');
  }

  /**
   * Display a list of all the user's tasks.
   *
   * @param Request $request
   *
   * @return Response
   */
  public function index(Request $request) {
    return view('tasks.index', [
      'wells' => $this->tasks->forUser($request->user()),
    ]);
  }

  /**
   * Create a new task.
   *
   * @param Request $request
   *
   * @return Response
   */
  public function search(Request $request) {
    $lat = $request->input('lat');
    $lng = $request->input('lng');

    $wells = Well::where('id', 1046217640)->get();

    return view('search', ['wells' => $wells]); //, 'center' => $wells->getCenter()]);
  }

  /**
   * Display data for a well
   *
   * @param
   *
   * @return Response
   */
  public function display(Well $well) {

  }

  /**
   * Create a new well
   *
   * @return Response;
   */
  public function create(Request $request) {
    $well = new Well();
    $well->lat = $request->lat;
    $well->lon = $request->lon;
    $well->location = $request->location;
    $well->operator = $request->operator;
    $well->lease = $request->lease;
    $well->api = $request->api;
    $well->elevation = $request->elevation;
    $well->elevation_ref = $request->elevation_ref;
    $well->depth_start = $request->depth_start;
    $well->depth_stop = $request->depth_stop;
    $well->url = $request->url;
    $well->save();
    //$well->write_to_elasticsearch();

    return redirect('/well/' . $well->id);
  }

  /**
   * Destroy the given task.
   *
   * @param  Request $request
   * @param  Task    $task
   *
   * @return Response
   */
  public function destroy(Request $request, Task $task) {
    $this->authorize('destroy', $task);
    $task->delete();
    return redirect('/tasks');
  }
}
