<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectNoteRepository;
use CodeProject\Validators\ProjectNoteValidator;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Description of ProjectNoteService
 *
 * @author ASUS
 */
class ProjectNoteService {
    
    protected $repository;
    protected $validator;
    
    public function __construct(ProjectNoteRepository $repository, ProjectNoteValidator $validator) 
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(array $data) 
    {
        try{
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);
        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'messsage' => $e->getMessageBag(),
            ]; 
        }
    }
    
    public function update(array $data,$id)
    {
        try{
            
            $this->validator->with($data)->passesOrFail();
            
            return $this->repository->update($data, $id);
            
        } catch (ValidatorException $e) {
            
            return [
                'error' => true,
                'messsage' => $e->getMessageBag(),
            ]; 
        }
    }    
}
