var clients = [];
var groups = [];
var express = require('express');
var im = require('imagemagick');
var http = require('http');
var fsextra = require('fs-extra');
var fs = require('fs');
var app = express();
var server = app.listen(9090);
// Loading socket.io
var io = require('socket.io').listen(server);
io.sockets.on('connection', function(socket) {
    // When the client connects, they are sent a message
    socket.broadcast.emit('newUser', 'New User Joined, Say Hi :D');
    socket.on('setUser', function(username){
        console.log(username); //here you have your user name
      });
      socket.on('chatMessage', function(msg){
        io.emit('chatMessage', msg);
      });
    

    
   

});

