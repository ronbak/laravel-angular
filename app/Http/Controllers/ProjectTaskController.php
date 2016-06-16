<?php

namespace LaravelAngular\Http\Controllers;

use Illuminate\Http\Request;

use LaravelAngular\Repositories\ProjectRepository;
use LaravelAngular\Repositories\ProjectTaskRepository;
use LaravelAngular\Services\ProjectTaskService;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ProjectTaskController extends Controller
{
    /**
     * @var ProjectTaskRepository
     */
    private $repository;

    /**
     * @var ProjectTaskService
     */
    private $service;
    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    public function __construct(ProjectTaskRepository $repository, ProjectTaskService $service, ProjectRepository $projectRepository){
        $this->repository = $repository;
        $this->service = $service;
        $this->projectRepository = $projectRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        if($this->CheckProjectPermission($id) == false){
            return ['error' => 'Access forbidden'];
        }
        return $this->repository->findWhere(['project_id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($this->CheckProjectPermission($request->project_id) == false){
            return ['error' => 'Access forbidden'];
        }
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $TaskId)
    {
        if($this->CheckProjectPermission($id) == false){
            return ['error' => 'Access forbidden'];
        }
        return $this->repository->findWhere(['project_id' => $id, 'id' => $TaskId]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $TaskId)
    {
        if($this->CheckProjectPermission($id) == false){
            return ['error' => 'Access forbidden'];
        }
        return $this->service->update($request->all(), $TaskId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $TaskId)
    {
        if($this->CheckProjectOwner($id) == false){
            return ['error' => 'Access forbidden'];
        }
        return $this->service->delete($TaskId);
    }

    /**
     * Check project owner
     *
     * @param $projectId
     * @return array
     */
    private function CheckProjectOwner($projectId)
    {
        $userId = Authorizer::getResourceOwnerId();

        return $this->projectRepository->isOwner($projectId, $userId);
    }

    /**
     * Check project member
     *
     * @param $projectId
     * @return mixed
     */
    private function CheckProjectMember($projectId)
    {
        $userId = Authorizer::getResourceOwnerId();

        return $this->projectRepository->hasMember($projectId, $userId);
    }

    /**
     * Check project owner or member
     *
     * @param $projectId
     * @return bool
     */
    private function CheckProjectPermission($projectId){
        if($this->CheckProjectOwner($projectId) or $this->CheckProjectMember($projectId)){
            return true;
        }
        return false;
    }
}
