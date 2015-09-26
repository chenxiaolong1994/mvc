# mvc
a small php mvc framework writen by me
just develop it.
thank you!

Instructions of directories:
1. app directory includes views,controllers and models of a application
2. config directory includes many config files,like database config 
3. core directory includes base controller like controller.class.php and ViewController.class.php,also some extends
4. data directory includes datas,like log files,cached files ,backup files and so on
5. lib directory includes common functions,you can use the function in any place,functions like D(get a instance of a data table)
6. public directory includes js,css,images

Execute process
The index.php is the only entrance,it loads common.class.php who can route different controller files and get the corresponding instance,function.class.php can get the instance of a model by use function D,if they don't exist,there will be an error,the same as controller.
