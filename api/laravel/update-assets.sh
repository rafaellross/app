rm -fr css js img templates
cp -R laravel/public/js ./
cp -R laravel/public/css ./
cp -R laravel/public/img ./
cp -R laravel/public/templates ./
cp AuthenticatesUsers.php laravel/vendor/laravel/framework/src/Illuminate/Foundation/Auth/AuthenticatesUsers.php
