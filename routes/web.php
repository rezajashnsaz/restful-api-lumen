<?php


#test route
$router->get('', function () {
    return 'restful api lumen';
});



#api v1 routes
$router->group(['namespace' => 'Api\v1', 'prefix' => 'api/v1'] , function () use ($router)
{

    #latest articles list
    $router->get('/articles', 'ArticleController@articles');

    #single article info & comments
    $router->get('/articles/{id}', 'ArticleController@article');

    #create article
    $router->post('/articles', 'ArticleController@create');

    #update article
    $router->patch('/articles/{id}', 'ArticleController@update');

    #delete article
    $router->delete('/articles/{id}', 'ArticleController@delete');


    #register user
    $router->post('/register', 'AuthController@register');

    #login user
    $router->post('/login', 'AuthController@login');

    #user info
    $router->get('/user', [ 'middleware' => 'auth' ,'uses' =>'AuthController@user']);


});
