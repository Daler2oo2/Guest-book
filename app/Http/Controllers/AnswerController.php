<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Repositories\AnswerRepository;
use App\Http\Requests\AnswerCreateRequest;
use App\Services\AnswerService;
use App\DTO\AnswerDTO;
use App\Models\Answers;

class AnswerController extends Controller
{  
     private $service;
     private $repository;
     public function __construct(AnswerService $answerService ,AnswerRepository $answerRepository)
     {
        $this->service = $answerService;
        $this->repository = $answerRepository;
     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnswerCreateRequest $request,$id)
    {
        $data = AnswerDTO::toArray($request->validated(),$id);
        $this->repository->create($data);

        return back()->with('success','Коменария успешно добавлено!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->service->answerUpdate($request, $id);

        return back()->with('success','Ответь успешно изменено!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $this->repository->delete($id);

       return back()->with('success','Ответь успешно удалено!');
    }
}
