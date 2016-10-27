var http = require('http');
var arquivo = require('fs');

var server = http.createServer(function(request,response){
	if(request.url =='/questionario/admin'){
		arquivo.readFile('./admin.html',function(err,data){
				response.writeHead(200,{"Content-Type": "text/html"});
				if(err){
					response.write("Arquivo não encontrado!");
				}
				response.write(data);
				response.end();
		});
	}
});

server.listen(3000,function(){
	console.log("servidor rodando!");
});