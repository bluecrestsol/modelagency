<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*TESTS*/

/* __scripts route is temporary - no access yet to live db. will be removed later*/
Route::get('__scripts/{name?}', function ($name) {

	if ($name == 'update-admin') {
		$admin = \App\Models\Admin::find(1);
		$admin->email = "alex@alexscalia.com";
		$admin->password = bcrypt("2074c8b5bdfc4378e0b44be200afce30");
		$admin->save();

		return "admin updated";	
	} elseif ($name == 'seed-table-bodies') {
		$data = \App\Models\Body::all();
		$seed = [
			'Average',
			'Slim',
			'Athletic / Toned',
			'Muscular',
			'Curvy',
			'Heavyset / Stocky',
			'Plus-Size / Full-Figured',
		];

		$index = 0;

		foreach ($data as $i) {
			$i->name = $seed[$index];
			$i->owner = 2;
			$i->save();
			$index++;
 		}

 		return "seeded table bodies";

	} elseif ($name == 'seed-feature-sports') {
		$seed = [
			'Aerobics',
			'Archery',
			'Badminton',
			'Baseball',
			'Basketball',
			'Billiards',
			'Boating',
			'Bodybuilding',
			'Bowling',
			'Boxing',
			'Canoeing',
			'Cheer leading',
			'Cricket',
			'Diving',
			'Fencing',
			'Field hockey',
			'Figure skate',
			'Fishing',
			'Football',
			'Frisbee',
			'Gymnastics',
			'Handball',
			'Hiking',
			'Ice hockey',
			'Jump rope',
			'Kayak',
			'Kick boxing',
			'Ping-pong',
			'Rock climbing',
			'Roller skate',
			'Rollerblade',
			'Rugby',
			'Running',
			'Scuba diving',
			'Sculling',
			'Skateboarding',
			'Stunts',
			'Sky diving',
		];

		foreach ($seed as $index => $value) {
			$data = [
				'features_category_id' => 11,
				'name' => $value,
				'sort' => ($index + 1),
			];
			\App\Models\Feature::create($data);
		}

		return "seeded feature sports";

	} elseif ($name == 'seed-feature-dancing') {
		$seed = [
			'Ballet',
			'Ballroom',
			'Belly',
			'Bollywood',
			'Break',
			'Clog',
			'Club',
			'Disco',
			'Flamenco',
			'Hip hop',
			'Hula',
			'Irish dance',
			'Jazz',
			'Line',
			'Modern',
			'Polka',
			'Robot',
			'Salsa',
			'Samba',
			'Swing',
			'Tango',
			'Tap',
			'Waltz',
		];

		foreach ($seed as $index => $value) {
			$data = [
				'features_category_id' => 12,
				'name' => $value,
				'sort' => ($index + 1),
			];
			\App\Models\Feature::create($data);
		}

		return "seeded feature dancing";

	} elseif ($name == 'seed-feature-singing') {
		$seed = [
			'Country',
			'Folk',
			'Jazz',
			'Musical theater',
			'Opera',
			'Pop',
			'R&B',
			'Rap',
		];

		foreach ($seed as $index => $value) {
			$data = [
				'features_category_id' => 13,
				'name' => $value,
				'sort' => ($index + 1),
			];
			\App\Models\Feature::create($data);
		}

		return "seeded feature singing";

	} elseif ($name == 'seed-feature-acting') {
		$seed = [
			'Voice over',
			'Classical',
			'Commercial',
			'Improvisation',
			'Presenting',
			'Film',
			'Dubbing',
			'Modelling',
		];

		foreach ($seed as $index => $value) {
			$data = [
				'features_category_id' => 14,
				'name' => $value,
				'sort' => ($index + 1),
			];
			\App\Models\Feature::create($data);
		}

		return "seeded feature acting";
	} else {

		return "no script executed";
	}
		
	
});

//Artisan Commands
Route::get('/artisan/{command?}/{attrib?}', function ($command, $attrib=null) {
	$attrib ? \Artisan::call("{$command}:{$attrib}") : \Artisan::call("{$command}");
});
//End Artisan Command

// Route::get('/___/change_uuid', 'Admin\ModelController@changeUuid');

