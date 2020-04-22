<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\AdminSettings;
use App\Models\Campaigns;
use App\Models\Categories;
use App\Models\User;

class HomeController extends Controller
{

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

	   $settings = AdminSettings::first();
	   $categories = Categories::where('mode','on')->orderBy('name')->get();

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

     $dataFeatured = Campaigns::where('status', 'active')
     ->where('finalized','0')
     ->where('featured','1')
     ->orderBy('id','DESC')
     ->paginate(4);

		return view('index.home', ['data' => $data, 'categories' => $categories, 'dataFeatured' => $dataFeatured]);
    }

	public function search(Request $request) {

		$q = trim($request->input('q'));
		$settings = AdminSettings::first();

		$page = $request->input('page');

		$data = Campaigns::where( 'title','LIKE', '%'.$q.'%' )
		->where('status', 'active' )
    ->where('finalized','0')
		->orWhere('location','LIKE', '%'.$q.'%')
		->where('status', 'active' )
    ->where('finalized','0')
		->groupBy('id')
		->orderBy('id', 'desc' )
		->paginate( $settings->result_request );


		$title = trans('misc.result_of').' '. $q .' - ';

		$total = $data->total();

		//<--- * If $page not exists * ---->
		if( $page > $data->lastPage() ) {
			abort('404');
		}

		//<--- * If $q is empty or is minus to 1 * ---->
		if( $q == '' || strlen( $q ) <= 1 ){
			return redirect('/');
		}

		return view('default.search', compact( 'data', 'title', 'total', 'q' ));

	}// End Method

		public function getVerifyAccount( $confirmation_code ) {

        // Session Inactive
		if( !Auth::check() ) {
		$user = User::where( 'confirmation_code', $confirmation_code )->where('status','pending')->first();

		if( $user ) {

			$update = User::where( 'confirmation_code', $confirmation_code )
			->where('status','pending')
			->update( array( 'status' => 'active', 'confirmation_code' => '' ) );

			Auth::loginUsingId($user->id);

			 return redirect('/')
					->with([
						'success_verify' => true,
					]);
			} else {
			return redirect('/')
					->with([
						'error_verify' => true,
					]);
			}
		} else {

			// Session Active
			$user = User::where( 'confirmation_code', $confirmation_code )->where('status','pending')->first();
			 if( $user ) {

			$update = User::where( 'confirmation_code', $confirmation_code )
			->where('status','pending')
			->update( array( 'status' => 'active', 'confirmation_code' => '' ) );

			 return redirect('/')
					->with([
						'success_verify' => true,
					]);
			} else {
			return redirect('/')
					->with([
						'error_verify' => true,
					]);
			}
		}
	}// End Method

	public function category($slug) {

		$settings = AdminSettings::first();

		 $category = Categories::where('slug','=',$slug)->where('mode','on')->firstOrFail();
	  	 $data   = Campaigns::where('status', 'active')
       ->where('categories_id',$category->id)
       ->where('finalized','0')
       ->orderBy('id','DESC')
       ->paginate($settings->result_request);

		return view('default.category', ['data' => $data, 'category' => $category]);

	}// End Method

  public function campaignsFeatured() {

    $settings = AdminSettings::first();
    $data = Campaigns::where('status', 'active')
    ->where('finalized','0')
    ->where('featured','1')
    ->orderBy('id','DESC')
    ->paginate($settings->result_request);

   return view('index.campaigns-featured', ['data' => $data]);

  }// End Method

}
