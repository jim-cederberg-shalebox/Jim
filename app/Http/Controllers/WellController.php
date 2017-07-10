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

    $wells = null;

    return view('search', ['wells' => wells, 'center' => $wells->getCenter()]);
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