//debugbar 
Route::group(['middleware' => 'disable.debug'], function () {

	Route::get('/', 'HomePageController@index')->name('index');

    Route::post('send-contact-form', 'HomePageController@sendContact');

	/*
	| Agency Routes
	*/

	Route::group(['prefix' => 'agencies'], function() {
		Route::get('/', 'AgencyController@index')->name('client.agencies.index');
		Route::get('login', 'AgencyController@showLoginForm')->name('client.agencies.login');
		Route::post('login', 'AgencyController@login')->name('client.agencies.login');
		Route::get('logout', 'AgencyController@logout')->name('client.agencies.logout');
	});

	/*
	| End Agency Routes
	*/

	/*
	| Model / Talent Routes
	*/
	Route::get('model/{uuid}/{public_name}', 'ModelController@single')->name('client.models.single');
	Route::post('model/{uuid}/{public_name}', 'ModelController@bookModel')->name('client.book.models.single');
	Route::group(['prefix' => 'models'], function() {
		Route::get('/', 'ModelController@index')->name('client.models.index');
		Route::get('login', 'ModelController@showLoginForm')->name('client.models.login');
		Route::post('login', 'ModelController@login')->name('client.models.login');
		Route::get('logout', 'ModelController@logout')->name('client.models.logout');
		Route::get('downloadCompanyCard/{id}', 'ModelController@downloadCompanyCard')->name('client.models.download-company-card');
	});

	// become a talent
	Route::get('/become-a-talent', 'Admin\TalentController@publicCreate')->name('become-a-talent.create');
	Route::post('/become-a-talent', 'Admin\TalentController@publicStore')->name('become-a-talent.store');
	Route::get('/become-a-talent/{uuid}/uploads', 'Admin\TalentController@publicCreateUpload')->name('become-a-talent.create.upload');
	Route::post('/become-a-talent/{uuid}/uploads', 'Admin\TalentController@publicStoreUpload')->name('become-a-talent.store.upload');
	//become a model
	Route::get('/become-a-model', 'Admin\ModelController@publicCreate')->name('become-a-model.create');
	Route::post('/become-a-model', 'Admin\ModelController@publicStore')->name('become-a-model.store');
	Route::get('/become-a-model/{uuid}/uploads', 'Admin\ModelController@publicCreateUpload')->name('become-a-model.create.upload');
	Route::post('/become-a-model/{uuid}/uploads', 'Admin\ModelController@publicStoreUpload')->name('become-a-model.store.upload');
	/* 
		like: domain.com/pr/model/{model_uuid}/{customer_uuid}/like
		dislike: domain.com/pr/model/{model_uuid}/{customer_uuid}/dislike
	*/
	Route::get('/pr/model/{model_uuid}/{customer_uuid}/{request}', 'Admin\ModelController@promotionResponse')->name('models-promotion.response');
	/*
	| End Model / Talent Routes
	*/

	/*
	|Admin Routes 
	*/

	$admin_prefix = "hqhg2xuwiksiwsaq";
	Route::get('hqhg2xuwiksiwsaq', 'Admin\LoginController@index')->name('admin');
	Route::post('/login', 'Admin\LoginController@login')->name('admin.login');

	Route::group(['prefix' => $admin_prefix, 'middleware' => ['admin']], function(){
		Route::get('/dashboard', 'Admin\LoginController@dashboard')->name('admin.dashboard');
		Route::get('/logout', 'Admin\LoginController@logout')->name('admin.logout');
		
		/*
		 * Admins
		 */
		Route::resource('admins', 'Admin\AdminController');
		//end Admins
		
		/*
		| Agencies
		*/
		Route::group(['prefix' => 'agencies'], function() {
			Route::any('listings', 'Admin\AgencyController@listings')->name('agencies.listings');
			Route::get('clearFilter', 'Admin\AgencyController@clearFilterSession')->name('agencies.filter.clear');
		});
		Route::resource('agencies', 'Admin\AgencyController');
		/*
		|End Agencies
		*/

		/*
		| Customers
		*/
		Route::group(['prefix' => 'customers'], function() {
			Route::any('listings', 'Admin\CustomerController@listings')->name('customers.listings');
			Route::get('clearFilter', 'Admin\CustomerController@clearFilterSession')->name('customers.filter.clear');
			Route::get('autoComplete', 'Admin\CustomerController@autoCompleteAjax')->name('customers.autocomplete');
		});
		Route::resource('customers', 'Admin\CustomerController');
		/*
		|End Customers
		*/
		/*
		| Notes
		*/
		Route::resource('notes', 'Admin\NoteController');
		/*
		|End Notes

		/*
		| availabilities
		*/
		Route::resource('availabilities', 'Admin\AvailabilityController');
		/*
		|End availabilities

		*/
		/*
		| Models
		*/
		Route::group(['prefix' => 'models'], function() {
			Route::any('listings', 'Admin\ModelController@listings')->name('models.listings');
			
			// Route::get('images/{id}', 'Admin\ModelController@images')->name('models.images');
			Route::get('books/{id}', 'Admin\ModelController@books')->name('models.books');
			Route::get('book-photos/{id}', 'Admin\ModelController@book_photos')->name('models.book_photos');
			Route::get('snap-photos/{id}', 'Admin\ModelController@snap_photos')->name('models.snap_photos');
			Route::post('images/update', 'Admin\ModelsImageController@update')->name('models.images.update');
			Route::post('images/{id}/store', 'Admin\ModelsImageController@store')->name('models.images.store');
			Route::delete('images/{id}', 'Admin\ModelsImageController@destroy')->name('models.images.destroy');
			
			Route::get('clearFilter', 'Admin\ModelController@clearFilterSession')->name('models.filter.clear');
			Route::get('autoComplete', 'Admin\ModelController@autoCompleteAjax')->name('models.autocomplete');
			Route::post('updateProfilePhoto/{id}', 'Admin\ModelController@updateProfilePhoto')->name('models.update.profile_photo');
			Route::post('deleteCompanyCard/{id}', 'Admin\ModelController@deleteCompanyCard')->name('models.delete.company_card');
			Route::get('downloadCompanyCard/{id}', 'Admin\ModelController@downloadCompanyCard')->name('models.download.company_card');
			
			Route::get('files/{id}', 'Admin\ModelController@files')->name('models.files.index');
			Route::get('files/{id}/create', 'Admin\ModelController@filesCreate')->name('models.files.create');
			Route::post('files/{id}/store', 'Admin\ModelController@filesStore')->name('models.files.store');

			Route::get('clips/{id}', 'Admin\ModelController@clips')->name('models.clips');
			Route::post('clips/update', 'Admin\ModelsClipController@update')->name('models.clips.update');
			Route::post('clips/{id}/store', 'Admin\ModelsClipController@store')->name('models.clips.store');
			Route::delete('clips/{id}', 'Admin\ModelsClipController@destroy')->name('models.clips.destroy');

			Route::get('{uuid}/promote', 'Admin\ModelController@showPromotePage')->name('models.show-promote');
			Route::post('promote/submit', 'Admin\ModelController@promote')->name('models.promote.submit');
		});
		Route::resource('models', 'Admin\ModelController');
		
		/*
		|End Models
		*/
		

		/*
		| Talents
		*/
		Route::group(['prefix' => 'talents'], function() {
			// Route::get('images/{id}', 'Admin\TalentController@images')->name('talents.images');
			Route::get('book-photos/{id}', 'Admin\TalentController@books')->name('talents.books');
			Route::get('snap-photos/{id}', 'Admin\TalentController@snaps')->name('talents.snaps');
			Route::post('images/update', 'Admin\ModelsImageController@update')->name('talents.images.update');
			Route::post('images/{id}/store', 'Admin\ModelsImageController@store')->name('talents.images.store');
			Route::delete('images/{id}', 'Admin\ModelsImageController@destroy')->name('talents.images.destroy');
			
			Route::get('clearFilter', 'Admin\TalentController@clearFilterSession')->name('talents.filter.clear');
			Route::get('autoComplete', 'Admin\TalentController@autoCompleteAjax')->name('talents.autocomplete');
			Route::post('updateProfilePhoto/{id}', 'Admin\TalentController@updateProfilePhoto')->name('talents.update.profile_photo');
			
			Route::get('files/{id}', 'Admin\TalentController@files')->name('talents.files.index');
			Route::get('files/{id}/create', 'Admin\TalentController@filesCreate')->name('talents.files.create');
			Route::post('files/{id}/store', 'Admin\TalentController@filesStore')->name('talents.files.store');
		});
		Route::resource('talents', 'Admin\TalentController');
		/*
		|End Talents
		*/

		/*
		| Transactions
		*/
		Route::group(['prefix' => 'transactions'], function() {
			Route::get('/', 'Admin\TransactionController@index')->name('transactions.index');
			Route::get('/{type}/create', 'Admin\TransactionController@create')->name('transactions.create');
		});

		Route::resource('transactions', 'Admin\TransactionController', ['except' => ['index','create']]);
		/*
		| End Transactions
		*/

		/*
		| Models Files
		*/
		// Route::group(['prefix' => 'models_files'], function() {
		// 	Route::get('download/{id}', 'Admin\ModelsFileController@download')->name('models_files.download');
		// });
		// Route::resource('models_files', 'Admin\ModelsFileController');
		/*
		| End Models Files
		*/

		/*
		| Files
		*/
		Route::group(['prefix' => 'files'], function() {
			Route::get('download/{id}', 'Admin\FileController@download')->name('files.download');
		});
		Route::resource('files', 'Admin\FileController');
		/*
		| End Files
		*/

		/*
		| Enquiry
		*/
		Route::resource('enquiries', 'Admin\EnquiryController');
		/*
		| End Enquiry
		*/	

		/*
		| Skill
		*/
		Route::resource('skills', 'Admin\SkillController');
		/*
		| End Skill
		*/	

		/*
		| experiences
		*/
		Route::resource('experiences', 'Admin\ExperienceController');
		/*
		| End experiences 
		*/	

		

		/*
		| jobs
		*/
		Route::group(['prefix' => 'jobs'], function() {
			Route::get('images/{id}', 'Admin\JobsController@images')->name('jobs.images');
			Route::post('images/update', 'Admin\JobsPhotosController@update')->name('jobs.images.update');
			Route::post('images/{id}/store', 'Admin\JobsPhotosController@store')->name('jobs.images.store');
			Route::delete('images/{id}', 'Admin\JobsPhotosController@destroy')->name('jobs.images.destroy');

			Route::get('clips/{id}', 'Admin\JobsController@clips')->name('jobs.clips');
			Route::post('clips/update', 'Admin\JobsClipsController@update')->name('jobs.clips.update');
			Route::post('clips/{id}/store', 'Admin\JobsClipsController@store')->name('jobs.clips.store');
			Route::delete('clips/{id}', 'Admin\JobsClipsController@destroy')->name('jobs.clips.destroy');
		});
		Route::resource('jobs', 'Admin\JobsController');
		/*
		| End jobs 
		*/	

		Route::group(['middleware' => 'role_admin'], function () {
			/*
			| Transaction Types
			*/
			Route::resource('transaction_types', 'Admin\TransactionTypeController');
			/*
			| End Transaction Types
			*/

			/*
			| File Types
			*/

			Route::group(['prefix' => 'file_types'], function() {
				Route::get('clearFilter', 'Admin\FileTypeController@clearFilterSession')->name('file_types.filter.clear');
			});
			Route::resource('file_types', 'Admin\FileTypeController');

			/*
			| End File Types
			*/

			/*
			| features
			*/
			Route::get('features/clearFilter', 'Admin\FeatureController@clearFilter')->name('features.filter.clear');
			// Route::resource('features', 'Admin\FeatureController');
			/*
			| End features 
			*/

			/*
			| features_categories
			*/
			Route::post('features/row-reorder', 'Admin\FeaturesCategoryController@reorder')->name('features.row-reorder');
			Route::get('features/list/{category_id}', 'Admin\FeaturesCategoryController@features')->name('features.list');
			Route::get('features/create-feature/{category_id}', 'Admin\FeaturesCategoryController@createFeature')->name('features.create-feature');
			Route::get('features/show-feature/{id}', 'Admin\FeaturesCategoryController@showFeature')->name('features.show-feature');
			Route::get('features/edit-feature/{id}', 'Admin\FeaturesCategoryController@editFeature')->name('features.edit-feature');
			Route::post('features/store-feature', 'Admin\FeaturesCategoryController@storeFeature')->name('features.store-feature');
			Route::put('features/update-feature/{id}', 'Admin\FeaturesCategoryController@updateFeature')->name('features.update-feature');
			Route::delete('features/destroy-feature/{id}', 'Admin\FeaturesCategoryController@destroyFeature')->name('features.destroy-feature');

			Route::resource('features', 'Admin\FeaturesCategoryController');
			/*
			| End features_categories 
			*/	

			/*
			| languages
			*/
			Route::resource('languages', 'Admin\LanguageController');
			/*
			| End languages 
			*/

			//BOOKS
			Route::post('books/{uuid}/updateItems', 'Admin\BooksController@updateItems')->name('books.update_items');
			Route::get('books/{model_uuid}/full', 'Admin\BooksController@full')->name('books.full');
			Route::resource('books', 'Admin\BooksController');
			//END BOOKS
		});

	});
	
});



/*
| End Admin Routes
*/

