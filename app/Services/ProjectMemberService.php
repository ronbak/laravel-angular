<?php
/**
 * Created by PhpStorm.
 * User: RaylanLocal
 * Date: 07/04/2016
 * Time: 19:16
 */

namespace LaravelAngular\Services;
use Illuminate\Database\QueryException;
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
        } catch(QueryException $e){
            return[
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }

    public function delete($id, $MemberId){
        try{
            $member = $this->repository->findWhere(['project_id' => $id, 'user_id' => $MemberId])->first();
            $this->repository->delete($member->id);
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

    public function find($id, $MemberId){
        try{
            $member = $this->repository->findWhere(['project_id' => $id, 'user_id' => $MemberId])->first();
            $this->repository->find($member->id);
            return[
                'error' => false,
                'message' => 'É um membro'
            ];
        }catch(\Exception $e){
            return[
                'error' => true,
                'message' => 'Não é um membro'
            ];
        }
    }
}