<?php

namespace App\Repositories;


use App\Interfaces\UserInterface;
use App\User;
use App\Interfaces\PasswordEncInterface;
use App\Interfaces\RoleInterface;
use App\Jobs\MailerJob;
use App\Interfaces\PassGeneratorInterface;
use Carbon\Carbon;


class UserRepository implements UserInterface{

    protected $user;
    protected $passwordHasher;
    protected $roleRepo;
    protected $passGen;

    public function __construct(PasswordEncInterface $passwordHasher, RoleInterface $roleRepo, PassGeneratorInterface $passGen)
    {
        $this->user=new User();
        $this->passwordHasher=$passwordHasher;
        $this->roleRepo=$roleRepo;
        $this->passGen=$passGen;
    }
    public function get_user_by_email($email){
        return $this->user->select('id','name','email','password')->where('email',$email)->first();
    }

    public function create_user($data){
        $this->user->fill($data->all());
        $password=$this->passGen->randomPassword();
        $this->user->password=$this->passwordHasher->hash($password);
        $this->user->save();
        $this->setRole($this->user,$this->roleRepo->getUserRole());
        $this->set_coordinator($this->user, $this->get_User_By_id($data->coordinator_id));
        $content=['subject'=>'account',
        'body'=>"emai:".$this->user->email."password:".$password."",];
        $job=(new MailerJob($this->user->email, $content))->delay(Carbon::now()->addSeconds(5));
        dispatch($job);
        return $this->user;
    }
    public function create_coordinator( $data){
        $this->user->fill($data->all());
        $this->user->password=$this->passwordHasher->hash($this->user->password);
        $this->user->save();
        $this->setRole($this->user,$this->roleRepo->getCoordinatorRole());
    }
    public function update_user_data($data){
        
    }
    public function get_user_roles($user){
        return $user->Roles()->select('title')->get();
    }
    public function setRole($user,$roles){
        $user->Roles()->sync($roles);
    }
    public function get_User_By_id($id){
        return $this->user->select('id','name','email','start_date')->where('id',$id)->firstOrFail();
    }
    public function set_coordinator($user,$coordinator){
        $user->Coordinators()->sync($coordinator);
    }
    public function delete_user($id){
        $this->user->findOrFail($id)->delete();
    }
    public function set_timetable_start_date($id, $date){
        $this->user->findOrFail($id)->update(['start_date'=>$date]);
    }
}