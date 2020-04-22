<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminSettings;
use App\Models\Campaigns;
use App\Models\Categories;
use App\Models\Donations;
use App\Models\Updates;
use App\Helper;
use App\Models\Like;

use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{

	public function __construct( Request $request) {
		$this->request = $request;
	}

    /**
     *
     * @return \Illuminate\Http\Response
     */

      public function campaigns()
    {

	   $settings = AdminSettings::first();

		 // Deadline
     $timeNow = strtotime(\Carbon\Carbon::now());

     $dataDeadline = Campaigns::where('status', 'active')
     ->where('finalized','0')
     ->where('deadline', '<>', '')
     ->paginate(20);

     foreach ($dataDeadline as $key) {
       if( $key->deadline != '' ) {
      	    $deadline = strtotime($key->deadline);

      		$date = strtotime($key->deadline);
      	    $remaining = $date - $timeNow;

      		$days_remaining = floor($remaining / 86400);
      	}

        if($days_remaining < 0) {
          $finalized = Campaigns::find($key->id);
          $finalized->finalized = '1';
          $finalized->save();
        }

     }

     $data = Campaigns::where('status', 'active')
     ->where('finalized','0')
     ->orderBy('id','DESC')
     ->paginate($settings->result_request);

		return view('ajax.campaigns',['data' => $data, 'settings' => $settings])->render();
    }

	public function category() {

		 $settings = AdminSettings::first();

		 $slug = $this->request->slug;

		 $category = Categories::where('slug','=',$slug)->first();
	  $data   = Campaigns::where('status', 'active')->where('finalized','0')->where('categories_id',$category->id)->orderBy('id','DESC')->paginate($settings->result_request);

		return view('ajax.campaigns',['data' => $data, 'settings' => $settings, 'slug' => $category->slug])->render();

	}// End Method

    public function donations()
    {

	   $settings = AdminSettings::first();
		$page   = $this->request->input('page');
		$id        = $this->request->input('id');
		$data    = Donations::where('campaigns_id',$id)->orderBy('id','desc')->paginate(10);

 		return view('ajax.donations',['data' => $data, 'settings' => $settings])->render();

    }//<--- End Method

    public function updatesCampaign()
    {

	    $settings = AdminSettings::first();
		$page     = $this->request->input('page');
		$id         = $this->request->input('id');
		$data     = Updates::where('campaigns_id',$id)->orderBy('id','desc')->paginate(1);

 		return view('ajax.updates-campaign',['data' => $data, 'settings' => $settings])->render();

    }//<--- End Method

    public function search() {

		 $settings = AdminSettings::first();

		 $q = $this->request->slug;

		$data = Campaigns::where( 'title','LIKE', '%'.$q.'%' )
		->where('status', 'active' )
		->where('finalized','0')
		->orWhere('location','LIKE', '%'.$q.'%')
		->where('status', 'active' )
		->where('finalized','0')
		->groupBy('id')
		->orderBy('id', 'desc' )
		->paginate( $settings->result_request );

		return view('ajax.campaigns',['data' => $data, 'settings' => $settings, 'slug' => $q])->render();

	}// End Method

	public function like(){

		$like = Like::firstOrNew(['user_id' => Auth::user()->id, 'campaigns_id' => $this->request->id]);

		$campaign = Campaigns::find($this->request->id);

		if( $like->exists ) {

				// IF ACTIVE DELETE Like
				if( $like->status == '1' ) {
					$like->status = '0';
					$like->update();

				// ELSE ACTIVE AGAIN
				} else {
					$like->status = '1';
					$like->update();
				}

		} else {

			// INSERT
			$like->save();

		}
				$totalLike = Helper::formatNumber( $campaign->likes()->count() );

				return $totalLike;

	}//<---- End Method

	public function campaignsFeatured() {

		 $settings = AdminSettings::first();

		 $data = Campaigns::where('status', 'active')
     ->where('finalized','0')
     ->where('featured','1')
     ->orderBy('id','DESC')
     ->paginate($settings->result_request);

		return view('ajax.campaigns',['data' => $data])->render();

	}// End Method


}
