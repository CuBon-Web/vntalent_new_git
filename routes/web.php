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

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});
Route::get('/crm', function () {
    return view('app');
});
// Route::get('/admin', function () {
//     dd(1);
//     return view('app');
// }); 
Route::get('/','HomeController@home')->name('home')->middleware(checkLanguage::class);
Route::group(['namespace'=>'Client','middleware' => ['checkLanguage']], function(){
    Route::get('type-product/{id}','PageController@typeproduct');
    Route::get('district/{id}','PageController@district');
    Route::post('ket-qua-tim-kiem','PageController@search')->name('search_result');
    Route::get('dang-nhap.html','AuthController@login')->name('login')->middleware('CheckAuthLogout::class');
    Route::post('dang-nhap.html','AuthController@postLogin')->name('postlogin');
    Route::get('quen-mat-khau.html', 'ResetPasswordController@showForgetForm')->name('password.forgot')->middleware('CheckAuthLogout::class');
    Route::post('quen-mat-khau.html', 'ResetPasswordController@sendMail')->name('password.email')->middleware('CheckAuthLogout::class');
    Route::get('dat-lai-mat-khau/{token}', 'ResetPasswordController@getReset')->name('password.reset.form')->middleware('CheckAuthLogout::class');
    Route::post('dat-lai-mat-khau/{token}', 'ResetPasswordController@reset')->name('password.reset.update')->middleware('CheckAuthLogout::class');
    Route::get('dang-ky.html','AuthController@register')->name('register');
    Route::post('dang-ky.html','AuthController@postRegister')->name('postRegister');
    Route::get('dang-xuat.html','AuthController@logout')->name('logout')->middleware('CheckAuthClient::class');

    Route::post('filter.html','ProductController@filterProduct')->name('filterProduct');
    Route::get('ung-vien.html', 'PageController@candidateList')->name('candidateList')->middleware('CheckAuthClient::class');
    Route::get('ung-vien/data', 'PageController@candidateListData')->name('candidateList.data')->middleware('CheckAuthClient::class');
    Route::get('du-hoc/ve-nuoc-{slug}.html','PageController@aboutNation')->name('aboutNation');
    Route::get('du-hoc-{slug}.html','PageController@duhoc')->name('duhoc');
    Route::get('tin-tuc-du-hoc-{slug}.html','PageController@tintucduhoc')->name('tintucduhoc');
    Route::get('tin-tuc-du-hoc-{slug}/{title}.html','PageController@detailtintucduhoc')->name('detailtintucduhoc');
    Route::get('hoc-bong.html','PageController@hocbong')->name('hocbong');
    Route::get('hoc-bong/{slug}.html','PageController@hocbongDetail')->name('hocbongDetail');

    Route::get('trang-noi-dung/{slug}.html','PageContentController@detail')->name('pagecontent');
    Route::get('dich-vu/{slug}.html','PageController@serviceCateList')->name('serviceCateList');
    // Route::get('dich-vu.html','PageController@serviceList')->name('serviceList');
    // Route::get('dich-vu/{slug}.html','PageController@serviceDetail')->name('serviceDetail');
    Route::get('gioi-thieu.html','PageController@aboutUs')->name('aboutUs');  
    Route::get('cong-nghe.html','PageController@technology')->name('technology');   
    Route::get('lien-he.html','PageController@contact')->name('lienHe');
    Route::post('lien-he','PageController@postcontact')->name('postcontact');
    Route::get('du-an-tieu-bieu.html','PageController@duanTieuBieu')->name('duanTieuBieu');
    Route::get('du-an-tieu-bieu/{slug}.html','PageController@duanTieuBieuDetail')->name('duanTieuBieuDetail');
    Route::get('cau-hoi-thuong-gap.html','PageController@fag')->name('faq');
    Route::get('giai-phap/{slug}.html','SolutionController@detail')->name('detailSolution');
    Route::get('video-hoc-vien.html','PageController@videoHocVien')->name('videoHocVien');
    Route::get('feedback-hoc-vien.html','PageController@feedbackHocVien')->name('feedbackHocVien');
    Route::group(['prefix'=>'cong-trinh'], function(){
        Route::get('/tat-ca.html','ConstructionController@list')->name('allListConstruction');
        Route::get('{id}.html','ConstructionController@detail')->name('detailConstruction');
    });
    Route::get('quickview/{id}','PageController@quickview')->name('quickview');
    Route::get('bang-gia.html','PageController@baogia')->name('banggia');

    Route::get('gio-hang.html', 'CartController@listCart')->name('listCart');
    Route::post('add-to-cart', 'CartController@addToCart')->name('add.to.cart');
    Route::post('update-cart', 'CartController@update')->name('update.cart');
    Route::post('remove-from-cart', 'CartController@remove')->name('remove.from.cart');
    Route::get('thanh-toan.html','CartController@checkout')->name('checkout');
    Route::post('thantoan','CartController@postBill')->name('postBill');
 
    Route::get('dat-ban.html','PageController@orderNow')->name('orderNow');
    Route::get('menu.html','PageController@menu')->name('menu');
    Route::get('account/orders','AuthController@accoungOrder')->name('accoungOrder')->middleware('CheckAuthClient::class');
    Route::get('account/orders/{billid}','AuthController@accoungOrderDetail')->name('accoungOrderDetail')->middleware('CheckAuthClient::class');
    
    Route::get('auth/google', 'GoogleController@redirectToGoogle')->name('loginGoogle');
    Route::get('auth/google/callback', 'GoogleController@handleGoogleCallback');

    Route::get('auth/facebook', 'FacebookController@redirectToFacebook')->name('loginFacebook');
    Route::get('auth/facebook/callback', 'FacebookController@handleFacebookCallback'); 
    Route::group(['prefix'=>'tin-tuc'], function(){
        Route::get('/tat-ca.html','BlogController@list')->name('allListBlog');
        Route::get('danh-muc/{slug}.html','BlogController@listCateBlog')->name('listCateBlog');
        Route::get('loai-danh-muc/{slug}.html','BlogController@listTypeBlog')->name('listTypeBlog');
        Route::get('chi-tiet/{slug}.html','BlogController@detailBlog')->name('detailBlog');
    });

    Route::get('bang-xep-hang/{slug}.html','ProductController@bangxephang')->name('bangxephang');
    Route::get('tra-cuu-truong.html','ProductController@tracutruong')->name('tracutruong');
    Route::get('chi-tiet/{cate}/{type}/{id}.html','ProductController@detail_product')->name('detailProduct');
    Route::get('{danhmuc}.html','ProductController@allListCate')->name('allListProCate');
    Route::get('{danhmuc}/{loaidanhmuc}.html','ProductController@allListType')->name('allListType');
    Route::get('{danhmuc}/{loaidanhmuc}/{thuonghieu}.html','ProductController@allListTypeTwo')->name('allListTypeTwo');

});


