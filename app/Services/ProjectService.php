<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectValidator;
use Prettus\Validator\Exceptions\ValidatorException;

use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;

/**
 * Description of ProjectService
 *
 * @author ASUS
 */
class ProjectService {
    
    protected $repository;
    protected $validator;
    
    public function __construct(ProjectRepository $repository, ProjectValidator $validator, Filesystem $filesystem, Storage $storage) 
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->filesystem = $filesystem;
        $this->storage = $storage;
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
    
    public function createFile(array $data)
    {
        $this->storage->put($data['name'] . "." . $data['extension'], $this->filesystem->get($data['file']));
    }
}
