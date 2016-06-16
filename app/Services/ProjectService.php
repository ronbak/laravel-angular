<?php
/**
 * Created by PhpStorm.
 * User: RaylanLocal
 * Date: 07/04/2016
 * Time: 19:16
 */

namespace LaravelAngular\Services;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use LaravelAngular\Repositories\ProjectFileRepository;
use LaravelAngular\Repositories\ProjectRepository;
use LaravelAngular\Validators\ProjectValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectService
{
    /**
     * @var ProjectValidator
     */
    protected $validator;

    /**
     * @var ProjectRepository
     */
    protected $repository;

    public function __construct(ProjectRepository $repository, ProjectValidator $validator){
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function index($userId)
    {
        $data = $this->repository->scopeQuery(function ($query) use ($userId) {
            return $query->select('projects.*')
                ->leftJoin('project_members', 'project_members.project_id', '=', 'projects.id')
                ->where('projects.owner_id', '=', $userId)
                ->orWhere('project_members.member_id', '=', $userId)
                ->orderBy('projects.id');
        })->all();
        return $data;
    }

    public function create(array $data){
        try{
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);
        } catch(ValidatorException $e){
            return[
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }

    public function update(array $data, $id){
        try{
            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data, $id);
        } catch(ModelNotFoundException $e){
            return[
                'error' => true,
                'message' => $e->getMessage()
            ];
        } catch(ValidatorException $e){
            return[
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }

    public function delete($id){
        try{
            $this->repository->delete($id);
            return[
                'error' => false,
                'message' => 'Deletado com sucesso'
            ];
        }catch(\Exception $e){
            return[
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }

    public function find($id){
        try{
            return $this->repository->find($id);
        }catch(\Exception $e){
            return[
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }

    public function createFile(array $data)
    {
        try{
            $project = $this->repository->skipPresenter()->find($data['project_id']);
            $projectFile = $project->files()->create($data);
            Storage::put($projectFile->id.'.'.$data['extension'], File::get($data['file']));
            return[
                'error' => false,
                'message' => 'Arquivo upado com sucesso'
            ];
        }catch(\Exception $e){
            return[
                'error' => true,
                'message' => $e->getMessage()
            ];
        }

    }

    public function deleteFile($projectId, $fileId)
    {
        try{
            $project = $this->repository->skipPresenter()->find($projectId);
            
            $projectFile = $project->files()->find($fileId);

            Storage::delete($projectFile->id.'.'.$projectFile->extension);

            $projectFile->delete($fileId);

            return[
                'error' => false,
                'message' => 'Arquivo deletado com sucesso'
            ];
        }catch(\Exception $e){
            return[
                'error' => true,
                'message' => $e->getMessage()
            ];
        }

    }

}