<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentCreateRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\Repositories\CommentRepository;
use App\Services\CommentService;
use App\DTO\CommentDTO;
use Carbon\Carbon;

class CommentController extends Controller
{

    private $repository;
    private $service;

    public function __construct(CommentRepository $commentRepository, CommentService $commentService)
    {
        $this->service = $commentService;
        $this->repository = $commentRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       Carbon::setLocale('ru');
       $data = $this->repository->getComments();

       return view('home.index',compact('data'));
    }

    public function adminCommentsIndex()
    {
       Carbon::setLocale('ru');
       $data = $this->repository->getComments();
       return view('admin.comments.index',compact('data'));
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
    public function store(CommentCreateRequest $request)
    {
        $data = CommentDTO::toArray($request->validated());
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
    public function update(CommentUpdateRequest $request, $id)
    {
        $this->service->commentUpdate($request, $id);
        return back()->with('success','Коменария успешно изменено!');
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

       return back()->with('success','Коменария успешно удалено!');
    }
}
