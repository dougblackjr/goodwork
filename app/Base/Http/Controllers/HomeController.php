<?php

namespace App\Base\Http\Controllers;

use App\TaskManager\Repositories\TaskRepository;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TaskRepository $repository)
    {

        $user = auth()->user();

        $currentWork = $repository->userCurrentlyWorkingOn($user->id);
        $currentAssigned = $repository->userCurrentlyAssigned($user->id);

        $user->setAppends(['unread_direct_messages']);

        if (request()->segment(1) === 'api') {
            return response()->json([
                'status'            => 'success',
                'current_work'      => $currentWork,
                'current_assigned'  => $currentAssigned,
            ]);
        }

        return view(
            'home',
            [
                'currentWork'       => $currentWork,
                'currentAssigned'   => $currentAssigned,
            ]
        );
    }
}
