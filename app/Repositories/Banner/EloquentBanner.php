<?php

namespace App\Repositories\Banner;

use App\Banner;
use App\BannerGroup;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentBanner extends EloquentRepository implements BaseRepository, BannerRepository
{
	protected $model;

	public function __construct(Banner $banner)
	{
		$this->model = $banner;
	}

    public function all()
    {
        return $this->model->with('featureImage','mobileImage')->orderBy('order', 'asc')->get();
    }

    public function destroy($id)
    {
        $banner = parent::find($id);

        $banner->flushImages();

        return $banner->forceDelete();
    }

    public function massDestroy($ids)
    {
        foreach ($ids as $id) {
            $this->destroy($id);
        }
    }

    public function getGroupType(){
        return BannerGroup::select('type_name','type')->groupBy('type')->get();
    }

    public function getGroups($type){
        return BannerGroup::where('type',$type)->get();
    }
}