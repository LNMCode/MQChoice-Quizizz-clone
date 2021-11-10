import 'dart:convert';

import 'package:flutter/cupertino.dart';
import 'package:http/http.dart' as http;
import 'package:dio/dio.dart';
import 'package:mobileapplication/models/room.dart';

import '../models/room_response.dart';

const baseUrl = 'http://192.168.1.82:3000';

class Repository {
  final Dio _dio = Dio();
  final http.Client httpClient;
  final getQues = (idroom) => '$baseUrl/joinroom?idroom=$idroom';

  Repository(@required this.httpClient) : assert(httpClient != null);

  Future<Room_Response?> getques(String idroom) async {
    try {
      final url = (getQues(idroom));
      var response = await httpClient.get(url);
      if (response.statusCode == 200) {
        var jsondecode = jsonDecode(response.body);
        return Room_Response.fromJson(jsondecode);
      }
    } catch (e) {
      print(e);
    }
  }
}
