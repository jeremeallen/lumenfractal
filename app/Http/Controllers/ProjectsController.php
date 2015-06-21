<?php namespace App\Http\Controllers;

use App\Project;
use App\Transformers\ProjectTransformer;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class ProjectsController extends ApiController {

    protected $project;

    function __construct(Project $project)
    {
        $this->project = $project;
    }

    public function index(Manager $fractal, ProjectTransformer $projectTransformer)
    {
        $projects = $this->project->with(['notes.links'])->get();

        $collection = new Collection($projects, $projectTransformer);

        $data = $fractal->createData($collection)->toArray();

        return $this->respond($data);
    }

    public function show($projectId, Manager $fractal, ProjectTransformer $projectTransformer)
    {
        $project = Project::findOrFail($projectId);

        $item = new Item($project, $projectTransformer);

        $data = $fractal->createData($item)->toArray();

        return $this->respond($data);
    }

}