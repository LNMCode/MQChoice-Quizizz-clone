import 'dart:convert';

import 'package:flutter/cupertino.dart';
import 'package:http/http.dart' as http;
import 'package:dio/dio.dart';
import 'package:mobileapplication/models/checkidroom/entercode_response.dart';
import 'package:mobileapplication/models/getroom/room_response.dart';
import 'package:mobileapplication/models/insert_user_response.dart';
import 'package:mobileapplication/responsitory/stream_socket.dart';
import 'package:socket_io_client/socket_io_client.dart' as IO;

const baseUrl = 'http://172.16.2.70:3000';

class Repository {
  final Dio _dio = Dio();
  final http.Client httpClient;
  final getroom = (idroom) => '$baseUrl/joinroom/getroom?idroom=$idroom';
  final checkidroom = (idroom) => '$baseUrl/joinroom?idroom=$idroom';
  final insertUserToRoomUrl = (idroom, iduser, nameuser) =>
      '$baseUrl/joinroom/addusertoroom?idroom=$idroom&iduser=$iduser&nameuser=$nameuser';

  Repository(@required this.httpClient) : assert(httpClient != null);

  Future<RoomResponse?> getRoom(String idroom) async {
    try {
      final url = (getroom(idroom));
      var response = await httpClient.get(url);
      if (response.statusCode == 200) {
        var jsondecode = jsonDecode(response.body);
        return RoomResponse.fromJson(jsondecode);
      }
    } catch (e) {
      print(e);
    }
  }

  Future<EnterCodeResponse?> checkidRoom(String idroom) async {
    try {
      final url = (checkidroom(idroom));
      print(url);
      var response = await httpClient.get(url);
      if (response.statusCode == 200) {
        var jsondecode = jsonDecode(response.body);
        return EnterCodeResponse.fromJson(jsondecode);
      }
    } catch (e) {
      print(e);
    }
  }

  Future<InsertUserResponse?> insertUserToRoom(
      String idroom, String iduser, String nameuser) async {
    try {
      final url = (insertUserToRoomUrl(idroom, iduser, nameuser));
      print(url);
      var response = await httpClient.put(url);
      if (response.statusCode == 200) {
        var jsondecode = jsonDecode(response.body);
        return InsertUserResponse.fromJson(jsondecode);
      }
    } catch (e) {
      print(e);
    }
  }
}

class SocketRepository {
  final StreamSocket streamSocket;

  SocketRepository({
    required this.streamSocket,
  });

  final IO.Socket socket = IO.io(baseUrl, <String, dynamic>{
    "transports": ["websocket"],
    "autoConnect": false,
  });

  // Connect to server and wait host room start
  // idroom: id room that user enterd before
  // iduser: id user auto create by time current
  // nameuser: nameuser entered sametime with idroom
  //String idroom, String iduser, String nameuser
  connectWaitRoom(String idroom, String iduser, String nameuser) {
    socket.connect();
    socket.onConnect((_) => {print('Connected')});
    //socket.emit('event', 'haha');
    //socket.on(
    //    'event2', (data) => {print(data), streamSocket.addResponse(data)});
    socket.emit('waitRoomSendFromClient', {
      'idroom': idroom,
      'iduser': iduser,
      'nameuser': nameuser,
    });

    socket.on(
        'waitStartRoom' + idroom,
        (data) => {
              print('start ' + data),
              streamSocket.addResponse(data),
            });
    print(socket.connected);
  }

  connectAnswerQuestion(
    String idroom,
    String iduser,
  ) {
    socket.emit('playerJoinToRoomPlay', {
      'idroom': idroom,
      'iduser': iduser,
    });
  }

  // Player answer
  answerQuestion(
    String idroom,
    String iduser,
    String idques,
    String idans,
    String valueans,
  ) {
    socket.emit('sendToServer', {
      'idroom': idroom,
      'iduser': iduser,
      'idques': idques,
      'idans': idans,
      'value': valueans,
    });
  }
}
