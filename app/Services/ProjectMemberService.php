<?php
/**
 * Created by PhpStorm.
 * User: RaylanLocal
 * Date: 07/04/2016
 * Time: 19:16
 */

namespace LaravelAngular\Services;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use LaravelAngular\Repositories\ProjectMemberRepository;
use LaravelAngular\Validators\ProjectMemberValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectMemberService
{
    /**
     * @var ProjectMemberValidator
     */
    protected $validator;

    /**
     * @var ProjectMemberRepository
     */
    protected $repository;

    public function __construct(ProjectMemberRepository $repository, ProjectMemberValidator $validator){
        $this->repository = $repository;
        $this->validator = $validator;
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
}