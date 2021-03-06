<?php

namespace LaravelAngular\Http\Controllers;

use Illuminate\Http\Request;

use LaravelAngular\Repositories\ProjectMemberRepository;
use LaravelAngular\Repositories\ProjectRepository;
use LaravelAngular\Services\ProjectMemberService;

use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ProjectMemberController extends Controller
{
    /**
     * @var ProjectMemberRepository
     */
    private $repository;

    /**
     * @var ProjectMemberService
     */
    private $service;
    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    public function __construct(ProjectMemberRepository $repository, ProjectMemberService $service, ProjectRepository $projectRepository){
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
    public function show($id, $MemberId)
    {
        if($this->CheckProjectPermission($id) == false){
            return ['error' => 'Access forbidden'];
        }
        return $this->service->find($id, $MemberId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $MemberId)
    {
        if($this->CheckProjectOwner($id) == false){
            return ['error' => 'Access forbidden'];
        }
        return $this->service->delete($id, $MemberId);
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