Route::post('/languages', 'LanguageController@index')->name('languages');
Route::get('/thu-thap-thong-tin-khach-hang', 'CustomerLeadController@create')->name('customer-leads.create');
Route::post('/thu-thap-thong-tin-khach-hang', 'CustomerLeadController@store')->name('customer-leads.store');
Route::get('/sitemaps.xml', function () {
    $urls = collect([
        ['loc' => route('home'), 'changefreq' => 'daily', 'priority' => '1.0', 'lastmod' => now()->toAtomString()],
        ['loc' => route('aboutUs'), 'changefreq' => 'monthly', 'priority' => '0.8', 'lastmod' => now()->toAtomString()],
        ['loc' => route('lienHe'), 'changefreq' => 'monthly', 'priority' => '0.7', 'lastmod' => now()->toAtomString()],
        ['loc' => route('faq'), 'changefreq' => 'monthly', 'priority' => '0.6', 'lastmod' => now()->toAtomString()],
        ['loc' => route('videoHocVien'), 'changefreq' => 'weekly', 'priority' => '0.7', 'lastmod' => now()->toAtomString()],
        ['loc' => route('feedbackHocVien'), 'changefreq' => 'weekly', 'priority' => '0.7', 'lastmod' => now()->toAtomString()],
        ['loc' => route('hocbong'), 'changefreq' => 'daily', 'priority' => '0.8', 'lastmod' => now()->toAtomString()],
        ['loc' => route('allListBlog'), 'changefreq' => 'daily', 'priority' => '0.9', 'lastmod' => now()->toAtomString()],
    ]);

    try {
        $blogItems = \App\models\blog\Blog::where('status', 1)->get(['slug', 'updated_at', 'created_at']);
        $blogUrls = $blogItems->map(function ($blog) {
            return [
                'loc' => route('detailBlog', ['slug' => $blog->slug]),
                'changefreq' => 'weekly',
                'priority' => '0.8',
                'lastmod' => optional($blog->updated_at ?? $blog->created_at ?? now())->toAtomString(),
            ];
        });
        $urls = $urls->merge($blogUrls);
    } catch (\Throwable $e) {
        // Skip dynamic entries if table/query is unavailable.
    }

    try {
        $serviceItems = \App\models\Solution::where('status', 1)->get(['slug', 'updated_at', 'created_at']);
        $serviceUrls = $serviceItems->map(function ($item) {
            return [
                'loc' => route('serviceCateList', ['slug' => $item->slug]),
                'changefreq' => 'weekly',
                'priority' => '0.7',
                'lastmod' => optional($item->updated_at ?? $item->created_at ?? now())->toAtomString(),
            ];
        });
        $urls = $urls->merge($serviceUrls);
    } catch (\Throwable $e) {
        // Skip dynamic entries if table/query is unavailable.
    }

    return response()->view('sitemap', ['urls' => $urls], 200)->header('Content-Type', 'application/xml');
})->name('sitemap');

Route::get('/sitemaps.xml', function () {
    return redirect()->route('sitemap', [], 301);
});
