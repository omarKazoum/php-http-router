# php-http-router
this project is a simple http router that is designed to map endpoints in your site with a controller function that will handle the request.
##how it works:
It mainly relies on <a href="route/Router.php">Router</a> class that has two static methods <br>
<code>Router::get(string endPointExpression,[Object,'functionName'])</code> maps a an http <code>GET</code> requests to a method within an object.
<br>
<code>Router::get(string endPointExpression,[Object,'functionName'])</code> maps a an http <code>POST</code> requests to a method within an object.
##basic usage
<ol>
<li>
Create a file in your project root folder name it <code>.htaccess</code> and put <a href="public/.htaccess">this</a> code in it <br>
this will redirect all incoming requests to the file <code>/index.php</code> except requests that target images,js or a css file
</li>
<li>Now create <code>index.php</code> file in your rout folder (if it does not already exist)
then <code>include</code> the <a href="route/Router.php">Router</a> file.
</li>
<li>
    Now add some endoints after including the router class
    add call <code>Router::get()</code> to add a  get endpoint. <br>for example <code>Router::get('users/{userid}',[new UsersController,'view']);</code> is going to call <code>view(string $usersId)</code> function defined in <code>UsersController</code> class when a the our site receives an incomming <code>GET</code> request with url like <code>http://yoursite/users/76556</code> the id from the url 76556 will be passed the <code>UsersController::view($userId)</code> as a first argument.
</li>
<li>
    last step is to call the <code>Router::processIncomingRequest();
</code>
which will call the router to handle the incoming request.
</li>
<li>now give it a shot and let us know if you have any suggestions </li>
</ol>

