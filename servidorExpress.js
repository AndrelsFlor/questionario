var express = require('express');
var php = require('node-php');
var path = require("path"); 

app = express();

app.use('/css',express.static_dirname+'/css');

app.get("/questionario/admin",php.cgi("admin.php"));

app.listen(3000,function(){
	console.log("servidor ouvindo na porta 3000");
});