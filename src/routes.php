<?php
Route::group(['middleware' => ['web', 'auth']], function() {
    Route::get('books/view/{fileid}','BlackChaose\Biblioteca\Controllers\BibliotecaController@getFileView')->name('biblioteca.getfile_view');
    Route::get('books/download/{fileid}','BlackChaose\Biblioteca\Controllers\BibliotecaController@getFileDownload')->name('biblioteca.getfile_download');
    Route::get('biblioteca/list', 'BlackChaose\Biblioteca\Controllers\BibliotecaController@index')->name('biblioteca.list');
    Route::get('biblioteca/settings', 'BlackChaose\Biblioteca\Controllers\BibliotecaController@settings')->name('biblioteca.settings');
    Route::resource('biblioteca', 'BlackChaose\Biblioteca\Controllers\BibliotecaController');    //todo where - in route after

});
