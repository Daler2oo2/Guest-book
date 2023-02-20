<?php 

namespace App\Services;

use App\Repositories\AdsRepository;
use App\Repositories\CategoryRepository;
use App\DTO\AdsDTO;
use App\Http\Requests\AdsCreateRequest;

class AdsService {

    private $adsRepository;
    private $categoryRepository;

    public function __construct(AdsRepository $adsRepository,CategoryRepository $categoryRepository)
    {
        $this->adsRepository = $adsRepository;
        $this->categoryRepository = $categoryRepository;
    }
    
    public function findBySlug($slug){

         $category = $this->categoryRepository->findBySlug( $slug);

        return $this->adsRepository->findByCategoryId($category[0]->id);

    }
     public function createAds(AdsCreateRequest $request, $slug){
    
        $category = $this->categoryRepository->findBySlug( $slug);

        $data = AdsDTO::toArray($request,$category[0]->id);

        if ($request->hasFile('images')) { 
         
            $images = [];
            foreach ($request['images'] as $image){
                $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
                $image_path =  $image->storeAs('images', $fileName,'public');
                array_push($images, $image_path);
            }
            
            $data['images'] = $images;
        }

       return $this->adsRepository->create($data);
         
     }
}