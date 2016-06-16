<?php

namespace LaravelAngular\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use LaravelAngular\Repositories\ProjectRepository;
use LaravelAngular\Services\ProjectService;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ProjectFileController extends Controller
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
        
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();

        $data['file'] = $file;
        $data['extension'] = $extension;
        $data['name'] = $request->name;
        $data['description'] = $request->description;
        $data['project_id'] = $request->project_id;

        $this->service->createFile($data);
    }

    /**
     * Delete resource from storage.
     *
     * @param $projectId
     * @param $fileId
     * @return array
     */
    public function destroy($projectId, $fileId)
    {
        if($this->CheckProjectOwner($projectId) == false){
            return ['error' => 'Access forbidden'];
        }

        $this->service->deleteFile($projectId, $fileId);
    }

    /**
     * @param $projectId
     * @return array
     */
    private function CheckProjectOwner($projectId)
    {
        $userId = Authorizer::getResourceOwnerId();

        return $this->repository->isOwner($projectId, $userId);
    }

    /**
     * @param $projectId
     * @return mixed
     */
    private function CheckProjectMember($projectId)
    {
        $userId = Authorizer::getResourceOwnerId();

        return $this->repository->hasMember($projectId, $userId);
    }


    private function CheckProjectPermission($projectId){
        if($this->CheckProjectOwner($projectId) or $this->CheckProjectMember($projectId)){
            return true;
        }
        return false;
    }
}
