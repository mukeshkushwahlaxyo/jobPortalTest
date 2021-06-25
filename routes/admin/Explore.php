<?php
	Route::resource('explore', 'ExploreController');
	Route::post('explore/post', 'ExploreController@posts');
	Route::post('explore/store', 'ExploreController@store');
	Route::get('explore/edit/{id}', 'ExploreController@edit')->name('explore_edit');
	Route::put('explore/update/{id}', 'ExploreController@update');