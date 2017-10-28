<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CodeProject\Services;

use CodeProject\Repositories\ProjecRepository;
use CodeProject\Validators\ProjecValidator;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Description of ProjecService
 *
 * @author ASUS
 */
class ProjecService {
    
    protected $repository;
    protected $validator;
    
    public function __construct(ProjecRepository $repository, ProjecValidator $validator) 
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
