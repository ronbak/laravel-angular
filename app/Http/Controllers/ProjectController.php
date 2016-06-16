<?php

namespace LaravelAngular\Http\Controllers;

use Illuminate\Http\Request;

use LaravelAngular\Repositories\ProjectRepository;
use LaravelAngular\Services\ProjectService;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ProjectController extends Controller
{
    /**
     * @var ProjectRepository
     */
    private $repository;

    /**
     * @var ProjectService
     */
    private $service;

    public function __construct(ProjectRepository $repository, ProjectService $service){
        $this->repository = $repository;
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Authorizer::getResourceOwnerId();
        return $this->service->index($userId);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($this->CheckProjectPermission($id) == false){
            return ['error' => 'Access forbidden'];
        }
        return $this->service->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($this->CheckProjectPermission($id) == false){
            return ['error' => 'Access forbidden'];
        }
        return $this->service->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->CheckProjectOwner($id) == false){
            return ['error' => 'Access forbidden'];
        }
        return $this->service->delete($id);
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

        return $this->repository->isOwner($projectId, $userId);
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

        return $this->repository->hasMember($projectId, $userId);
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
