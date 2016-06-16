<?php

namespace LaravelAngular\Http\Controllers;

use Illuminate\Http\Request;

use LaravelAngular\Repositories\ProjectNoteRepository;
use LaravelAngular\Repositories\ProjectRepository;
use LaravelAngular\Services\ProjectNoteService;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ProjectNoteController extends Controller
{
    /**
     * @var ProjectNoteRepository
     */
    private $repository;

    /**
     * @var ProjectNoteService
     */
    private $service;
    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    public function __construct(ProjectNoteRepository $repository, ProjectNoteService $service, ProjectRepository $projectRepository){
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
    public function show($id, $noteId)
    {
        if($this->CheckProjectPermission($id) == false){
            return ['error' => 'Access forbidden'];
        }
        return $this->service->find($noteId);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $noteId)
    {
        if($this->CheckProjectPermission($id) == false){
            return ['error' => 'Access forbidden'];
        }
        return $this->service->update($request->all(), $noteId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $noteId)
    {
        if($this->CheckProjectOwner($id) == false){
            return ['error' => 'Access forbidden'];
        }
        return $this->service->delete($noteId);
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
