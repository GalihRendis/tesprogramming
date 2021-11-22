<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;
use Validator;

class VideoController extends Controller
{
    /**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{
		$video = Video::all();
		return response()->json([
			"success" => true,
			"message" => "Video List",
			"data" => $video
		]);
	}
	/**
	* Store a newly created resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function store(Request $request)
	{
		$input = $request->all();
		$validator = Validator::make($input, [
			'name' => 'required',
			'deskripsi' => 'required'
		]);

		if($validator->fails()){
			return $this->sendError('Validation Error.', $validator->errors());       
		}
		$video = Video::create($input);
		return response()->json([
			"success" => true,
			"message" => "Video created successfully.",
			"data" => $video
		]);
	} 
	/**
	* Display the specified resource.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function show($id)
	{
		$video = Video::find($id);
		if (is_null($video)) {
			return $this->sendError('Video not found.');
		}
		return response()->json([
			"success" => true,
			"message" => "Video retrieved successfully.",
			"data" => $video
		]);
	}
	/**
	* Update the specified resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function update(Request $request, Video $video)
	{
		$input = $request->all();
		$validator = Validator::make($input, [
			'name' => 'required',
			'deskripsi' => 'required'
		]);
		if($validator->fails()){
			return $this->sendError('Validation Error.', $validator->errors());       
		}
		$video->name = $input['name'];
		$video->deskripsi = $input['deskripsi'];
		$video->save();
		return response()->json([
			"success" => true,
			"message" => "Video updated successfully.",
			"data" => $video
		]);
	}
	/**
	* Remove the specified resource from storage.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function destroy(Video $video)
	{
		$video->delete();
		return response()->json([
			"success" => true,
			"message" => "Video deleted successfully.",
			"data" => $video
		]);
	}
}
